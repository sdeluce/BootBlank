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

function bootblank_dashboard_help() {
    echo '<p style="text-align:center;"><img src="'.get_template_directory_uri().'/img/logo.png"/></p>';
}
//Deletes empty classes and removes the sub menu class --front--
function change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/','/ class="dropdown" /',$menu);
    return $menu;
}

// Préchargement des pages --front--
function bootblank_prefetch() {
    if ( is_single() ) {  ?>
        <!-- Préchargement de la page d\'accueil -->
        <link rel="prefetch" href="<?php echo home_url(); ?>" />
        <link rel="prerender" href="<?php echo home_url(); ?>" />

        <!-- Préchargement de l\'article suivant -->
        <link rel="prefetch" href="<?php echo get_permalink( get_adjacent_post(false,'',true) ); ?>" />
        <link rel="prerender" href="<?php echo get_permalink( get_adjacent_post(false,'',true) ); ?>" />
   <?php
   }
}

/** Début Minification des fichiers HTML **/
function bootblank_html_minify_start() {
    ob_start( 'bootblank_html_minyfy_finish' );
}

function bootblank_html_minyfy_finish( $html ) {

    // Suppression des commentaires HTML, sauf les commentaires conditionnels pour IE
    $html = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $html);

    // Suppression des espaces vides
    $html = str_replace(array("\r\n", "\r", "\n", "\t"), '', $html);
    while ( stristr($html, '  '))
        $html = str_replace('  ', ' ', $html);

    return $html;
}
/** Fin Minification des fichiers HTML **/

// Encapsulage des videos
function standard_wrap_embeds( $html, $url, $args ) {
    if( 'video' == get_post_format( get_the_ID() ) ) {
        $html = '<div class="video-wrapper">' . $html . '</div>';
    } // end if
    return $html;
} // end standard_wrap_embebds

// Posts Formats
$post_formats = array( 'aside', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' );

function favicons() {
    $icosource = file_get_contents( get_template_directory_uri().'/assets/icons/icons.html' , "r");
    $head_ico = str_replace("%url%",  get_template_directory_uri(), $icosource);
    echo $head_ico;
}
add_action('wp_head', 'favicons');

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

// Remove Actions
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator'); // Remove Wordpress version

// Add Filter
add_filter( 'login_errors', 'bootblank_login_obscure' ); // Remove login error
// add_filter('jpeg_quality', function($arg){return 80;}); // Compression des images à 80% au lieu de 90%
add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) ); // Idem php < 5.3

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
?>