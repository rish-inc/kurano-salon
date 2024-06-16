<?php
/*
 * Save custom fields for shop taxonomy.
 */
function sr_save_customer_fields( $post_id ) {
	global $post;
	$menu_terms = get_terms( 'treatment' , array( 'hide_empty' => false ) );

	$prefix = SR_Config::PREFIX . 'report' . '0';
	$names = [
		'customer_visit_datetime',
		'customer_visit_shop',
		'customer_menu',
		'customer_staff',
		'designate',
		'customer_peyment',
		'customer_treatment_datail'];

	// if ( ! isset( $_POST[ 'sr_customer_nonce[' . SR_Config::PREFIX . 'report' . '0' . ']' ] ) || ! wp_verify_nonce( $_POST[ 'sr_customer_nonce[' . SR_Config::PREFIX . 'report' . '0' . ']' ], 'sr_insert_customer_fields' ) ) {
	// 	return $post_id;
	// }

	foreach( $names as $name ) {
		if ( ! empty( $_POST[ $name . '_' . SR_Config::PREFIX . 'report' . '0' ] ) ) {
			update_post_meta( $post_id, $name . '_' . SR_Config::PREFIX . 'report' . '0', $_POST[ $name . '_' . SR_Config::PREFIX . 'report' . '0' ] );
		} else {
			delete_post_meta( $post_id, $name . '_' . SR_Config::PREFIX . 'report' . '0' );
		}
	}

	// if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

	// if( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }


	// if ( ! empty( $_POST[ 'customer_visit_datetime_' . SR_Config::PREFIX . 'report' . '0' ] ) ) {
	// 	update_post_meta( $post_id, 'customer_visit_datetime_' . SR_Config::PREFIX . 'report' . '0', $_POST[ 'customer_visit_datetime_' . SR_Config::PREFIX . 'report' . '0' ] );
	// } else {
	// 	delete_post_meta( $post_id, 'customer_visit_datetime_' . SR_Config::PREFIX . 'report' . '0' );
	// }

	// if ( ! empty( $_POST[ 'customer_visit_shop[' . SR_Config::PREFIX . 'report' . '0' . ']' ] ) ) {
	// 	update_post_meta( $post_id, 'customer_visit_shop[' . SR_Config::PREFIX . 'report' . '0' . ']', $_POST[ 'customer_visit_shop[' . SR_Config::PREFIX . 'report' . '0' . ']' ] );
	// } else {
	// 	delete_post_meta( $post_id, 'customer_visit_shop[' . SR_Config::PREFIX . 'report' . '0' . ']' );
	// }

	// if ( ! empty( $_POST[ 'customer_menu[' . SR_Config::PREFIX . 'report' . '0' . ']' ] ) ) {
	// 	update_post_meta( $post_id, 'customer_menu[' . SR_Config::PREFIX . 'report' . '0' . ']', $_POST[ 'customer_menu[' . SR_Config::PREFIX . 'report' . '0' . ']' ] );
	// } else {
	// 	delete_post_meta( $post_id, 'customer_menu[' . SR_Config::PREFIX . 'report' . '0' . ']' );
	// }
	// if ( ! empty( $_POST[ 'customer_staff[' . SR_Config::PREFIX . 'report' . '0' . ']' ] ) ) {
	// 	update_post_meta( $post_id, 'customer_staff[' . SR_Config::PREFIX . 'report' . '0' . ']', $_POST[ 'customer_staff[' . SR_Config::PREFIX . 'report' . '0' . ']' ] );
	// } else {
	// 	delete_post_meta( $post_id, 'customer_staff[' . SR_Config::PREFIX . 'report' . '0' . ']' );
	// }

	// if ( ! empty( $_POST[ 'designate[' . SR_Config::PREFIX . 'report' . '0' . ']' ] ) ) {
	// 	update_post_meta( $post_id, 'designate[' . SR_Config::PREFIX . 'report' . '0' . ']', $_POST[ 'designate[' . SR_Config::PREFIX . 'report' . '0' . ']' ] );
	// } else {
	// 	delete_post_meta( $post_id, 'designate[' . SR_Config::PREFIX . 'report' . '0' . ']' );
	// }

	// if ( ! empty( $_POST[ 'customer_peyment[' . SR_Config::PREFIX . 'report' . '0' . ']' ] ) ) {
	// 	update_post_meta( $post_id, 'peyment[' . SR_Config::PREFIX . 'report' . '0' . ']', $_POST[ 'customer_peyment[' . SR_Config::PREFIX . 'report' . '0' . ']' ] );
	// } else {
	// 	delete_post_meta( $post_id, 'peyment[' . SR_Config::PREFIX . 'report' . '0' . ']' );
	// }

}
add_action( 'save_post', 'sr_save_customer_fields' );
