<?php
/*
Plugin Name: My Current Time Plugin
Plugin URI: https://www.yourwebsite.com
Description: A plugin to display current time.
Version: 1.0
Author: IA
Author URI: https://www.yourwebsite.com
*/

function my_current_time() {
    date_default_timezone_set('Asia/Shanghai');
    $current_time = date('m/d/Y H:i:s');
    return $current_time;
}

add_shortcode('my_current_time', 'my_current_time');
?>