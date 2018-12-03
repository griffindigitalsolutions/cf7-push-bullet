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

        $table_name = $wpdb->prefix . self::$table_name;

        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
                    id mediumint(11) NOT NULL AUTO_INCREMENT,
                    form_id int(11) NOT NULL,
                    push_title tinytext NOT NULL,
                    push_type tinytext NOT NULL,
                    push_body text NOT NULL,
                    push_reply text DEFAULT '' NOT NULL,
                    success bool DEFAULT '' NOT NULL,
                    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('cf7_push_bullet_db_version', self::$db_version);

        /* Adding an Upgrade Function */
        // Not needed in this version
        // TODO: move to separate function
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
     * Add testing data
     *
     * @since    1.0.0
     */
    public static function add_testing_data()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . self::$table_name;

        $wpdb->insert(
            $table_name,
                array(
                    'date' => current_time('mysql'),
                    'push_type' => 'note',
                    'push_title' => 'new form submission on www.....',
                    'push_body' => 'form: asdadad
                                    usename: asdasd
                                    asdads: XX
                                    emai: asdadafas@asdasd.com
                                    phone: 9484987328782374',
                    'push_reply' => '{
                                    "active": true,
                                    "iden": "ujDsTpyFe1YsjAlZ7UNk28",
                                    "created": 1543417345.573496,
                                    "modified": 1543417345.588333,
                                    "type": "note",
                                    "dismissed": false,
                                    "direction": "self",
                                    "sender_iden": "ujDsTpyFe1Y",
                                    "sender_email": "kilroy05@gmail.com",
                                    "sender_email_normalized": "kilroy05@gmail.com",
                                    "sender_name": "Ra Chris",
                                    "receiver_iden": "ujDsTpyFe1Y",
                                    "receiver_email": "kilroy05@gmail.com",
                                    "receiver_email_normalized": "kilroy05@gmail.com",
                                    "title": "new form submission on www.....",
                                    "body": "form: asdadad\nusename: asdasd\nasdads: XX\nemai: asdadafas@asdasd.com\nphone: 9484987328782374"
                                }',
                )
        );
        $wpdb->insert(
            $table_name,
            array(
                'date' => current_time('mysql'),
                'push_type' => 'note',
                'push_title' => 'new form submission on www.....',
                'push_body' => 'form: asdadad
                                    usename: asdasd
                                    asdads: XX
                                    emai: asdadafas@asdasd.com
                                    phone: 9484987328782374',
                'push_reply' => '{
                                    "active": true,
                                    "iden": "ujDsTpyFe1YsjAlZ7UNk28",
                                    "created": 1543417345.573496,
                                    "modified": 1543417345.588333,
                                    "type": "note",
                                    "dismissed": false,
                                    "direction": "self",
                                    "sender_iden": "ujDsTpyFe1Y",
                                    "sender_email": "kilroy05@gmail.com",
                                    "sender_email_normalized": "kilroy05@gmail.com",
                                    "sender_name": "Ra Chris",
                                    "receiver_iden": "ujDsTpyFe1Y",
                                    "receiver_email": "kilroy05@gmail.com",
                                    "receiver_email_normalized": "kilroy05@gmail.com",
                                    "title": "new form submission on www.....",
                                    "body": "form: asdadad\nusename: asdasd\nasdads: XX\nemai: asdadafas@asdasd.com\nphone: 9484987328782374"
                                }',
            )
        );
        $wpdb->insert(
            $table_name,
            array(
                'date' => current_time('mysql'),
                'push_type' => 'note',
                'push_title' => 'new form submission on www.....',
                'push_body' => 'form: asdadad
                                    usename: asdasd
                                    asdads: XX
                                    emai: asdadafas@asdasd.com
                                    phone: 9484987328782374',
                'push_reply' => '{
                                    "active": true,
                                    "iden": "ujDsTpyFe1YsjAlZ7UNk28",
                                    "created": 1543417345.573496,
                                    "modified": 1543417345.588333,
                                    "type": "note",
                                    "dismissed": false,
                                    "direction": "self",
                                    "sender_iden": "ujDsTpyFe1Y",
                                    "sender_email": "kilroy05@gmail.com",
                                    "sender_email_normalized": "kilroy05@gmail.com",
                                    "sender_name": "Ra Chris",
                                    "receiver_iden": "ujDsTpyFe1Y",
                                    "receiver_email": "kilroy05@gmail.com",
                                    "receiver_email_normalized": "kilroy05@gmail.com",
                                    "title": "new form submission on www.....",
                                    "body": "form: asdadad\nusename: asdasd\nasdads: XX\nemai: asdadafas@asdasd.com\nphone: 9484987328782374"
                                }',
            )
        );
    }

}