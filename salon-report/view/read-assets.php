<?php
/*
 * wp_enqueue scripts and styles
 */
function sr_customer_enqueue( $hook_suffix ) {
	wp_enqueue_style( 'customer_form_field', get_template_directory_uri() . '/css/customer_form_field.css' );
	wp_enqueue_script( 'check-color', get_template_directory_uri() . '/js/check-color.js', array(), '', true );
}
add_action( 'admin_enqueue_scripts', 'sr_customer_enqueue' );
