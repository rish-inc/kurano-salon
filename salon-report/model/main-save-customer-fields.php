<?php
/*
 * Save custom fields for shop taxonomy.
 */
function sr_save_customer_fields( $post_id ) {
	global $post;
	$menu_terms = get_terms( 'treatment' , array( 'hide_empty' => false ) );

	if ( ! isset( $_POST[ 'sr_customer_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'sr_customer_nonce' ], 'sr_insert_customer_fields' ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

	if( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }


	if ( ! empty( $_POST[ 'customer_visit_datetime' ] ) ) {
		update_post_meta( $post_id, 'customer_visit_datetime', $_POST[ 'customer_visit_datetime' ] );
	} else {
		delete_post_meta( $post_id, 'customer_visit_datetime' );
	}

	if ( ! empty( $_POST[ 'customer_visit_shop' ] ) ) {
		update_post_meta( $post_id, 'customer_visit_shop', $_POST[ 'customer_visit_shop' ] );
	} else {
		delete_post_meta( $post_id, 'customer_visit_shop' );
	}

	if ( ! empty( $_POST[ 'customer_menu' ] ) ) {
		update_post_meta( $post_id, 'customer_menu', $_POST[ 'customer_menu' ] );
	} else {
		delete_post_meta( $post_id, 'customer_menu' );
	}
	if ( ! empty( $_POST[ 'customer_staff' ] ) ) {
		update_post_meta( $post_id, 'customer_staff', $_POST[ 'customer_staff' ] );
	} else {
		delete_post_meta( $post_id, 'customer_staff' );
	}

	if ( ! empty( $_POST[ 'designate' ] ) ) {
		update_post_meta( $post_id, 'designate', $_POST[ 'designate' ] );
	} else {
		delete_post_meta( $post_id, 'designate' );
	}

	if ( ! empty( $_POST[ 'customer_peyment' ] ) ) {
		update_post_meta( $post_id, 'peyment', $_POST[ 'customer_peyment' ] );
	} else {
		delete_post_meta( $post_id, 'peyment' );
	}

}
add_action( 'save_post', 'sr_save_customer_fields' );
