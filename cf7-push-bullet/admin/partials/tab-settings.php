<div class="wrap">
    <div class="ui-tabs-panel">
        <h2><?php _e('Settings', CF7_PUSH_BULLET_TEXT_DOMAIN); ?></h2>
        <?php settings_errors(); ?>
    </div>
    <div>
        <form method="post" action="options.php">
            <?php settings_fields('cf7-push-bullet-settings'); ?>
            <?php do_settings_sections('cf7-push-bullet-settings'); ?>
            <p><?php _e('You API key is needed.', CF7_PUSH_BULLET_TEXT_DOMAIN); ?></p>
            <table class="form-table">

                <tbody>
                <tr>
                    <th scope="row"><label for="api-key">Push Bullet API Key</label></th>
                    <td>
                        <input name="api-key" type="text" id=""
                               value="<?php echo esc_attr( get_option('api-key') ); ?>"
                               placeholder="Your Push Bullet API Key"
                               class="regular-text"/>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
</div>

<hr />
<h3>Not sure where to get your API key?</h3>
<p>Please follow these instructions:</p>
