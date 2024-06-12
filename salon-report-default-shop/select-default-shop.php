<?php
/*
 * wp_enqueue scripts and styles
 */
function sr_select_default_shop_scripts( $hook_suffix ) {
	wp_enqueue_script( 'select-default-shop', get_theme_file_uri( '/salon-report-default-shop/select-default-shop.js' ), array(), '', true );
}
add_action( 'admin_enqueue_scripts', 'sr_select_default_shop_scripts' );
