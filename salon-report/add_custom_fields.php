<?php
/*
 * Add Custom fields
 */
function sr_add_customer_fields() {
	add_meta_box(
		'customer_data',
		'カルテ詳細情報',
		'sr_insert_customer_fields',
		'customer_report',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'sr_add_customer_fields' );

