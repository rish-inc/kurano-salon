<?php
/**
 * init
 */

if ( ! isset( $content_width ) ) :
	$content_width = 1200;
endif;
function custom_theme_support() {
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'editor-styles' );
	add_editor_style ( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'custom_theme_support' );

@include_once( __DIR__ . '/salon-report/salon-report.php');
