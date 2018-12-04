<?php

// On uninstalling plugin drop table
// and remove the APIKEY from the options

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


// remove option
delete_option('cf7-push-bullet-settings-api-key');

// drop table
global $wpdb;
$table_name = $wpdb->prefix . 'cf7_push_bullet';

$query = $wpdb->prepare( 'DROP TABLE %S', $wpdb->esc_like( $table_name ) );

