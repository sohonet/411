FROM ubuntu:16.04

RUN apt-get update \
  && apt-get install -y apache2 libapache2-mod-php php-xml php7.0-mbstring php7.0-sqlite php7.0-curl nodejs-legacy npm sqlite3 curl git unzip cron

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN npm install -g grunt-cli bower
RUN a2enmod rewrite
RUN a2enmod headers

COPY . /var/www/411
WORKDIR /var/www/411

COPY 411.conf /etc/apache2/sites-available/
RUN a2ensite 411
RUN a2dissite 000-default

RUN npm install
RUN bower install --allow-root
RUN composer install
RUN grunt prod

RUN sqlite3 data.db < db.sql
RUN chmod 0666 data.db
RUN bin/create_default_site.php
RUN bin/create_default_user.php
RUN chown -R www-data /var/www/411

RUN crontab cron

RUN rm /var/log/apache2/access.log ; ln -s /dev/stdout /var/log/apache2/access.log
RUN rm /var/log/apache2/error.log ; ln -s /dev/stdout /var/log/apache2/error.log
RUN rm /var/log/apache2/other_vhosts_access.log ; ln -s /dev/stdout /var/log/apache2/other_vhosts_access.log

