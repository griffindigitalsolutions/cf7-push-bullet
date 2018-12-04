<?php

// On uninstall: drop table and remove the API key from options

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


// remove option
delete_option('cf7-push-bullet-settings-api-key');

// drop table
global $wpdb;
$table_name = $wpdb->prefix . 'cf7_push_bullet';

$wpdb->query(sprintf('DROP TABLE IF EXISTS %s', $table_name));

