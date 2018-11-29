<?php
// include the required table listing class
if (!class_exists('Cf7_Push_Bullet_List_Table')) {
    require_once(CF7_PUSH_BULLET_PLUGIN_DIR . '/admin/includes/class-cf7-push-bullet-list-table.php');
}
?>
<div class="ui-tabs-panel">
    <?php $list_table = new Cf7_Push_Bullet_List_Table();
    $list_table->prepare_items();
    ?>
</div>
<div class="wrap">
    <h2><?php __('WP List Table Demo', 'cf7-push-bullet'); ?></h2>
    <div id="">
        <form id="" method="get">
            <?php $list_table->display(); ?>
        </form>
    </div>
</div>