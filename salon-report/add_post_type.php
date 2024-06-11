<?php
/*
 * Add Custom post type
 */
function sr_customer_post_type_register( ) {
	register_post_type (
		'customer_report',
		array (
			'label' => 'カルテ',
			'labels' => array (
				'add_new' => 'カルテ追加',
				'edit_item' => 'カルテ編集',
				'view_item' => 'カルテ閲覧',
				'serch_items' => 'カルテ検索',
				'not_found' => 'カルテが見つかりません',
				'not_found_in_trash' => 'ゴミ箱にカルテはありませんでした'
			),
			'public' => true,
			'has_archive' => true,
			'show_in_rest' => true,
			'menu_position' => 0,
			'description' => 'カルテの説明文',
			'supports' => array (
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'comments',
				'revisions'
			),
			'taxonomies' => array(
				'staff',
				'treatment',
				'characteristics'
			)
		)
	);
	register_taxonomy (
		'staff',
		'customer_report',
		array (
			'label' => 'スタッフ',
			'hierarchical' => true,
			'public' => true,
			'show_in_rest' => true
		)
	);
	register_taxonomy (
		'treatment',
		'customer_report',
		array (
			'label' => '施術メニューラベル',
			'hierarchical' => true,
			'public' => true,
			'show_in_rest' => true,
		),
	);
	register_taxonomy (
		'shop',
		'customer_report',
		array (
			'label' => '店舗登録',
			'hierarchical' => true,
			'public' => true,
			'show_in_rest' => true,
		),
	);

	register_taxonomy (
		'characteristics',
		'customer_report',
		array (
			'label' => '特徴ラベル',
			'hierarchical' => false,
			'public' => true,
			'show_in_rest' => true,
		),
	);
}
add_action( 'init', 'sr_customer_post_type_register' );
