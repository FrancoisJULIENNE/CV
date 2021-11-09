<?php
/**
* Enables the HTTP Strict Transport Security (HSTS) header in WordPress.
* Includes preloading with subdomain support.
*/
function tg_enable_strict_transport_security_hsts_header_wordpress()
{
    header('Strict-Transport-Security: max-age=10886400; includeSubDomains; preload');
}
add_action('send_headers', 'tg_enable_strict_transport_security_hsts_header_wordpress');


/** add google code */
add_action('wp_head', 'my_analytics', 20);
function my_analytics()
{
    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-44471636-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-44471636-1');
    </script>
    <!-- <script data-ad-client="ca-pub-3477578872405530" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
    <?php
}

/** add preloading */
// function wpb_add_preloader()
// {
//     echo '<div class="preloader"></div>';
// }
//     add_action('wp_body_open', 'wpb_add_preloader');
    
/**
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

add_image_size('medium_large', '768', '0', false);
add_image_size('1536x1536', '1536', '1536', false);
add_image_size('2048x2048', '2048', '2048', false);
add_image_size('et-pb-post-main-image', '400', '250', true);
add_image_size('et-pb-post-main-image-fullwidth', '1080', '675', true);
add_image_size('et-pb-portfolio-image', '400', '284', true);
add_image_size('et-pb-portfolio-module-image', '510', '382', true);
add_image_size('et-pb-portfolio-image-single', '1920', '9999', false);
add_image_size('et-pb-gallery-module-image-portrait', '400', '516', true);
add_image_size('et-pb-post-main-image-fullwidth-large', '2880', '1800', true);
add_image_size('et-pb-image--responsive--desktop', '1280', '720', true);
add_image_size('et-pb-image--responsive--tablet', '980', '551', true);
add_image_size('et-pb-image--responsive--phone', '480', '270', true);
add_image_size('medium_large', '768', '0', false);

// Add custom sizes to WordPress Media Library
function drollic_choose_sizes($sizes)
{
    return array_merge($sizes, array(
        'et-pb-portfolio-image-single' => __('Desktop Bando 1920'),
        'et-pb-post-main-image-fullwidth' => __('Desktop 1080'),
        'et-pb-image--responsive--tablet' => __('Tablette 900'),
        'et-pb-image--responsive--phone' => __('Mobile 480'),
    ));
}
add_filter('image_size_names_choose', 'drollic_choose_sizes');

//remove page link for images
function wpb_imagelink_setup()
{
    $image_set = get_option('image_default_link_type');
     
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);


/************* DEFINE CONSTANTS *******************/
// About the theme author
define('THEME_AUTHOR_NAME', "François JULIENNE");
define('THEME_AUTHOR_URL', "https://www.francoisjulienne.com/");

// Theme constant
define('CHILD_THEME_DIRECTORY', get_stylesheet_directory());
define('CHILD_THEME_DIRECTORY_URI', get_stylesheet_directory_uri());

/************* LOAD FUNCTIONS *********************/
// Uncomment to activate
// Register scripts and stylesheets
require_once(CHILD_THEME_DIRECTORY . '/functions/enqueue-scripts.php');

// charge les icon wordpress seulement pour l'admin
add_action('wp_enqueue_scripts', 'go_dequeue_dashicons');
function go_dequeue_dashicons()
{
    if (! is_user_logged_in() && !is_page(array( 9, 10 )) && !in_category(array( 29, 2 ))) {
        wp_deregister_style('dashicons');
    }
}

// ******************** Crunchify Tips - Clean up WordPress Header START ********************** //
function crunchify_remove_version()
{
    return '';
}
add_filter('the_generator', 'crunchify_remove_version');
 
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
 
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');