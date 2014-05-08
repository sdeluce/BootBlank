<?php
/*------------------------------------*\
    Sidebar Class Bootstrap
\*------------------------------------*/
function bootblank_main_class() {
    if ( is_active_sidebar('widget-area-1') && is_active_sidebar('widget-area-2') ) {
        echo 'col-sm-6';
    } else if ( is_active_sidebar('widget-area-1') || is_active_sidebar('widget-area-2') ) {
        echo 'col-sm-9';
    } else {
        // Classes on full width pages
        echo 'col-sm-12';
    }
}
function bootblank_sidebar_class() {
    echo 'col-sm-3';
}

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Login override CSS  --Front--
function bootblank_login_css()  {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/login.css?v=1.0.0" />';
}
add_action('login_head', 'bootblank_login_css'); // Add Override Login Css

function bootblank_dashboard_help() {
    echo '<p style="text-align:center;"><img src="'.get_template_directory_uri().'/img/logo.png"/></p>';
}
//Deletes empty classes and removes the sub menu class --front--
function change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/','/ class="dropdown" /',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','change_submenu_class'); // Add class menu

// Encapsulage des videos
function standard_wrap_embeds( $html, $url, $args ) {
    if( 'video' == get_post_format( get_the_ID() ) ) {
        $html = '<div class="video-wrapper">' . $html . '</div>';
    } // end if
    return $html;
} // end standard_wrap_embebds
add_filter( 'embed_oembed_html', 'standard_wrap_embeds', 10, 3 ) ; // Video responsive

// Posts Formats
$post_formats = array( 'aside', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' );

function favicons() {
    $icosource = file_get_contents( get_template_directory_uri().'/assets/icons/icons.html' , "r");
    $head_ico = str_replace("%url%",  get_template_directory_uri(), $icosource);
    echo $head_ico;
}
add_action('wp_head', 'favicons');

// Remove jQuery lib
add_action( 'admin_enqueue_scripts', 'remove_jquery' );
function remove_jquery()
{
    wp_deregister_script('jquery');
}

// Obscure login screen error messages
function bootblank_login_obscure(){
    return '<strong>Sorry</strong>: Think you have gone wrong somwhere!';
}

// Posts Formats
$post_formats = array( 'aside', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' );

// Add Dashicons in the theme
function bootblank_dashicons() {
    wp_enqueue_style('dashicons');
}
// add_action('wp_enqueue_scripts', 'bootblank_dashicons'); // Utilisation de Dashicon WP 3.8

// Remove Actions
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator'); // Remove Wordpress version

// Add Filter
add_filter( 'login_errors', 'bootblank_login_obscure' ); // Remove login error
// add_filter('jpeg_quality', function($arg){return 80;}); // Compression des images à 80% au lieu de 90%
add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) ); // Idem php < 5.3

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

/*------------------------------------*\
    Move admin bar
\*------------------------------------*/
function fb_move_admin_bar() {
    $adminbar = file_get_contents( get_template_directory_uri().'/css/adminbar.css' , "r");
    echo '<style type="text/css">'.$adminbar.'</style>';
}
// en front-end
add_action( 'wp_head', 'fb_move_admin_bar' );

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here
require_once ('optim.php');
require_once ('custompost.php');
// require_once ('widget.php');
// require_once ('woosupport.php');
?>