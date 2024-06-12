<?php
/*
 * save custom fields for term of store products taxonomy
 */
function sr_save_customer_fields_store_products( $term_id ) {
	if ( ! isset( $_POST[ 'sr_store_products_term_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'sr_store_products_term_nonce' ], 'term_fields_store_products' ) ) {
		return;
	}

	if ( isset( $_POST[ 'sr_custom_store_products_price' ] ) && esc_html( $_POST[ 'sr_custom_store_products_price' ] ) ) {
		update_term_meta( $term_id, 'sr_custom_store_products_price', $_POST[ 'sr_custom_store_products_price' ] );
	} else {
		delete_term_meta( $term_id, 'sr_custom_store_products_price' );
	}

}
add_action ( 'create_store_products', 'sr_save_customer_fields_store_products');
add_action ( 'edited_store_products', 'sr_save_customer_fields_store_products');
