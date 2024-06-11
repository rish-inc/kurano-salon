<?php
/*
 * add custom fields for term of shop taxonomy
 */
function sr_add_term_fields_shop( $shop ) {
	wp_nonce_field( basename( __FILE__ ), 'sr_shop_term_nonce' );
	?>
	<div class="form-field form-required term-image-wrap">
		<label for="sr_custom_postal_code">郵便番号</label>
		<input type="number" name="sr_custom_shop_postal_code" id="sr_custom_postal_code" size="25" value="">
	</div>
	<div class="form-field form-required term-image-wrap">
		<label for="sr_custom_address">住所</label>
		<input type="text" name="sr_custom_shop_address" id="sr_custom_address" size="25" value="">
	</div>
	<div class="form-field form-required term-image-wrap">
		<label for="sr_custom_tel">電話番号</label>
		<input type="tel" name="sr_custom_shop_tel" id="sr_custom_tel" size="25" value="">
	</div>
	<?php
}
add_action( 'shop_add_form_fields', 'sr_add_term_fields_shop' );
