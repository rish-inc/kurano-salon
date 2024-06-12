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
			'label' => 'スタッフ管理',
			'hierarchical' => true,
			'public' => true,
			'show_in_rest' => true
		)
	);
	register_taxonomy (
		'treatment',
		'customer_report',
		array (
			'label' => '施術メニュー管理',
			'labels'            => array(
				'add_new_item'          => "施術メニューを登録",
				'singular_name'         => "施術メニュー",
				'search_items'          => "施術メニューを検索",
				'popular_items'         => "人気の施術メニュー",
				'all_items'             => "すべての施術メニュー",
				'new_item_name'         => "施術メニュー名",
				'add_or_remove_items'   => "施術メニューを追加もしくは削除",
				'choose_from_most_used' => "よく使われている施術メニューを選択",
				'not_found'             => "施術メニューは見つかりませんでした",
				'no_terms'              => "施術メニューはありませんでした",
				'items_list'            => "施術メニュー一覧",
				'filter_by_item'        => "施術メニューで絞り込み",
				'items_list_navigation' => "施術メニュー一覧ナビゲーション",
				'back_to_items'         => "施術メニュー一覧へ戻る",
				'edit_item'             => "施術メニューを編集",
				'view_item'             => "施術メニューを見る",
				'update_item'           => "施術メニューを更新",
			),
			'hierarchical' => true,
			'public' => true,
			'show_in_rest' => true,
		),
	);
	register_taxonomy (
		'shop',
		'customer_report',
		array (
			'label' => '店舗登録管理',
			'labels'            => array(
				'add_new_item'          => "店舗を登録",
				'singular_name'         => "店舗",
				'search_items'          => "店舗を検索",
				'popular_items'         => "人気の店舗",
				'all_items'             => "すべての店舗",
				'new_item_name'         => "店舗名",
				'add_or_remove_items'   => "店舗を追加もしくは削除",
				'choose_from_most_used' => "よく使われている店舗を選択",
				'not_found'             => "店舗は見つかりませんでした",
				'no_terms'              => "店舗はありませんでした",
				'items_list'            => "店舗一覧",
				'filter_by_item'        => "店舗で絞り込み",
				'items_list_navigation' => "店舗一覧ナビゲーション",
				'back_to_items'         => "店舗一覧へ戻る",
				'edit_item'             => "店舗を編集",
				'view_item'             => "店舗を見る",
				'update_item'           => "店舗を更新",
			),
			'hierarchical' => true,
			'public' => true,
			'show_in_rest' => true,
		),
	);

	register_taxonomy (
		'store_products',
		'customer_report',
		array (
			'label' => '店頭販売商品管理',
			'labels'            => array(
				'add_new_item'          => "商品を登録",
				'singular_name'         => "商品",
				'search_items'          => "商品を検索",
				'popular_items'         => "人気の商品",
				'all_items'             => "すべての商品",
				'new_item_name'         => "商品名",
				'add_or_remove_items'   => "商品を追加もしくは削除",
				'choose_from_most_used' => "よく使われている商品を選択",
				'not_found'             => "商品は見つかりませんでした",
				'no_terms'              => "商品はありませんでした",
				'items_list'            => "商品一覧",
				'filter_by_item'        => "商品で絞り込み",
				'items_list_navigation' => "商品一覧ナビゲーション",
				'back_to_items'         => "商品一覧へ戻る",
				'edit_item'             => "商品を編集",
				'view_item'             => "商品を見る",
				'update_item'           => "商品を更新",
			),
			'hierarchical' => false,
			'public' => true,
			'show_in_rest' => true,
		),
	);
}
add_action( 'init', 'sr_customer_post_type_register' );
