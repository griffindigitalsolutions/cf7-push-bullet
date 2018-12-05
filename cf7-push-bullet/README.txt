=== Plugin Name ===
Contributors: cristianrat
Donate link: https://griffin.digital/plugin-contact-form-7-push-bullet-integration
Tags: Contact Form 7, CF7, PushBullet, push bullet, contact form 7 push bullet, cf7 pushbullet, cf7 push bullet
Requires at least: 4.0
Tested up to: 4.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows form submissions to be sent to a user's device(s) via the PushBullet API (https://www.pushbullet.com)

== Description ==

Allows form submissions to be sent to a user's device via the PushBullet API (https://www.pushbullet.com)
All form submissions are saved to the database (whether successful or not) giving you peace of mind that your submissions
won't be lost if either emails or PushBullet API are not working.

After installing and activating the plugin, you need to get your PushBullet API key and save it.
Without it, all requests will fail, but they will be saved to the database.

== Installation ==

1. Upload `cf7-push-bullet.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Save your PushBullet API key in the settings tab (Side menu : Contact > Push Bullet > Settings)

== Frequently Asked Questions ==

= Do I need a PushBullet account? =

Yes.

= Where do I get my API key from? =

After you signed up, log into your account.
Visit this page : https://www.pushbullet.com/#settings
You can see a button 'Create Access Token'.
Click on that and you will be shown a new access token similar to this:
o.axZLlkCOWQWhF97dmsdDsfsasdagfsDgg

Copy that to the plugin (Settings tab) and press Save Changes.
A message will show up and inform you whether the token is valid or not.

= I have a suggestion or found an issue =

We welcome any suggestions or ideas. Please contact us via our website.
You can also use the contact form to let us know of bugs or any other issues.


== Screenshots ==

1. History view of all submissions captured from Contact Form 7
2. Setting view where you add your API Key
3. API Key was added and confirmed to be correct
4. API Key was tested and invalidated. It is not saved.
5. Form getting filled in
6. PushBullet notification received on Android App, after form was submitted
7. The same notification was received at the same time on browser extension and visible in webpage (pushbullet.com)



== Changelog ==

= 1.0 =
* First version

== Upgrade Notice ==

= 1.0 =
First release

== Support ==

If you need support, please use the plugin site on wordpress.org or see our website (use the contact form)