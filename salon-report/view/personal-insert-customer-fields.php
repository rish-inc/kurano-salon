<?php
/*
 * Inesrt custom fields personal data for shop taxonomy.
 */
@include_once( get_theme_file_path( '/salon-report/contoroller/gender.php' ) );
@include_once( get_theme_file_path( '/salon-report/contoroller/shoplist.php' ) );
@include_once( get_theme_file_path( '/salon-report/contoroller/customer_menu.php' ) );

function sr_insert_customer_personal_fields() {
	global $post;
	wp_nonce_field( 'sr_insert_customer_personal_fields', 'sr_customer_personal_nonce' );
	?>
	<div class="customer_form_field__item">
		<p class="customer_form_field__item__label" for="customer_ruby">会員番号</p>
		<p class="customer_form_field__item__value"><?php echo $post -> ID; ?></p>
	</div>
	<div class="customer_form_field__item">
		<label class="customer_form_field__item__label" for="customer_ruby">フリガナ</label>
		<input type="text" name="customer_ruby" id="customer_ruby" value="<?php echo get_post_meta( $post->ID, 'customer_ruby', true ); ?>">
	</div>
	<div class="customer_form_field__item">
		<p class="customer_form_field__item__label">性別</p>
		<?php get_gender_field( $post ); ?>
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
<?php }
