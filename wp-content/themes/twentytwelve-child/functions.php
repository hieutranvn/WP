<?php

/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
function favicon_link() {
    echo '<link rel="shortcut icon" 
        type="image/x-icon" href="/favicon.ico" />' . "\n";
}

add_action('wp_head', 'favicon_link');

function twentytwelve_wp_title1($title, $sep) {
    global $paged, $page;
    if (is_feed())
        return $title;

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'twentytwelve'), max($paged, $page));
    return $title;
}

//add_filter('wp_title', 'twentytwelve_wp_title1', 10, 2);
/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function my_child_theme_setup() {
    load_child_theme_textdomain('twentytwelve-child', 
            get_stylesheet_directory() . '/languages');
}
//add_action('after_setup_theme', 'my_child_theme_setup');

function more_title() {
    //echo bloginfo('name');
    _e( 'hieu tran', 'twentytwelve-child' );
}

//add_action('wp_title', 'more_title');

if (!function_exists('test_function')) {

    function test_function() {
        //something could be added to here
    }

}
?>