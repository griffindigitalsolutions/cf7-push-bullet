<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://griffin.digital
 * @since      1.0.0
 *
 * @package    Cf7_Push_Bullet
 * @subpackage Cf7_Push_Bullet/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cf7_Push_Bullet
 * @subpackage Cf7_Push_Bullet/includes
 * @author     Cristian Rat <chris@griffin.digital>
 */
class Cf7_Push_Bullet_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		// TODO v2: change string to CONSTANT
		load_plugin_textdomain(
			'cf7-push-bullet',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
