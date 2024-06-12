<?php
/*
 * Inesrt custom fields for shop taxonomy.
 */
function sr_insert_customer_fields() {
	global $post;
	wp_nonce_field( 'sr_insert_customer_fields', 'sr_customer_nonce' );
	$menu_terms = get_terms( 'treatment' , array( 'hide_empty' => false ) );
	$shop_terms = get_terms( 'shop' , array( 'hide_empty' => false ) );
	$users = get_users(
		array (
			'orderby' => 'ID',
			'order' => 'ASC',
		)
	);
	$gender_datas =  [ "man" => "男性", "woman" => "女性" ];
	?>
	<div class="customer_form_field">
		<div class="customer_form_field__item">
			<p class="customer_form_field__item__label" for="customer_ruby">会員番号</p>
			<p class="customer_form_field__item__value"><?php echo $post -> ID; ?></p>
		</div>
		<div class="customer_form_field__item">
			<label class="customer_form_field__item__label" for="customer_ruby">フリガナ</label>
			<input type="text" name="customer_ruby" id="customer_ruby" value="<?php echo get_post_meta( $post->ID, 'customer_ruby', true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<label class="customer_form_field__item__label" for="customer_visit_datetime">来店日時</label>
			<input type="datetime-local" name="customer_visit_datetime" id="customer_visit_datetime" value="<?php echo get_post_meta( $post->ID, 'customer_visit_datetime', true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<?php
				$get_gender = get_post_meta( $post->ID, 'customer_gender', true );
				$genders = $get_gender ? $get_gender : array();
			?>
			<p class="customer_form_field__item__label">性別</p>
			<fieldset class="customer_form_field__item__fieldset">
				<?php
					foreach ( $gender_datas as $gender_data_key => $gender_data_value ) :
						if ( in_array( $gender_data_value, $genders ) ) {
							$gender_check = "checked";
						} else {
							$gender_check = "";
						}
				?>
				<label class="customer_form_field__item__label"><?php echo $gender_data_value; ?> <input type="radio" name="customer_gender[]" id="<?php echo $gender_data_key; ?>" value="<?php echo $gender_data_value; ?>" <?php echo $gender_check; ?>></label>
				<?php endforeach; ?>
			</fieldset>
		</div>
		<div class="customer_form_field__item">
			<label class="customer_form_field__item__label" for="customer_visit_shop">来店ショップ</label>
			<select class="customer_form_field__item__selector" name="customer_visit_shop">
				<option value="ショップ選択">ショップ選択</option>
				<?php
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
						?>
						<option value="<?php echo( $shop_term -> name ); ?>" <?php echo $customer_shop_checked; ?>><?php echo( $shop_term -> name ); ?></option>
					<?php endforeach;
				?>
			</select>
		</div>
		<div class="customer_form_field__item">
			<p class="customer_form_field__item__label">施術メニュー</p>
			<ul id="customer_menu" class="customer_form_field__multibox">
				<?php foreach( $menu_terms as $menu_term ) :
					$menu_id   = $menu_term -> term_id;
					$menu_slug = $menu_term -> slug;
					?>
					<li class="customer_form_field__multibox__item">
						<label class="customer_form_field__multibox__item__title js-check-menu-title">
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
						<select class="customer_form_field__multibox__selector js-menu-staff" name="customer_staff['<?php echo $menu_slug; ?>']">
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
		<div class="personal_data">
			<div class="personal_data__item">
				<label for="customer_postal_code">郵便番号</label>
				<input type="number" name="customer_postal_code" id="customer_postal_code" value="<?php echo get_post_meta( $post->ID, 'postal_code', true ); ?>">
			</div>
			<div class="personal_data__item">
				<label for="customer_address">住所</label>
				<input type="text" name="customer_address" id="customer_address" value="<?php echo get_post_meta( $post->ID, 'address', true ); ?>">
			</div>
			<div class="personal_data__item">
				<label for="customer_tel">電話番号</label>
				<input type="tel" name="customer_customer_tel" id="customer_customer_tel" value="<?php echo get_post_meta( $post->ID, 'customer_tel', true ); ?>">
			</div>
			<div class="personal_data__item">
				<label for="customer_email">メールアドレス</label>
				<input type="email" name="customer_email" id="customer_email" value="<?php echo get_post_meta( $post->ID, 'customer_email', true ); ?>">
			</div>
			<div class="personal_data__item">
				<label for="customer_birth">生年月日</label>
				<input type="date" name="customer_birth" id="customer_birth" value="<?php echo get_post_meta( $post->ID, 'customer_birth', true ); ?>">
			</div>
		</div>
	</div>
<?php }
