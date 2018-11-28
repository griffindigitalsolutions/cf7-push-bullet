<?php
/**
 * View and manage settings
 * and view and manage the request history
 */
?>
<?php
$menu = '';
$menus = array(
    'history' => __('History', 'cf7-push-bullet'),
    'settings' => __('Settings', 'cf7-push-bullet'),
    'about' => __('About', 'cf7-push-bullet'));
$link = menu_page_url($this->page_slug, false);
$default_tab = 'history'; // what is the default menu
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
            $tab = $this::get_sanitized_get('tab');
            if ($tab) {
                $this->include_partial($tab);
            } else {
                // load default view
                $this->include_partial($default_tab);
            }
        ?>
    </div>
