<?php
/*
 * edit custom fields for term of shop taxonomy
 */
function sr_edit_term_fields_store_products( $store_products ) {
	wp_nonce_field( 'term_fields_store_products', 'sr_store_products_term_nonce' );
	$t_id = $store_products -> term_id;
	$sr_custom = get_option( "cat_{$t_id}" );
?>
<tr class="form-field">
	<th><label for="sr_custom_store_products_price">金額</label></th>
	<td><input type="number" name="sr_custom_store_products_price" id="sr_custom_store_products_price" size="25"
		value="<?php if ( get_term_meta( $t_id, 'sr_custom_store_products_price', true ) ) echo esc_html( get_term_meta( $t_id, 'sr_custom_store_products_price', true ) ) ?>">
	</td>
</tr>
<?php }
add_action ( 'store_products_edit_form_fields', 'sr_edit_term_fields_store_products');
