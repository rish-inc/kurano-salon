<?php
/*
 * save custom fields for term of shop taxonomy
 */
function sr_save_customer_fields_shop( $term_id ) {
	global $post;

	if ( ! isset( $_POST[ SR_Config::PREFIX . 'shop' ] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST[ SR_Config::PREFIX . 'shop' ], SR_Config::NAME . 'shop' ) ) {
		return;
	}

	if ( isset( $_POST[ 'sr_custom_shop_postal_code' ] ) && esc_html( $_POST[ 'sr_custom_shop_postal_code' ] ) ) {
		update_term_meta( $term_id, 'sr_custom_shop_postal_code', $_POST[ 'sr_custom_shop_postal_code' ] );
	} else {
		delete_term_meta( $term_id, 'sr_custom_shop_postal_code' );
	}

	if ( isset( $_POST['sr_custom_shop_address'] ) && esc_html( $_POST[ 'sr_custom_shop_address' ] ) ) {
		update_term_meta( $term_id, 'sr_custom_shop_address', $_POST[ 'sr_custom_shop_address' ] );
	} else {
		delete_term_meta( $term_id, 'sr_custom_shop_address' );
	}

	if ( isset( $_POST[ 'sr_custom_shop_tel' ] ) && esc_html( $_POST[ 'sr_custom_shop_tel' ] ) ) {
		update_term_meta( $term_id, 'sr_custom_shop_tel', str_replace( "-", "", $_POST[ 'sr_custom_shop_tel' ] ) );
	} else {
		delete_term_meta( $term_id, 'sr_custom_shop_tel' );
	}

}
add_action ( 'create_shop', 'sr_save_customer_fields_shop');
add_action ( 'edited_shop', 'sr_save_customer_fields_shop');
