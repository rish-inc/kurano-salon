<?php
/*
 * add custom fields for term of store-products taxonomy
 */
function sr_add_term_fields_store_products( $store_products ) {
	wp_nonce_field( basename( __FILE__ ), 'sr_store_products_term_nonce' );
	?>
	<div class="form-field">
		<label for="sr_custom_price">料金</label>
		<input type="number" name="sr_custom_price" id="sr_custom_price" size="25" value="">
	</div>
	<?php
}
add_action( 'store-proucts_add_form_fields', 'sr_add_term_fields_store_products' );
