<?php
/**
 * init
 */

if ( ! isset( $content_width ) ) :
	$content_width = 1200;
endif;
function custom_theme_support() {
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'editor-styles' );
	add_editor_style ( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'custom_theme_support' );

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

function sr_insert_customer_fields() {
	global $post;
	wp_nonce_field( wp_create_nonce( __FILE__ ), 'sr_customer_nonce' );
	$menu_terms = get_terms( 'treatment' , array( 'hide_empty' => false ) );
	$users = get_users(
		array (
			'orderby' => 'ID',
			'order' => 'ASC',
		)
	);
	?>
	<div class="customer_form_field">
		<div class="customer_form_field__item">
			<label for="customer_ruby">フリガナ</label>
			<input type="text" name="customer_ruby" id="customer_ruby" value="<?php echo get_post_meta( $post->ID, 'customer_ruby', true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<label for="customer_visit_datetime">来店日時</label>
			<input type="datetime-local" name="customer_visit_datetime" id="customer_visit_datetime" value="<?php echo get_post_meta( $post->ID, 'customer_visit_datetime', true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<span>施術メニュー</span>
			<ul id="customer_menu" class="customer_form_field__item__multibox">
				<?php foreach( $menu_terms as $menu_term ) :
					$menu_id   = $menu_term -> term_id;
					$menu_slug = $menu_term -> slug;
					?>
					<li class="customer_form_field__item__multibox__list">
						<label class="customer_menu_item js-check-menu-title">
							<?php
								$get_customer_menu = get_post_meta( $post -> ID, 'customer_menu', true );
								$customer_menu = $get_customer_menu ? $get_customer_menu : array();
								if( in_array( $menu_term -> name, $customer_menu ) ) {
									$customer_menu_checked = "checked";
								} else {
									$customer_menu_checked = "";
								}
							?>
							<?php echo( $menu_term -> name ); ?> <input class="js-check-menu" type="checkbox" name="customer_menu[]" value="<?php echo( $menu_term -> name ); ?>" <?php echo $customer_menu_checked; ?>>
						</label>
						<select class="customer_form_field__item__selector js-menu-staff" name="customer_staff['<?php echo $menu_slug; ?>']">
							<option value="担当者選択">担当者選択</option>
							<?php
								$get_customer_staff = get_post_meta( $post -> ID, 'customer_staff', true );
								$customer_staff = $get_customer_staff ? $get_customer_staff : array();
								foreach( $users as $user ) :
									if( $user -> display_name == $customer_staff["'$menu_slug'"] ) {
										$customer_staff_checked = "selected";
									} else {
										$customer_staff_checked = "";
									}
									?>
									<option value="<?php echo( $user -> display_name ); ?>" <?php echo $customer_staff_checked; ?>><?php echo( $user -> display_name ); ?></option>
								<?php endforeach;
							?>
						</select>
						<div class="js-menu-designate">
							<?php
								$get_designate = get_post_meta( $post->ID, 'designate', true );
								$designate = $get_designate ? $get_designate : array();
								if ( isset( $designate["'$menu_slug'"] ) )  {
									$designate_check = "checked";
								} else {
									$designate_check = "";
								}
							?>
							<span>
								<label>指名 <input class="js-check-designate" type="checkbox" name="designate['<?php echo $menu_slug; ?>']" <?php echo $designate_check; ?>></label>
							</span>
						</div>
					<li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="customer_form_field__item">
			<label for="customer_peyment">お支払い金額</label>
			<input type="number" name="customer_peyment" id="customer_peyment" value="<?php echo get_post_meta( $post->ID, 'peyment', true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<label for="customer_treatment_datail">施術メニュー詳細</label>
			<textarea name="customer_treatment_datail" id="customer_treatment_datail"><?php echo get_post_meta( $post->ID, 'treatment_datail', true ); ?></textarea>
		</div>
		<div class="customer_data">
			<div class="customer_data__item">
				<label for="customer_postal_code">郵便番号</label>
				<input type="number" name="customer_postal_code" id="customer_postal_code" value="<?php echo get_post_meta( $post->ID, 'postal_code', true ); ?>">
			</div>
			<div class="customer_data__item">
				<label for="customer_address">住所</label>
				<input type="text" name="customer_address" id="customer_address" value="<?php echo get_post_meta( $post->ID, 'address', true ); ?>">
			</div>
			<div class="customer_data__item">
				<label for="customer_tel">電話番号</label>
				<input type="tel" name="customer_customer_tel" id="customer_customer_tel" value="<?php echo get_post_meta( $post->ID, 'customer_tel', true ); ?>">
			</div>
			<div class="customer_data__item">
				<label for="customer_email">メールアドレス</label>
				<input type="email" name="customer_email" id="customer_email" value="<?php echo get_post_meta( $post->ID, 'customer_email', true ); ?>">
			</div>
			<div class="customer_data__item">
				<label for="customer_birth">生年月日</label>
				<input type="date" name="customer_birth" id="customer_birth" value="<?php echo get_post_meta( $post->ID, 'customer_birth', true ); ?>">
			</div>
		</div>
	</div>
<?php }

function sr_save_customer_fields( $post_id ) {
	global $post;
	$sr_nonce =  isset( $_POST['sr_customer_nonce'] ) ? $_POST['sr_customer_nonce'] : null;
	$menu_terms = get_terms( 'treatment' , array( 'hide_empty' => false ) );

	if ( ! wp_verify_nonce( $sr_nonce, wp_create_nonce( __FILE__ ) ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) { return $post_id; }

	if( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }

	if ( ! empty( $_POST['customer_ruby'] ) ) {
		update_post_meta( $post_id, 'customer_ruby', $_POST['customer_ruby'] );
	} else {
		delete_post_meta( $post_id, 'customer_ruby' );
	}

	if ( ! empty( $_POST['customer_visit_datetime'] ) ) {
		update_post_meta( $post_id, 'customer_visit_datetime', $_POST['customer_visit_datetime'] );
	} else {
		delete_post_meta( $post_id, 'customer_visit_datetime' );
	}

	if ( ! empty( $_POST['customer_menu'] ) ) {
		update_post_meta( $post_id, 'customer_menu', $_POST['customer_menu'] );
	} else {
		delete_post_meta( $post_id, 'customer_menu' );
	}
	if ( ! empty( $_POST['customer_staff'] ) ) {
		update_post_meta( $post_id, 'customer_staff', $_POST['customer_staff'] );
	} else {
		delete_post_meta( $post_id, 'customer_staff' );
	}

	if ( ! empty( $_POST['designate'] ) ) {
		update_post_meta( $post_id, 'designate', $_POST['designate'] );
	} else {
		delete_post_meta( $post_id, 'designate' );
	}

	if ( ! empty( $_POST['customer_peyment'] ) ) {
		update_post_meta( $post_id, 'peyment', $_POST['customer_peyment'] );
	} else {
		delete_post_meta( $post_id, 'peyment' );
	}

	if ( ! empty( $_POST['customer_treatment_datail'] ) ) {
		update_post_meta( $post_id, 'treatment_datail', $_POST['customer_treatment_datail'] );
	} else {
		delete_post_meta( $post_id, 'treatment_datail' );
	}

	if ( ! empty( $_POST['customer_postal_code'] ) ) {
		update_post_meta( $post_id, 'postal_code', $_POST['customer_postal_code'] );
	} else {
		delete_post_meta( $post_id, 'postal_code' );
	}

	if ( ! empty( $_POST['customer_address'] ) ) {
		update_post_meta( $post_id, 'address', $_POST['customer_address'] );
	} else {
		delete_post_meta( $post_id, 'address' );
	}

	if ( ! empty( $_POST['customer_customer_tel'] ) ) {
		update_post_meta( $post_id, 'customer_tel', $_POST['customer_customer_tel'] );
	} else {
		delete_post_meta( $post_id, 'customer_tel' );
	}

	if ( ! empty( $_POST['customer_email'] ) ) {
		update_post_meta( $post_id, 'customer_email', $_POST['customer_email'] );
	} else {
		delete_post_meta( $post_id, 'customer_email' );
	}

	if ( ! empty( $_POST['customer_birth'] ) ) {
		update_post_meta( $post_id, 'customer_birth', $_POST['customer_birth'] );
	} else {
		delete_post_meta( $post_id, 'customer_birth' );
	}
}
add_action( 'save_post', 'sr_save_customer_fields' );
function sr_customer_enqueue( $hook_suffix ) {
	wp_enqueue_style( 'customer_form_field', get_template_directory_uri() . '/css/customer_form_field.css' );
	wp_enqueue_script( 'check-color', get_template_directory_uri() . '/js/check-color.js', array(), '', true );
}
add_action( 'admin_enqueue_scripts', 'sr_customer_enqueue' );
