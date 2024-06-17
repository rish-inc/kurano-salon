<?php
/*
 * add custom fields for term of store-products taxonomy
 * Add for store product items
 */
function sr_add_term_fields_store_products( $store_products ) {
	wp_nonce_field( SR_Config::NAME . 'store_products', SR_Config::PREFIX . 'store_products' );
	?>
	<div class="form-field">
		<label for="sr_custom_store_products_price">商品価格</label>
		<input type="number" name="sr_custom_store_products_price" id="sr_custom_store_products_price" size="25" value="">
	</div>
	<?php
}
add_action( 'store_products_add_form_fields', 'sr_add_term_fields_store_products' );
