<?php
/*
 * Save custom fields for shop taxonomy.
 */
function sr_save_customer_fields( $post_id, $callback_args ) {
	global $post;
	$loop = $callback_args[ "id" ];
	$menu_terms = get_terms( 'treatment' , array( 'hide_empty' => false ) );

	// if ( ! isset( $_POST[ 'sr_customer_nonce[' . $loop . ']' ] ) || ! wp_verify_nonce( $_POST[ 'sr_customer_nonce[' . $loop . ']' ], 'sr_insert_customer_fields' ) ) {
	// 	return $post_id;
	// }

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

	if( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }


	if ( ! empty( $_POST[ 'customer_visit_datetime[' . $loop . ']' ] ) ) {
		update_post_meta( $post_id, 'customer_visit_datetime[' . $loop . ']', $_POST[ 'customer_visit_datetime[' . $loop . ']' ] );
	} else {
		delete_post_meta( $post_id, 'customer_visit_datetime[' . $loop . ']' );
	}

	if ( ! empty( $_POST[ 'customer_visit_shop[' . $loop . ']' ] ) ) {
		update_post_meta( $post_id, 'customer_visit_shop[' . $loop . ']', $_POST[ 'customer_visit_shop[' . $loop . ']' ] );
	} else {
		delete_post_meta( $post_id, 'customer_visit_shop[' . $loop . ']' );
	}

	if ( ! empty( $_POST[ 'customer_menu[' . $loop . ']' ] ) ) {
		update_post_meta( $post_id, 'customer_menu[' . $loop . ']', $_POST[ 'customer_menu[' . $loop . ']' ] );
	} else {
		delete_post_meta( $post_id, 'customer_menu[' . $loop . ']' );
	}
	if ( ! empty( $_POST[ 'customer_staff[' . $loop . ']' ] ) ) {
		update_post_meta( $post_id, 'customer_staff[' . $loop . ']', $_POST[ 'customer_staff[' . $loop . ']' ] );
	} else {
		delete_post_meta( $post_id, 'customer_staff[' . $loop . ']' );
	}

	if ( ! empty( $_POST[ 'designate[' . $loop . ']' ] ) ) {
		update_post_meta( $post_id, 'designate[' . $loop . ']', $_POST[ 'designate[' . $loop . ']' ] );
	} else {
		delete_post_meta( $post_id, 'designate[' . $loop . ']' );
	}

	if ( ! empty( $_POST[ 'customer_peyment[' . $loop . ']' ] ) ) {
		update_post_meta( $post_id, 'peyment[' . $loop . ']', $_POST[ 'customer_peyment[' . $loop . ']' ] );
	} else {
		delete_post_meta( $post_id, 'peyment[' . $loop . ']' );
	}

}
add_action( 'save_post', 'sr_save_customer_fields' );
