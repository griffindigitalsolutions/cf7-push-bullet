<?php
// View for individual items

// don't load directly
if (!defined('ABSPATH')) {
    die('-1');
}

// get the current item
global $wpdb;

$item_id = $this::get_sanitized_get('item');

$wpdb_table = $wpdb->prefix . 'cf7_push_bullet';
$query = "SELECT 
            id, created_at, push_title, push_type, push_body, success, push_reply
          FROM 
            $wpdb_table
          WHERE
            id = $item_id";

$query_result = $wpdb->get_results($query, OBJECT);
if (!$query_result) : ?>
    <h1 class="wp-heading-inline">
        No item
    </h1>
    <a href="admin.php?page=cf7-push-bullet-options">Go Back</a>
    <?php return;
endif; ?>

<?php
$item = $query_result[0]; ?>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo $item->push_title; ?></h1>
    <div class="card">
        <h4 class="title">Push Type</h4>
        <?php echo $item->push_type; ?>
        <hr/>
        <h4 class="title">Push Body</h4>
        <?php echo str_replace("\n", "<br />", $item->push_body); ?>
        <hr/>
        <h4 class="title">Result</h4>
        <?php echo $item->success ? 'OK' : '<span style="color: red;">Fail</span>'; ?>
        <hr/>
        <h4 class="title">Result Details</h4>
        <pre><?php echo str_replace(['\n', ','], ["<br />", ", \n"], $item->push_reply); // break it down. It's a long JSON ?></pre>
        <hr/>
        <h4 class="title">Date</h4>
        <?php echo date_i18n(get_option('date_format') . ', ' . get_option('time_format'), wp_exif_date2ts($item->created_at)); ?>
    </div>
</div>
<br />
<a href="admin.php?page=cf7-push-bullet-options">Go Back</a>