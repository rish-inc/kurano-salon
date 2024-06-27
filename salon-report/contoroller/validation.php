<?php
/*
 * If save to load this validation.
 */
function add_sr_customer_ajaxurl() {
	?>
		<script>
			const ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
		</script>
	<?php
}
add_action( 'wp_head', 'add_sr_customer_ajaxurl', 1 );
function sr_customer_validation_ajax () {
	global $post;
	if ( is_admin() && $post -> post_type == 'customer_report' ) : ?>
		<script language="javascript" type="text/javascript">
			jQuery( document ).ready( function() {
				jQuery( '#publish' ).click( function() {
					if( jQuery( this ).data( "valid" ) ) {
						return true;
					}
					var form_data = jQuery( '#post' ).serializeArray();
					var data = {
						action: 'sr_customer_validation',
						security: '<?php echo wp_create_nonce( 'pre_publish_validation' ); ?>',
						form_data: jQuery.param( form_data ),
					};
					jQuery.post( ajaxurl, data, function( response ) {
						if ( response.indexOf( 'true' ) > -1 || response == true ) {
							jQuery( '#publish' ).data( "valid", true ).trigger( 'click' );
						} else {
							alert( "Error: " + response );
							jQuery( "#publish" ).data( "valid", false );
						}
						jQuery( '#ajax-loading' ).hide();
						jQuery( '#publish' ).removeClass( 'button-primary-disabled' );
						jQuery( '#save-post' ).removeClass( 'button-disabled' );
					});
					return false;
				} );
			} );
		</script>
	<?php endif;
}
add_action( 'admin_head-post-new.php', 'sr_customer_validation_ajax' );
add_action( 'admin_head-post.php', 'sr_customer_validation_ajax' );

//Security check
function sr_customer_validation(){
	check_ajax_referer( 'pre_publish_validation', 'security' );
	?>
		<script language="javascript" type="text/javascript">
			alert( "aaa" );
		</script>
	<?php
	parse_str( $_POST[ 'form_data' ], $vars );

	$must_text = 'hoge';

	if( strpos( $vars[ 'content' ], $must_text ) === false ) {
		echo '投稿記事中に"' . $must_text . '"が見つかりませんでした。';
		die();
	}

	//問題が無い場合はtrueを返す
	echo 'true';
	die();
}

add_action( 'wp_ajax_sr_customer_validation', 'sr_customer_validation' );
