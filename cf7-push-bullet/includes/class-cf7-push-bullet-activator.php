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

    public static $table_name = 'cf7_push_bullet';
    public static $db_version = '1.0.0';

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
    }

    /*
     * Either create or upgrade (if necessary) the database tables
     *
     * @since    1.0.0
     */
    public static function prepare_database_tables()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . self::$table_name;

        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
                    id mediumint(11) NOT NULL AUTO_INCREMENT,
                    form_id int(11) NOT NULL,
                    push_title tinytext NOT NULL,
                    push_type tinytext NOT NULL,
                    push_body text NOT NULL,
                    push_reply text DEFAULT '' NOT NULL,
                    success int(1) DEFAULT 0 NOT NULL,
                    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('cf7_push_bullet_db_version', self::$db_version);

        /* Adding an Upgrade Function */
        // Not needed in this version
        // TODO v1.1: move to separate function
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

}