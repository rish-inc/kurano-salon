<?php
/*
 * Shoplist data contoller
 */

function get_shoplist_field( $post ) {
	$shop_terms = get_terms( 'shop' , array( 'hide_empty' => false ) );

	$get_customer_shop = get_post_meta( $post -> ID, 'customer_visit_shop', true );
	$customer_shop = $get_customer_shop ? $get_customer_shop : array();
	foreach( $shop_terms as $shop_term ) :
		$shop_id   = $shop_term -> term_id;
		$shop_slug = $shop_term -> slug;
		if( $shop_term -> name 	== $customer_shop ) {
			$customer_shop_checked = "selected";
		} else {
			$customer_shop_checked = "";
		}
		echo '<option id="js-select-shop" value="' . $shop_term -> name . '" ' . $customer_shop_checked . '>' . $shop_term -> name . '</option>';
	endforeach;
}
