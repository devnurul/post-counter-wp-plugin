<?php
/*
Plugin Name: qppcounter
Plugin URI: http://amaderit.com
Description: This plugin is use for wordpress post word count on the buttom in in post.
Version: 1.0.0
Author: devnurul
Author URI: http:/devnurul.me
License: GPL2 or leter
Text Domain : qppcounter
Domain Path: /languages/
*/


// function appcounter_activation_hook(){

// };

// function appcounter_deactivation_hook(){

// };

// register_activation_hook(__FILE__, "appcounter_activation_hook");
// register_deactivation_hook(__FILE__, "appcounter_deactivation_hook");


function wppcounter_load_textdomain(){
    load_plugin_textdomain("qppcounter", false, dirname(__FILE__)."/languages");
}
add_action("plugin_loaded", "wppcounter_load_textdomain");

function wppcounter_count_words($content){
    $stripped_content = strip_tags($content);
    $wordsn = str_word_count($stripped_content);
    $label = __('Total Number of Words', "qppcounter");
    $content.=sprintf("<h3> %s : %s </h3>", $label, $wordsn);

    return $content;

}
add_filter('the_content','wppcounter_count_words');

function wppcounter_post_reading_times($content){
    $stripped_content  = strip_tags($content);
    $wordn = str_word_count($stripped_content);
    $read_time_min = floor($wordn/200);
    $read_time_sec = floor($wordn%200 /(200/60));
    $label = __('Reading time', 'qppcounter');

    $content.= sprintf("<h4> %s : %s min %s sec </h4>", $label,  $read_time_min,  $read_time_sec );
    return $content;
}

add_filter('the_content', 'wppcounter_post_reading_times');