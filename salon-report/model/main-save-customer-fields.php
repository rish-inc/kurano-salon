<?php
/*
 * Save custom fields for shop taxonomy.
 */
function sr_save_customer_fields( $post_id ) {
	global $post;

	$prefix = SR_Config::PREFIX . 'report' . '0';
	$names = [
		'customer_visit_datetime',
		'customer_visit_shop',
		'customer_menu',
		'customer_staff',
		'designate',
		'customer_peyment',
		'customer_treatment_datail'];

	if ( ! isset( $_POST[ SR_Config::PREFIX . 'report' ] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST[ SR_Config::PREFIX . 'report' ], SR_Config::NAME . 'fields' ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

	if( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }

	foreach( $names as $name ) {
		if ( ! empty( $_POST[ $name . '_' . $prefix ] ) ) {
			update_post_meta( $post_id, $name . '_' . $prefix, $_POST[ $name . '_' . $prefix ] );
		} else {
			delete_post_meta( $post_id, $name . '_' . $prefix );
		}
	}
}
add_action( 'save_post', 'sr_save_customer_fields' );
