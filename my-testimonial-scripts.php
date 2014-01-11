<?php
function my_testimonial_js() {
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script('jquery_validate', plugins_url('jquery.validate.min.js',__FILE__ ));
		wp_enqueue_script('jquery_validate', plugins_url('scripts/jquery.min.js',__FILE__ ));
		wp_enqueue_script('jquery_validate', plugins_url('scripts/jquery.form.js',__FILE__ ));
		wp_enqueue_script('jquery-ui-datepicker','', array('jquery', 'jquery-ui-core'));
		wp_enqueue_style('jquery.ui.theme', plugins_url('',__FILE__ ).'/jquery-ul.css');
}
add_action( 'admin_init','my_testimonial_js');

 // Add code for upload field

function my_testimonial_admin_scripts() { // function to load scripts
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', WP_PLUGIN_URL.'/datafeedr-ads/my-script.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}

function my_testimonial_admin_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'my_testimonial_admin_scripts');
add_action('admin_print_styles', 'my_testimonial_admin_styles');
?>
