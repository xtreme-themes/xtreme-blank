<?php
/**
 * Xtreme Example Widget
 * No useful function, only to understand the class and his methods
 * 
 * @see   http://codex.wordpress.org/Widgets_API
 */

add_action( 'widgets_init', 'register_xtreme_example_widget' );
// Register Xtreme_Example_Widget widget
function register_xtreme_example_widget() {
    register_widget( 'Xtreme_Example_Widget' );
}

class Xtreme_Example_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 * 
	 * @return void
	 */
	public function __construct() {
		// widget actual processes
		
		parent::__construct(
			'xtreme_example_widget', // Base ID
			__( 'Xtreme Example Widget Title', XF_TEXTDOMAIN ), // Name
			array( 'description' => __( 'A Foo Widget', XF_TEXTDOMAIN ), ) // Args
		);
	}
	
	/**
	 * Front-end display of widget.
	 *
	 * @see    WP_Widget::widget()
	 * @param  array $args     Widget arguments.
	 * @param  array $instance Saved values from database.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		echo __( 'Hello  World!', XF_TEXTDOMAIN );
		echo $args['after_widget'];
	}
	
	/**
	 * Back-end widget form.
	 *
	 * @see    WP_Widget::form()
	 * @param  array $instance Previously saved values from database.
	 * @return void
	 */
 	public function form( $instance ) {
		// outputs the options form on admin
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php 
				echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}
	
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see    WP_Widget::update()
	 * @param  array $new_instance Values just sent to be saved.
	 * @param  array $old_instance Previously saved values from database.
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		return $instance;
	}
	
}