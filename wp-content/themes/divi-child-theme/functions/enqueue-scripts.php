<?php
function site_scripts()
{
    global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
    $rand = rand(100, 999);
    // Add parent styles
    wp_enqueue_style('divi', get_template_directory_uri() . '/style.css');

    // Adding scripts file in the footer
    wp_enqueue_script('site-js', CHILD_THEME_DIRECTORY_URI . '/js/scripts.js', array( 'jquery' ), '-' .$rand, true);
    //wp_enqueue_script('google-calendar-js', CHILD_THEME_DIRECTORY_URI . '/js/vendor/google-calendar-api.js', array(), '', true);


    // Register main stylesheet
    wp_enqueue_style('site-css', CHILD_THEME_DIRECTORY_URI . '/assets/styles/styles-cv.css', array(), '-' .$rand, 'all');

    // Comment reply script for threaded comments
    if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);
