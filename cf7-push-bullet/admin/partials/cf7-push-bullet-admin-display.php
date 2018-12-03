<?php
/**
 * View and manage settings
 * and view and manage the request history
 */
?>
<?php
$menu = '';
$menus = array(
    'history' => __('History', CF7_PUSH_BULLET_TEXT_DOMAIN),
    'settings' => __('Settings', CF7_PUSH_BULLET_TEXT_DOMAIN),
    'about' => __('About', CF7_PUSH_BULLET_TEXT_DOMAIN));
$link = menu_page_url($this->page_slug, false);
$default_tab = 'history'; // what is the default menu

$tab = $this::get_sanitized_get('tab');
$action = $this::get_sanitized_get('action');

// if we have an action, don't show all the tabs etc.
if ($action) {
    if ($action == 'view') {
        require_once $this::get_admin_path() . '/partials/view-item.php';
        return;
    }
}

// TODO: move this to plugin variable (plugin global setting)
foreach ($menus as $slug => $label) {
    $class = 'nav-tab'; // will get overwritten if active
    if (isset($_REQUEST['tab'])) {
        if ($slug == $_REQUEST['tab']) {
            $class = 'nav-tab nav-tab-active';
        }
    } elseif ($default_tab == $slug) {
        $class = 'nav-tab nav-tab-active';
    }

    $menu .= '<a id="' . $slug . '" class="' . $class . '" href="' . $link . '&tab=' . $slug . '">' . $label . '</a>';
}

?>

<div class="wrap">
    <h2 class="nav-tab-wrapper"><?php echo $menu; ?></h2>
    <?php
    if ($tab) {
        $this->include_partial($tab);
    } else {
        // load default view
        $this->include_partial($default_tab);
    }
    ?>
</div>
