<?php
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
add_action('get_header', 'bootblank_html_minify_start');
/** Fin Minification des fichiers HTML **/

/*------------------------------------*\
    Defer js
\*------------------------------------*/
function defer_parsing_of_js ( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url;
    return "$url' defer";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );

remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
// remove_action('wp_head', 'wp_dlmp_l10n_style' );
// remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

/*------------------------------------*\
    BackCompat wp 3.8
\*------------------------------------*/
if ( version_compare( $GLOBALS['wp_version'], '3.8', '<' ) ) {
    require get_template_directory() . '/assets/functions/back-compat.php';
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
add_action('wp_head', 'bootblank_prefetch'); // Optimisation
?>