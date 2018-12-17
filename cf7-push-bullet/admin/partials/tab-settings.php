<div class="wrap">
    <div class="ui-tabs-panel">
        <h2><?php _e('Settings', CF7_PUSH_BULLET_TEXT_DOMAIN); ?></h2>
        <?php settings_errors(); ?>
    </div>
    <div>
        <form method="post" action="options.php">
            <?php settings_fields('cf7-push-bullet-settings'); ?>
            <?php do_settings_sections('cf7-push-bullet-settings'); ?>
            <p><?php _e('Your API key is needed.', CF7_PUSH_BULLET_TEXT_DOMAIN); ?></p>
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row"><label for="cf7-push-bullet-settings-api-key">Pushbullet API Key</label></th>
                    <td>
                        <input name="cf7-push-bullet-settings-api-key" type="text" id=""
                               value="<?php echo esc_attr(get_option('cf7-push-bullet-settings-api-key')); ?>"
                               placeholder="Your Pushbullet API Key"
                               class="regular-text"/>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
</div>

<hr/>
<h3>Not sure where to get your API key?</h3>
<b>Please follow these instructions:</b>
<ul>
    <li>After you signed up, log into your account.</li>
    <li>Visit this page : https://www.pushbullet.com/#settings</li>
    <li>You can see a button 'Create Access Token'.</li>
    <li>Click on that and you will be shown a new access token similar to this: <span>o.axZLlkCOWQWhF97dmsdDsfsasdagfsDgg</span>
    </li>
    <li>Copy that to the plugin (Settings tab) and press Save Changes.</li>
    <li>A message will show up and inform you whether the token is valid or not.</li>
</ul>
<b>If you have a suggestion or found an issue</b>
<p>We welcome any suggestions or ideas. Please contact us via our website. <br/>
    You can also use the contact form to let us know of bugs or any other issues.</p>
