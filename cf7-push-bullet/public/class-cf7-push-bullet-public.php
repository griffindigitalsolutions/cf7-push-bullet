<?php

/**
 * The public-facing functionality of the plugin.
 * Currently doesn't do anything
 *
 * @link       https://griffin.digital
 * @since      1.0.0
 *
 * @package    Cf7_Push_Bullet
 * @subpackage Cf7_Push_Bullet/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Cf7_Push_Bullet
 * @subpackage Cf7_Push_Bullet/public
 * @author     Cristian Rat <chris@griffin.digital>
 */
class Cf7_Push_Bullet_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version           The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_classes();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
	    // currently skipped, we are not doing anything on the front end
        //	wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cf7-push-bullet-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
        // currently skipped, we are not doing anything on the front end
		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cf7-push-bullet-public.js', array( 'jquery' ), $this->version, false );
	}

    /**
     * Load Classes that are used in the front end
     * @since    1.0.0
     */
	public function load_classes() {
        require_once(CF7_PUSH_BULLET_PLUGIN_DIR . '/includes/class-cf7-push-bullet-api.php');
    }

}
