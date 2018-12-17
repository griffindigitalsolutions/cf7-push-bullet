<?php

/**
 * Class Cf7_Push_Bullet_API
 * Makes the requests to the Pushbullet API
 * Test and actual request. Saves to database as well
 */
class Cf7_Push_Bullet_API
{

    protected static $PUSH_API_URL = 'https://api.pushbullet.com/v2/pushes';
    protected static $TEST_API_URL = 'https://api.pushbullet.com/v2/users/me';
    protected static $API_KEY = '';
    protected static $push_type = 'note';

    function __construct()
    {
        // TODO v1.1 get the API key from DB, rather than calling it later when used.
        // We could skip API call, just save to DB (validate key first)
    }

    /** Send Pushbullet (via another function) and save to database
     * TODO in 1.2: move DB functionality to DB class
     * @param $form
     * @return void
     * @since 1.0.0
     */
    public static function send($form)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'cf7_push_bullet';
        $form_id = '';

        if (!isset($form->posted_data) && class_exists('WPCF7_Submission')) {
            // Contact Form 7 version 3.9 removed $cf7->posted_data
            // Get data from API
            $submission = WPCF7_Submission::get_instance();
            if ($submission) {
                $form_id = $form->id();
                $data = array();
                $data['title'] = sprintf(__('New submission: form %s on %s', CF7_PUSH_BULLET_TEXT_DOMAIN), $form->title(), get_site_url());
                $data['id'] = $form->id();
                $data['posted_data'] = $submission->get_posted_data();
//                $data['uploaded_files'] = $submission->uploaded_files(); // we don't support files yet
                $data['WPCF7_ContactForm'] = $form;
                $form = (object)$data;
            } else {
                // if form is not present, not much we can do
                return;
            }
        }

        // Insert form values in custom data entry table
        $skip_fields = [
            '_wpcf7',
            '_wpcf7_version',
            '_wpcf7_locale',
            '_wpcf7_unit_tag',
            '_wpcf7_is_ajax_call',
            '_wpcf7_container_post'
        ];
        if (!empty($form)) {
            // Some fields don't need to be saved
            $push_body = '';
            foreach ($form->posted_data as $k => $v) {
                if (in_array($k, $skip_fields)) {
                    continue;
                } else {
                    // for checkboxes
                    if (is_array($v)) {
                        $v = implode("\n", $v);
                    }

                    $push_body .= htmlspecialchars($k) . ': ' . htmlspecialchars($v) . "\n";
                }
            }

            // we have all we need
            // send the bullet
            $push_result = Cf7_Push_Bullet_API::make_request($data['title'], $push_body, get_option('cf7-push-bullet-settings-api-key'));


            $sql = 'INSERT INTO ' . $table_name . '
                           (
                               `form_id`, 
                               `push_type`, 
                               `push_title`, 
                               `push_body`, 
                               `push_reply`, 
                               `success`
                           ) 
                    VALUES (%d, %s, %s, %s, %s, %d)';
            $wpdb->query(
                $wpdb->prepare($sql,
                    [
                        $form_id,
                        self::$push_type,
                        $data['title'],
                        $push_body,
                        $push_result['body'],
                        (int)$push_result['result'] // boolean to int > 0 or 1
                    ])
            );
        }
    }

    /** Make test request
     * @param $token
     * @return array
     * @since 1.0.0
     */
    public static function make_test_request($token)
    {
        $result = array('result', 'message');

        $response = wp_remote_get(Cf7_Push_Bullet_API::$TEST_API_URL, array(
                'timeout' => 15,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('Authorization' => 'Bearer ' . $token . ''),
                'cookies' => array()
            )
        );

        $response_code = wp_remote_retrieve_response_code($response);

        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            $result['result'] = false;
            $result['message'] = $error_message;
        } else {
            $response_body = json_decode($response['body']);


            // if code is false, request failed
            if ($response_code != 200) {
                $message = __('Invalid API Key:', CF7_PUSH_BULLET_TEXT_DOMAIN);
                $message .= '<br />';
                $message .= sprintf(__('%s', CF7_PUSH_BULLET_TEXT_DOMAIN), $response_body->error->message);

                $result['message'] = $message;
                $result['result'] = false;
            } elseif (array_key_exists('body', $response)) {
                $message = __('Test successful.', CF7_PUSH_BULLET_TEXT_DOMAIN);
                $message .= '<br />';
                $message .= sprintf(__('Got user %s with email %s.', CF7_PUSH_BULLET_TEXT_DOMAIN), $response_body->name, $response_body->email);

                $result = array(
                    'result' => true,
                    'message' => $message
                );
            } else {
                $result = array(
                    'result' => false,
                    'message' => sprintf(__('There was an issue validating your API Key.', CF7_PUSH_BULLET_TEXT_DOMAIN))
                );
            }
        }

        return $result;
    }

    /** Make Pushbullet request
     * @param $title
     * @param $body
     * @param $token
     * @return bool
     * @since 1.0.0
     */
    public static function make_request($title, $body, $token)
    {
        $response = wp_remote_post(Cf7_Push_Bullet_API::$PUSH_API_URL,
            array(
                'method' => 'POST',
                'timeout' => 15,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('Authorization' => 'Bearer ' . $token),
                'body' => array(
                    'type' => 'note',
                    'title' => $title,
                    'body' => $body,
                ),
                'cookies' => array()
            )
        );

        if (is_wp_error($response)) {
            $result['result'] = false;
            $result['body'] = $response->get_error_message();
        } else {
            $return_code = wp_remote_retrieve_response_code($response);
            if ($return_code == 200) {
                $result['result'] = true;
                $result['body'] = $response['body'];
            } else {
                $result['result'] = false;
                $result['body'] = $response['body'];
            }
            return $result;
        }
    }


}