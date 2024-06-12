<?php
/*
 * edit custom fields for term of store-products taxonomy
 */
function sr_edit_customer_fields_shop( $shop ) {
	wp_nonce_field( basename( __FILE__ ), 'sr_shop_term_nonce' );
	$t_id = $shop -> term_id;
	$sr_custom = get_option( "cat_{$t_id}" );
?>
<tr class="form-field">
	<th><label for="sr_custom_postal_code">郵便番号（ハイフン不要）</label></th>
	<td><input type="number" name="sr_custom_shop_postal_code" id="sr_custom_postal_code" size="25"
		value="<?php if ( get_term_meta( $t_id, 'sr_custom_shop_postal_code', true ) ) echo esc_html( get_term_meta( $t_id, 'sr_custom_shop_postal_code', true ) ) ?>">
	</td>
</tr>
<?php }
add_action ( 'shop_edit_form_fields', 'sr_edit_customer_fields_shop');
