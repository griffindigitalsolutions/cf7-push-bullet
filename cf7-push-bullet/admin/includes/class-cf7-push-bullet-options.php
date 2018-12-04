<?php
// Add options for the API key

class Cf7_Push_Bullet_Options
{
    function __construct()
    {
    }

    /**
     * Validate API key by making a test request
     * @param $option
     * @return string
     */
    public static function pre_save($option)
    {
        // before saving, test if the key is working
        $test_result = Cf7_Push_Bullet_API::make_test_request($option);

        if (!$test_result['result']) {
            add_settings_error('cf7_push_bullet_option_notice', '', $test_result['message'], 'error');
            return ''; // return empty. Don't save incorrect API key
        } else {
            add_settings_error('cf7_push_bullet_option_notice', '',  $test_result['message'], 'updated');
            return $option;
        }
    }
}
