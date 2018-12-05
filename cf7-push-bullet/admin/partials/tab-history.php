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
    <div class="wrap">
        <h2><?php _e('Pushbullet Requests', CF7_PUSH_BULLET_TEXT_DOMAIN); ?></h2>
        <div>
            <form method="get" action="?page=cf7-push-bullet-options">
                <input type="hidden" name="page" value="cf7-push-bullet-options">
                <?php $list_table->display(); ?>
                <?php if ($list_table->has_items()): ?>
                <?php else: ?>
                    <div class=""><p><?php echo $list_table->no_items(); ?></p></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

