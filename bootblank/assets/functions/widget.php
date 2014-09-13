<?php
// Creating the widget
class block_widget extends WP_Widget {

function __construct() {
    $widget_args = array('description' => 'Description de mon widget');
    $control_args = array(
        'width' => 450
    );
    parent::__construct(
        'block_widget',
        __('Block avec Lien', 'bootblank'),
        $widget_args,
        $control_args
    );
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $content = apply_filters( 'widget_content', $instance['content'] );
    $link = apply_filters( 'widget_link', $instance['link'] );
    $txtlink = apply_filters( 'widget_txtlink', $instance['txtlink'] );
    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if ( ! empty( $title ) ){
        echo $args['before_title'] . $title . $args['after_title'];

        echo $content;
        echo '<div class="link"><a href="'.$link.'">'.$txtlink.'</a></div>';
        //echo __( 'Hello, World!', 'bootblank' );
        echo $args['after_widget'];
    }
}

// Widget Backend
public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
        $title = $instance[ 'title' ];
        $content = $instance[ 'content' ];
        $link = $instance[ 'link' ];
        $txtlink = $instance[ 'txtlink' ];
    }
    else {
        $title = __( 'Votre titre', 'bootblank' );
        $content = __( '', 'bootblank' );
        $link = __( '', 'bootblank' );
        $txtlink = __( 'Bouton', 'bootblank' );
    }
    // Widget admin form
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
        <textarea  class="widefat" name="<?php echo $this->get_field_name( 'content' ); ?>" id="<?php echo $this->get_field_id( 'content' ); ?>" cols="20" rows="16" type="html" ><?php echo esc_attr( $content ); ?></textarea>
    </p>
    <hr>
    <p>
        <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Lien:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'txtlink' ); ?>"><?php _e( 'Text du lien :' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'txtlink' ); ?>" name="<?php echo $this->get_field_name( 'txtlink' ); ?>" type="text" value="<?php echo esc_attr( $txtlink ); ?>" />
    </p>
    <?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['content'] = ( ! empty( $new_instance['content'] ) ) ?  $new_instance['content'] : '';
    $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
    $instance['txtlink'] = ( ! empty( $new_instance['txtlink'] ) ) ? strip_tags( $new_instance['txtlink'] ) : '';
    return $instance;
}
} // Class block_widget ends here

// Register and load the widget
function bb_load_widget() {
    register_widget( 'block_widget' );
}
add_action( 'widgets_init', 'bb_load_widget' );
?>