<?php
/*
 * wp_enqueue scripts and styles
 */
function sr_customer_enqueue( $hook_suffix ) {
	global $parent_file;
	if ( 'edit.php?post_type=customer_report' != $parent_file ) return;
?>
	<script>
		const path ="<?php echo plugins_url(); ?>";
	</script>

<?php
	//Load Validation
	// $asset_file = include( plugin_dir_path( __FILE__ ) . '../validation/build/index.asset.php' );
	// $validation_dir = '/salon-report/validation/build/';

	wp_enqueue_style ( 'sr-customer_form_field', plugins_url() . '/salon-report/assets/css/salon-report.css' );
	wp_enqueue_style ( 'fontawesome', plugins_url() . '/salon-report/assets/js/handdraw/css/fontawesome.css' );
	wp_enqueue_style ( 'sr-hand-write-css', plugins_url() . '/salon-report/assets/js/handdraw/css/handdraw.css' );
	wp_enqueue_script( 'sr-check-color', plugins_url() . '/salon-report/assets/js/check-color.js', array(), '1.0.0', true );
	wp_enqueue_script( 'sr-hand-write-html', plugins_url() . '/salon-report/assets/js/handdraw/js/html.js', array(), '1.0.0', true );
	wp_enqueue_script( 'sr-handdraw', plugins_url() . '/salon-report/assets/js/handdraw/js/handdraw.js', array( 'sr-hand-write-html' ), '1.0.0', true );
	wp_enqueue_script( 'sr-validation', plugins_url() . '/salon-report/assets/js/validation.js', array( 'sr-hand-write-html' ), '1.0.0', true );

	//Load Validation files
	// wp_enqueue_style ( 'sr-validation', plugins_url() . $validation_dir . 'admin.css', array( 'wp-components' ) );
	// wp_enqueue_script( 'sr-validation', plugins_url() . $validation_dir . 'index.js', array( 'sr-handdraw' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'sr_customer_enqueue' );

function add_defer( $tag, $handle ) {
	if ( $handle !== 'sr-handdraw' ) {
		return $tag;
	}
	return str_replace( ' src=', ' defer src=', $tag );
}
add_filter( 'script_loader_tag', 'add_defer', 10, 2 );
