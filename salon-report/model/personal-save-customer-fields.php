<?php
/*
 * Save custom fields for shop personal data taxonomy.
 */
function sr_save_customer_personal_fields( $post_id ) {
	global $post;

	if ( ! isset( $_POST[ SR_Config::PREFIX . 'personal' ] ) ) {
		return $post_id;
	}

	if ( ! wp_verify_nonce( $_POST[ SR_Config::PREFIX . 'personal' ], SR_Config::NAME . 'personal' ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

	if( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }

	if ( ! empty( $_POST[ 'customer_ruby' ] ) ) {
		update_post_meta( $post_id, 'customer_ruby', $_POST[ 'customer_ruby' ] );
	} else {
		delete_post_meta( $post_id, 'customer_ruby' );
	}

	if ( ! empty( $_POST[ 'customer_gender' ] ) ) {
		update_post_meta( $post_id, 'customer_gender', $_POST[ 'customer_gender' ] );
	} else {
		delete_post_meta( $post_id, 'customer_gender' );
	}

	if ( ! empty( $_POST[ 'customer_treatment_datail' ] ) ) {
		update_post_meta( $post_id, 'treatment_datail', $_POST[ 'customer_treatment_datail' ] );
	} else {
		delete_post_meta( $post_id, 'treatment_datail' );
	}

	if ( ! empty( $_POST[ 'customer_postal_code' ] ) ) {
		update_post_meta( $post_id, 'postal_code', $_POST[ 'customer_postal_code' ] );
	} else {
		delete_post_meta( $post_id, 'postal_code' );
	}

	if ( ! empty( $_POST[ 'customer_address' ] ) ) {
		update_post_meta( $post_id, 'address', $_POST[ 'customer_address' ] );
	} else {
		delete_post_meta( $post_id, 'address' );
	}

	if ( ! empty( $_POST[ 'customer_customer_tel' ] ) ) {
		update_post_meta( $post_id, 'customer_tel', $_POST[ 'customer_customer_tel' ] );
	} else {
		delete_post_meta( $post_id, 'customer_tel' );
	}

	if ( ! empty( $_POST[ 'customer_email' ] ) ) {
		update_post_meta( $post_id, 'customer_email', $_POST[ 'customer_email' ] );
	} else {
		delete_post_meta( $post_id, 'customer_email' );
	}

	if ( ! empty( $_POST[ 'customer_birth' ] ) ) {
		update_post_meta( $post_id, 'customer_birth', $_POST[ 'customer_birth' ] );
	} else {
		delete_post_meta( $post_id, 'customer_birth' );
	}
}
add_action( 'save_post', 'sr_save_customer_personal_fields' );
