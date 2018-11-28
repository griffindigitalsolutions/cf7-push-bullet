<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://griffin.digital
 * @since      1.0.0
 *
 * @package    Cf7_Push_Bullet
 * @subpackage Cf7_Push_Bullet/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cf7_Push_Bullet
 * @subpackage Cf7_Push_Bullet/admin
 * @author     Cristian Rat <chris@griffin.digital>
 */
class Cf7_Push_Bullet_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * The main admin slug of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $slug The current version of this plugin.
     */
    private $page_slug = 'cf7-push-bullet-options';

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        // add menu hook
        add_filter('wpcf7_editor_panels', array($this, 'add_cf7_panel'), 99);
        // add after save hook
//        add_action( 'wpcf7_after_save', array( &$this, 'save_form' ) );
        // add submenu to CF7
        add_action('admin_menu', array($this, 'add_cf7_submenu'));
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Cf7_Push_Bullet_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Cf7_Push_Bullet_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/cf7-push-bullet-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Cf7_Push_Bullet_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Cf7_Push_Bullet_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/cf7-push-bullet-admin.js', array('jquery'), $this->version, false);

    }


    /**
     * Add panel to CF7
     *
     * @since    1.0.0
     */
    public function add_cf7_panel($panels)
    {
        $panels['cf7-push-bullet-panel'] = array(
            'title' => __('Push Bullet', 'cf7-push-bullet'),
            'callback' => array($this, 'add_panel')
        );
        return $panels;
    }


    /**
     * Add submenu to CF7
     *
     * @since 1.0.0
     */
    public function add_cf7_submenu()
    {
        add_submenu_page('wpcf7',
            __('Push Bullet', 'cf7-push-bullet'),
            __('Push Bullet', 'cf7-push-bullet'), 'manage_options',
            $this->page_slug, array($this, 'admin_page'));
    }

    /**
     * Add page to admin, to manage settings for plugin
     *
     * @since    1.0.0
     */
    public function admin_page()
    {
        // load the admin template
        include 'partials/cf7-push-bullet-admin-display.php';
    }

    /**
     * Return sanitized GET
     *
     * @since 1.0.0
     */
    public static function get_sanitized_get($param)
    {
        return filter_input(INPUT_GET, $param, FILTER_SANITIZE_STRING);
    }

    /**
     * Return plugin root location
     *
     * @since 1.0.0
     */
    public static function get_root_path()
    {
        return plugin_dir_path(__FILE__);
    }

    /**
     * Include partial
     *
     * @since 1.0.0
     */
    public static function include_partial($partial)
    {
        include(self::get_root_path() . '/partials/tab-' . $partial . '.php');
    }
}
