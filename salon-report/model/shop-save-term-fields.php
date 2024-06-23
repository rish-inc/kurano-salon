<?php
/*
 * save custom fields for term of shop taxonomy
 */
function sr_save_customer_fields_shop( $term_id ) {
	global $post;

	$names = [
		'sr_custom_shop_postal_code',
		'sr_custom_shop_address',
		'sr_custom_shop_tel'
	];

	if ( ! isset( $_POST[ SR_Config::PREFIX . 'shop' ] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST[ SR_Config::PREFIX . 'shop' ], SR_Config::NAME . 'shop' ) ) {
		return;
	}

	foreach( $names as $name ) {
		if ( isset( $_POST[ $name ] ) && esc_html( $_POST[ $name ] ) ) {
			update_term_meta( $term_id, $name, $_POST[ $name ] );
		} else {
			delete_term_meta( $term_id, $name );
		}
	}
}
add_action ( 'create_shop', 'sr_save_customer_fields_shop');
add_action ( 'edited_shop', 'sr_save_customer_fields_shop');
