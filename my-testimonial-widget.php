<?php
class my_testimonial_widget extends WP_Widget {

	// constructor wp_my_plugin
	function __construct() {
		parent::__construct(false, $name = __('My Widget', 'my_testimonial_widget'));
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_my_plugin");'));

// widget form creation
function form($instance) {

// Check values
if( $instance) {
     $title = esc_attr($instance['title']);
     $text = esc_attr($instance['text']);
     $textarea = esc_textarea($instance['textarea']);
} else {
     $title = '';
     $text = '';
     $textarea = '';
}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'my_testimonial_widget'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'my_testimonial_widget'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'my_testimonial_widget'); ?></label>
<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
</p>
<?php
}

// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['text'] = strip_tags($new_instance['text']);
      $instance['textarea'] = strip_tags($new_instance['textarea']);
     return $instance;
}

// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $text = $instance['text'];
   $textarea = $instance['textarea'];
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text my_testimonial_widget_box">';

   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }

   // Check if text is set
   if( $text ) {
      echo '<p class="my_testimonial_widget_text">'.$text.'</p>';
   }
   // Check if textarea is set
   if( $textarea ) {
     echo '<p class="my_testimonial_widget_textarea">'.$textarea.'</p>';
   }
   echo '</div>';
   echo $after_widget;
}
?>

