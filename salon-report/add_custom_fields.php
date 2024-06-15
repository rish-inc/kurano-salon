<?php
/*
 * Add Custom fields
 */
function sr_add_customer_fields() {
	add_meta_box (
		SR_Config::PREFIX . 'personal',
		'個人情報',
		'sr_insert_customer_personal_fields',
		'customer_report',
		'normal',
		'high'
	);
	// for ( $i = 0; $i < 12; $i++ ) {
	// 	add_meta_box (
	// 		'customer_data' . $i,
	// 		'カルテ詳細情報',
	// 		'sr_insert_customer_fields',
	// 		'customer_report',
	// 		'normal',
	// 		'high'
	// 	);
	// }
	add_meta_box (
		SR_Config::PREFIX . 'report' . "0",
		'カルテ詳細情報',
		'sr_insert_customer_fields',
		'customer_report',
		'normal',
		'high'
	);

}
add_action( 'add_meta_boxes', 'sr_add_customer_fields' );
