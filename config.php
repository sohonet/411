<?php

$config = [];

/**
 *
 * Database configuration
 *
 */
$config['db'] = [
    'dsn' => 'sqlite:/var/www/411/data.db',
    'user' => 'root',
    'pass' => null,
];


/**
 *
 * Search type configuration
 * Note: All hostnames should specify protocol!
 *
 */

# Elasticsearch configuration
$config['elasticsearch'] = [
    # Configuration for the 411 Alerts index.
    'alerts' => [
        'hosts' => ['http://elasticsearch.elk.sohonet.internal:9200'],
        'index_hosts' => [],
        'index' => null,
        'date_based' => false,
        'date_field' => 'alert_date',
        'src_url' => 'http://kibana.sohonet.internal',
    ],
    # Configuration for the logstash index that 411 queries.
    'logstash' => [
        'hosts' => ['http://elasticsearch.elk.sohonet.internal:9200'],
        'index_hosts' => [],
        'index' => 'logstash',
        'date_based' => true,
        'date_field' => '@timestamp',
        'src_url' => 'http://kibana.sohonet.internal',
    ],
];

# Graphite
# Fill in to enable the Graphite search
$config['graphite'] = [
    'host' => null,
];

# Threatexchange
# Fill in to enable the Threatexchange search
$config['threatexchange'] = [
    'api_token' => null,
    'api_secret' => null,
];


/**
 *
 * Target configuration
 *
 */

# Jira integration
# Fill in to allow 411 to generate Jira tickets.
$config['jira'] = [
    'host' => null,
    'user' => null,
    'pass' => null,
];

# Slack integration
# Fill in to allow 411 to send messages to Slack.
$config['slack'] = [
    'webhook_url' => null
];
