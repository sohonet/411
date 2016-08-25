#!/usr/bin/php
<?php

/**
 * Script to create a new site.
 */
require_once(__DIR__ . '/../phplib/411bootstrap.php');

echo "Creating new site\n";

$newsite = new FOO\Site();
$newsite['name'] = 'default';
$newsite['host'] = 'localhost';
$newsite->store();

FOO\SiteFinder::setSite($newsite);
$cfg = new FOO\DBConfig();
$cfg['cookie_secret'] = FOO\Random::base64_bytes(24);
$cfg['cron_enabled'] = 1;
$cfg['worker_enabled'] = 1;
$cfg['summary_enabled'] = 1;
$cfg['last_cron_date'] = 0;
$cfg['last_rollup_date'] = 0;
$cfg['error_email_enabled'] = 1;
$cfg['error_email_throttle'] = 30;
$cfg['from_email'] = 'admin@example.com';
$cfg['from_error_email'] = 'admin@example.com';
$cfg['default_email'] = 'admin@example.com';

printf("\nSite created! ID: %d\n", $newsite['id']);
