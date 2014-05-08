<?php
/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/
function add_menu_icons_styles(){
?>

<style>
#adminmenu #menu-posts-slider div.wp-menu-image:before {
    content: "\f115";
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );

// Create 1 Custom Post type for a Demo, called bootblank
function create_post_type_bootblank()
{
    register_taxonomy_for_object_type('category', 'bootblank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'bootblank');
    register_post_type('slider', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Sliders', 'bootblank'), // Rename these to suit
            'singular_name' => __('Slider', 'bootblank'),
            'add_new' => __('Ajouter un slider', 'bootblank'),
            'add_new_item' => __('Ajouter un slider', 'bootblank'),
            'edit' => __('Editer un slider', 'bootblank'),
            'edit_item' => __('Editer un slider', 'bootblank'),
            'new_item' => __('Nouveau slider', 'bootblank'),
            'view' => __('Voir le slider', 'bootblank'),
            'view_item' => __('Voir le slider', 'bootblank'),
            'search_items' => __('Chercher un slider', 'bootblank'),
            'not_found' => __('Aucun slider trouvé', 'bootblank'),
            'not_found_in_trash' => __('Pas de slider dans la corbeille', 'bootblank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'menu_position'=>55,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom BootBlank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
         'post_tag',
         'category'
        ) // Add Category and Post Tags support
    ));
}
add_action('init', 'create_post_type_bootblank'); // Add our BootBlank Custom Post Type

/*------------------------------------*\
    Create menu separator
\*------------------------------------*/
add_action('admin_menu','admin_menu_separator');
function add_admin_menu_separator($position) {

    global $menu;
    $index = 0;

    foreach($menu as $offset => $section) {
        if (substr($section[2],0,9)=='separator')
            $index++;
        if ($offset>=$position) {
            $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
            break;
        }
    }

    ksort( $menu );
}

/*------------------------------------*\
    Adds menu separator
\*------------------------------------*/
function admin_menu_separator() {

    // Adds custom separator after comments
    add_admin_menu_separator(53);
}
/*------------------------------------*\
    Colonnnes personnalisées
\*------------------------------------*/
function custom_slider_columns_type($columns) {

    $columns['title'] = 'Titre du slider';
    $columns['date'] = 'Créé le';

    $columns = array_slice($columns, 0, 1) + array( 'thumbnail' =>'Miniature') + array_slice($columns, 1, count($columns)-1, true );

    return $columns;
}
add_filter('manage_edit-slider_columns', 'custom_slider_columns_type');

function custom_slider_columns_content($column) {
    global $post;

    switch ($column) {
        case 'thumbnail':
            the_post_thumbnail( 'vignette' );
            break;
        case 'publication_date':
            $args = array( 'post_type' => 'bootblank', 'numberposts' => -1, 'meta_query' => array( array( 'key' => '_book_info_author', 'value' => $post->ID ) ) );
            $books = get_posts($args);
            echo count($books);
            break;
    }
}
add_action('manage_slider_posts_custom_column', 'custom_slider_columns_content');

/*------------------------------------*\
    Add Color to editor Functions
\*------------------------------------*/
function my_mce4_options( $init ) {
$default_colours = '
    "000000", "Black",        "993300", "Burnt orange", "333300", "Dark olive",   "003300", "Dark green",   "003366", "Dark azure",   "000080", "Navy Blue",      "333399", "Indigo",       "333333", "Very dark gray",
    "800000", "Maroon",       "FF6600", "Orange",       "808000", "Olive",        "008000", "Green",        "008080", "Teal",         "0000FF", "Blue",           "666699", "Grayish blue", "808080", "Gray",
    "FF0000", "Red",          "FF9900", "Amber",        "99CC00", "Yellow green", "339966", "Sea green",    "33CCCC", "Turquoise",    "3366FF", "Royal blue",     "800080", "Purple",       "999999", "Medium gray",
    "FF00FF", "Magenta",      "FFCC00", "Gold",         "FFFF00", "Yellow",       "00FF00", "Lime",         "00FFFF", "Aqua",         "00CCFF", "Sky blue",       "993366", "Brown",        "C0C0C0", "Silver",
    "FF99CC", "Pink",         "FFCC99", "Peach",        "FFFF99", "Light yellow", "CCFFCC", "Pale green",   "CCFFFF", "Pale cyan",    "99CCFF", "Light sky blue", "CC99FF", "Plum",         "FFFFFF", "White"
';
$custom_colours = '
    "e14d43", "Color 1 Name", "d83131", "Color 2 Name", "ed1c24", "Color 3 Name", "f99b1c", "Color 4 Name", "50b848", "Color 5 Name", "00a859", "Color 6 Name",   "00aae7", "Color 7 Name", "282828", "Color 8 Name"
';
$init['textcolor_map'] = '['.$custom_colours.','.$default_colours.']';
return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

?>