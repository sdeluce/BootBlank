<?php
/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/
function add_menu_icons_styles(){
?>

<style>
#adminmenu #menu-posts-bootblank div.wp-menu-image:before {
    content: "\f328";
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
    register_post_type('bootblank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('BootBlank', 'bootblank'), // Rename these to suit
            'singular_name' => __('BootBlank', 'bootblank'),
            'add_new' => __('Add New', 'bootblank'),
            'add_new_item' => __('Add New BootBlank Custom Post', 'bootblank'),
            'edit' => __('Edit', 'bootblank'),
            'edit_item' => __('Edit BootBlank Custom Post', 'bootblank'),
            'new_item' => __('New BootBlank Custom Post', 'bootblank'),
            'view' => __('View BootBlank Custom Post', 'bootblank'),
            'view_item' => __('View BootBlank Custom Post', 'bootblank'),
            'search_items' => __('Search BootBlank Custom Post', 'bootblank'),
            'not_found' => __('No BootBlank Custom Posts found', 'bootblank'),
            'not_found_in_trash' => __('No BootBlank Custom Posts found in Trash', 'bootblank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'menu_position'=>32,
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
    add_admin_menu_separator(31);
}

/*------------------------------------*\
    Champs personnalisées
\*------------------------------------*/
global $myposttype;
global $myCustomTypeOptions;
$myposttype='bootblank'; //id de mon custom post

$myCustomTypeOptions = array (
    array(
        'name' => 'Mon champ text',
        'desc' => 'Description 1',
        'id' => $myposttype.'_champtexte',
        'type' => 'text',
        'std' => ''),
     array(
        'name' => 'Mon textarea',
        'desc' => 'Description 2',
        'id' => $myposttype.'_textarea',
        'type' => 'textarea',
        'std' => 'Youpi'),
    array(
        'name' => 'Mon select',
        'desc' => '',
        'id' => $myposttype.'_choix',
        'type' => 'select',
        'options' => array('choix 1','choix 2','choix 3'),
        'std' => 'choix 2'),
    array(
        'name' => 'Mon checkbox',
        'desc' => 'Case Ã  cocher',
        'id' => $myposttype.'_case',
        'type' => 'checkbox',
        'std' => '1')
);

/************** Ã  la fin du formulaire, ajout des champs dÃ©finis dans $myCustomTypeOptions ***********/
add_action('edit_form_advanced', 'moncustomposttype_form');
add_action('save_post', 'moncustomposttype_save');
function moncustomposttype_form(){

    global $myposttype;
    global $myCustomTypeOptions;

    if((isset($_GET['post_type'])) and ($_GET['post_type']==$myposttype)) /* formulaire d'ajout */
    {
        echo '<div class="meta-box-sortables ui-sortable">';
        /* formulaire vide (ou avec les valeurs par dÃ©faut) */
        foreach ($myCustomTypeOptions as $o)
        {
            echo '<div class="postbox">';
            echo '<h3 class="hndle"><span>'.$o['name'].'</span></h3><div class="inside"><label class="screen-reader-text" for="'.$o['id'].'">'.$o['name'].'</label>';

            //fonction pour afficher le bon html en fonction du type, dÃ©finie ci-aprÃ¨s
            echo get_champ($o,$o['std']);

            if($o['desc']!='')
                echo '<p>'.$o['desc'].'</p>';

            echo '</div></div>';
        }
        echo '</div>';

    }
    else{
        if(!isset($_GET['post_type']))
        {
            if(isset($_GET['post']))
            {
                if(get_post_type($_GET['post'])==$myposttype) /* formulaire de modification */
                {
                    $id=$_GET['post'];

                    /* formulaire prÃ©rempli avec les valeurs prÃ©-existantes */
                    echo '<div class="meta-box-sortables ui-sortable">';
                    foreach ($myCustomTypeOptions as $o)
                    {
                        echo '<div class="postbox">';
                        echo '<h3 class="hndle"><span>'.$o['name'].'</span></h3><div class="inside"><label class="screen-reader-text" for="'.$o['id'].'">'.$o['name'].'</label>';

                        echo get_champ($o,get_post_meta($id, $o['id'], true));

                        if($o['desc']!='')
                            echo '<p>'.$o['desc'].'</p>';

                        echo '</div></div>';
                    }
                    echo '</div>';
                }
            }
        }
    }
}

function get_champ($o,$val)
{
    switch ($o['type'])
    {
        case 'textarea':
            echo '  <textarea rows="2" cols="40" name="'.$o['id'].'" id="'.$o['id'].'">'.$val.'</textarea>';
            break;
        case 'text':
            echo '  <input type="text" style="width:100%;" name="'.$o['id'].'" id="'.$o['id'].'" value="'.$val.'"/>';
            break;
        case 'checkbox':
            echo '<input type="checkbox" name="'.$o['id'].'" id="'.$o['id'].'" value="1" ';
            if($val==1)
                echo 'checked="checked';
            echo '/><label for="'.$o['id'].'">'.$o['name'].'</label>';
            break;
        case 'select':
            echo '  <select name="'.$o['id'].'" style="width:100%;" id="'.$o['id'].'"><option value="">-</option>';
            foreach($o['options'] as $opt)
            {
                echo '<option value="'.$opt.'"';
                if($opt==$val)
                    echo 'selected="selected"';
                echo '>'.$opt.'</option>';
            }
            echo'</select>';
            break;
    }

}
/***************** Lors de la sauvegarde, ajout/modification d'un custom field par champs de $myCustomTypeOptions ***********/
function moncustomposttype_save(){

    global $myposttype;
    global $myCustomTypeOptions;

    if(isset($_POST['post_ID']))
    {
        $id=$_REQUEST['post_ID'];
        if(get_post_type($id)==$myposttype) /* si on Ã©dite bien un post du type $myposttype */
        {
            foreach ($myCustomTypeOptions as $o)
            {
                if(isset($_POST[$o['id']])) {
                    update_post_meta($id, $o['id'], $_POST[$o['id']]);
                }
                elseif($o['type']=='checkbox') {
                    update_post_meta($id, $o['id'], 0);
                }
            }
        }
    }
}
/*------------------------------------*\
    Colonnnes personnalisées
\*------------------------------------*/
function custom_bootblank_columns_type($columns) {

    $columns['title'] = 'Titre du BootBlank';
    $columns['date'] = 'Créé le';

    $columns = array_slice($columns, 0, 1) + array( 'thumbnail' =>'Miniature') + array_slice($columns, 1, count($columns)-1, true );

    return $columns;
}
add_filter('manage_edit-bootblank_columns', 'custom_bootblank_columns_type');

function custom_bootblank_columns_content($column) {
    global $post;

    switch ($column) {
        case 'thumbnail':
            the_post_thumbnail( 'small' );
            break;
        case 'publication_date':
            $args = array( 'post_type' => 'bootblank', 'numberposts' => -1, 'meta_query' => array( array( 'key' => '_book_info_author', 'value' => $post->ID ) ) );
            $books = get_posts($args);
            echo count($books);
            break;
    }
}
add_action('manage_bootblank_posts_custom_column', 'custom_bootblank_columns_content');

?>