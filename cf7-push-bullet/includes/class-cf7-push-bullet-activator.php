<?php

/**
 * Fired during plugin activation
 *
 * @link       https://griffin.digital
 * @since      1.0.0
 *
 * @package    Cf7_Push_Bullet
 * @subpackage Cf7_Push_Bullet/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cf7_Push_Bullet
 * @subpackage Cf7_Push_Bullet/includes
 * @author     Cristian Rat <chris@griffin.digital>
 */
class Cf7_Push_Bullet_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        // prepare tables
        self::prepare_database_tables();

        // and add some random dev data
        self::add_testing_data();
    }

    /*
     * Either create or upgrade (if necessary) the database tables
     *
     * @since    1.0.0
     */
    public static function prepare_database_tables()
    {
        global $wpdb;
        global $cf7_push_bullet_db_version;
        $table_name = $wpdb->prefix . 'cf7_push_bullet';

        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
                    id mediumint(11) NOT NULL AUTO_INCREMENT,
                    push_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,                    
                    push_type tinytext NOT NULL,
                    push_title tinytext NOT NULL,
                    push_body text NOT NULL,
                    result text DEFAULT '' NOT NULL,
                    PRIMARY KEY (id)
                ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('cf7_push_bullet_db_version', $cf7_push_bullet_db_version);

        /* Adding an Upgrade Function */
        // Not needed in this version
//        global $wpdb;
//        $installed_ver = get_option("cf7_push_bullet_db_version");
//        if ($installed_ver != $cf7_push_bullet_db_version) {
//            $table_name = $wpdb->prefix . 'cf7_push_bullet';
//            $sql = "ALTER TABLE $table_name ();";
//            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//            dbDelta($sql);
//            update_option("cf7_push_bullet_db_version", $cf7_push_bullet_db_version);
//        }
    }

    /*
     * Add some testing data
     *
     * @since    1.0.0
     */
    public static function add_testing_data()
    {
//        var_dump('adding test data');
//        exit;
    }

}