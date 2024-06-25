<?php
/*
 * wp_enqueue scripts and styles
 */
function sr_customer_enqueue( $hook_suffix ) {
?>
	<script>
		const path ="<?php echo plugins_url(); ?>";
	</script>
<?php
	wp_enqueue_style ( 'customer_form_field', plugins_url() . '/salon-report/assets/css/salon-report.css' );
	wp_enqueue_style ( 'fontawesome', plugins_url() . '/salon-report/assets/js/handdraw/css/fontawesome.css' );
	wp_enqueue_style ( 'hand-write-css', plugins_url() . '/salon-report/assets/js/handdraw/css/handdraw.css' );
	wp_enqueue_script( 'check-color', plugins_url() . '/salon-report/assets/js/check-color.js', array(), '1.0.0', true );
	wp_enqueue_script( 'hand-write-html', plugins_url() . '/salon-report/assets/js/handdraw/js/html.js', array(), '1.0.0', true );
	wp_enqueue_script( 'handdraw', plugins_url() . '/salon-report/assets/js/handdraw/js/handdraw.js', array( 'hand-write-html' ), '1.0.0', true );
	// wp_enqueue_script( 'postbox-toggle', plugins_url() . '/salon-report/assets/js/postbox-toggle.js', array(), '', true );
}
add_action( 'admin_enqueue_scripts', 'sr_customer_enqueue' );

function add_defer( $tag, $handle ) {
	if ( $handle !== 'handdraw' ) {
		return $tag;
	}
	return str_replace( ' src=', ' defer src=', $tag );
}
add_filter( 'script_loader_tag', 'add_defer', 10, 2 );
