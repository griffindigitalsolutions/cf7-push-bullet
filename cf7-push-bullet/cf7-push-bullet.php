<?php

/**
 * @link              https://griffin.digital
 * @since             1.0.0
 * @package           Cf7_Push_Bullet
 *
 * @wordpress-plugin
 * Plugin Name:       Contact Form 7 - Pushbullet integration
 * Plugin URI:        https://griffin.digital/plugin-contact-form-7-push-bullet-integration
 * Description:       Allows form submissions to be sent to a user's device(s) via the Pushbullet API (https://www.pushbullet.com)
 * Version:           1.0.0
 * Author:            Cristian Rat
 * Author URI:        https://griffin.digital
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cf7-push-bullet
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'CF7_PUSH_BULLET_PLUGIN_VERSION', '1.0.0' ); // Dec 2018
define( 'CF7_PUSH_BULLET_PLUGIN_REQUIRED_WP_VERSION', '4.8' );
define( 'CF7_PUSH_BULLET_PLUGIN', __FILE__ );
define( 'CF7_PUSH_BULLET_TEXT_DOMAIN', 'cf7-push-bullet' );
define( 'CF7_PUSH_BULLET_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cf7-push-bullet-activator.php
 */
function activate_cf7_push_bullet() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cf7-push-bullet-activator.php';
	Cf7_Push_Bullet_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cf7-push-bullet-deactivator.php
 */
function deactivate_cf7_push_bullet() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cf7-push-bullet-deactivator.php';
	Cf7_Push_Bullet_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cf7_push_bullet' );
register_deactivation_hook( __FILE__, 'deactivate_cf7_push_bullet' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cf7-push-bullet.php';

/**
 * Begin execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cf7_push_bullet() {

	$plugin = new Cf7_Push_Bullet();
	$plugin->run();

}
run_cf7_push_bullet();
