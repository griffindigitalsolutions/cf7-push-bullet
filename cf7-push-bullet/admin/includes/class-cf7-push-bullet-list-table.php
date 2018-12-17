<?php
// Our implementation of the WP_List_table
// Allows list display in standard WP format, plus bulk actions.

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Cf7_Push_Bullet_List_Table extends WP_List_Table
{

    public $items_per_page = 10; // TODO v1.1: Use screen options. Make this a changeable setting.

    function __construct()
    {
        parent::__construct(array(
            'singular' => 'item',
            'plural' => 'items',
            'ajax' => false,
        ));
    }

    /**
     * Title has custom actions (db column is actually called push_title)
     * @param $item
     * @return string
     */
    function column_push_title($item)
    {
        //Build row actions
        $actions = array(
            'view' => sprintf('<a href="?page=%s&action=%s&item=%s">View</a>', $_REQUEST['page'], 'view', $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=%s&item=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['id']),
        );

        //Return the title contents
        return sprintf(
            '%1$s <span style="color: silver">(id:%2$s)</span>%3$s',
            /*$1%s*/
            $item['push_title'],
            /*$2%s*/
            $item['id'],
            /*$3%s*/
            $this->row_actions($actions)
        );
    }

    /**
     * Checkbox for multiple actions
     * @param object $item
     * @return string
     * @since 1.0.0
     */
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'],  /*$1%s*/
            $item['id']                /*$2%s*/
        );
    }

    /**
     * Prepare data (this function calls another function which runs the actual query
     * @return void
     * @since 1.0.0
     */
    function prepare_items()
    {
        //used by WordPress to build and fetch the _column_headers property
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        // handle any bulk processing before loading
        $this->process_bulk_action();


        // get the data. Sorting and ordering is done there
        $this->prepare_table_data(); // it will set $this->items

        // but pagination is done, so handle it separately
        $this->paginate(); // $this->items must already exist
    }

    /**
     * Handle pagination
     * @return void
     * @since 1.0.0
     */
    public function paginate()
    {
        // if $this->items is empty, return
        if (!$this->items) {
            return;
        }

        $data = $this->items;
        // get current page
        $current_page = $this->get_pagenum();

        // how many items?
        $total_items = count($data);


        // The WP_List_Table class does not handle pagination
        $data = array_slice($data, (($current_page - 1) * $this->items_per_page), $this->items_per_page);

        // Set the data to items, rather than returning
        $this->items = $data;


        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args(array(
            'total_items' => $total_items,                                 // Calculate  total number
            'per_page' => $this->items_per_page,                           // How many items per page
            'total_pages' => ceil($total_items / $this->items_per_page)    // Total pages
        ));
    }

    /**
     * Columns we use
     * @return array
     * @since 1.0.0
     */
    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
//            'id' => 'ID', // don't show ID for now
            'push_title' => 'Title',
            'push_type' => 'Push Type',
            'success' => 'Result',
            'created_at' => 'Created'
        );
        return $columns;
    }


    /**
     * Message in case of no data
     * @since 1.0.0
     */
    public function no_items()
    {
        _e('No pushes yet.', CF7_PUSH_BULLET_TEXT_DOMAIN);
    }

    /**
     * Get table data and do sorting if required
     * Set as $this->items
     * @return bool
     * @ since 1.0.0
     */
    public function prepare_table_data()
    {
        global $wpdb;
        $wpdb_table = $wpdb->prefix . 'cf7_push_bullet';
        $orderby = (isset($_GET['orderby'])) ? sanitize_sql_orderby($_GET['orderby']) : 'id';
        $order = (isset($_GET['order'])) ? sanitize_sql_orderby($_GET['order']) : 'DESC';

        $user_query = "SELECT 
                        id, created_at, push_title, push_type, push_body, success
                      FROM 
                        $wpdb_table 
                      ORDER BY $orderby $order";

        // query output_type will be an associative array with ARRAY_A.
        $query_results = $wpdb->get_results($user_query, ARRAY_A);

        if (!$query_results || !count($query_results)) {
            $this->items = false;
            return false;
        }

        // set to class property
        $this->items = $query_results;

        return true;
    }

    /**
     * Which columns are sortable?
     * @return array
     * @ since 1.0.0
     */
    function get_sortable_columns()
    {
        $sortable_columns = array(
            'id' => array('id', true),
//            'push_title' => array('push_title', false),
//            'push_type' => array('push_type', false),
            'push_body' => array('push_body', false),
            'created_at' => array('created_at', false),
//            'push_reply' => array('push_reply', false),
            'success' => array('success', false),
        );
        return $sortable_columns;
    }


    /**
     * Process items which don't get processed individually
     * @param object $item
     * @param string $column_name
     * @return string
     * @since 1.0.0
     */
    function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'created_at':
                return mysql2date( __( get_option('date_format') . ', ' . get_option('time_format'), CF7_PUSH_BULLET_TEXT_DOMAIN ), $item[$column_name], true );
            case 'success':
                return $item[$column_name] ? 'OK' : '<span style="color: #a00;">Push Failed</span>';
            //            case 'id':
            case 'push_title':
            case 'push_type':
            case 'push_body':
                return $item[$column_name];
            default:
                return '';
//                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    /**
     * Add bulk actions
     * @return array
     * @since 1.0.0
     */
    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    /**
     * Process bulk actions. At the moment it's only delete
     * @return void
     * @since 1.0.0
     */
    function process_bulk_action()
    {
        global $wpdb;
        $wpdb_table = $wpdb->prefix . 'cf7_push_bullet';

        // Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {
            // Get items to delete
            if (isset($_GET['item']) && !empty($_GET['item'])) {
                $to_delete = $_GET['item'];

                // if bulk action, loop and clean
                if (is_array($to_delete) && count($to_delete) > 0) {
                    foreach ($to_delete as $k => $v) {
                        // cast all to integer
                        $to_delete[$k] = (int)$v;
                    }
                    $to_delete = implode($to_delete, ',');
                }

                // we'll run a delete query
                $sql = "DELETE  FROM $wpdb_table WHERE id IN($to_delete);";
                $wpdb->query($sql);
            }
        }
        return;
    }

    /**
     * Get the current action selected from the bulk actions dropdown.
     * @since 1.0.0
     *
     * @return string|false The action name or False if no action was selected
     */
    public function current_action()
    {
        if (isset($_REQUEST['filter_action']) && !empty($_REQUEST['filter_action'])) {
            return false;
        }

        if (isset($_REQUEST['action']) && -1 != $_REQUEST['action']) {
            return $_REQUEST['action'];
        }

        if (isset($_REQUEST['action2']) && -1 != $_REQUEST['action2']) {
            return $_REQUEST['action2'];
        }

        return false;
    }

}
