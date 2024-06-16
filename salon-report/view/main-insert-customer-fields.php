<?php
/*
 * Inesrt custom fields for shop taxonomy.
 */
@include_once( get_theme_file_path( '/salon-report/classes/class.seting.postmeta.php' ) );
@include_once( get_theme_file_path( '/salon-report/contoroller/gender.php' ) );
@include_once( get_theme_file_path( '/salon-report/contoroller/shoplist.php' ) );
@include_once( get_theme_file_path( '/salon-report/contoroller/customer_menu.php' ) );

function sr_insert_customer_fields() {
	global $post;
	wp_nonce_field( 'sr_insert_customer_fields', 'sr_customer_nonce[' . SR_Config::PREFIX . 'report' . '0' . ']' );
	?>
	<div class="customer_form_field">
		<?php echo SR_input::input_field( 'datetime-local', 'customer_visit_datetime', '来店日時', ['js-datetime', 'aaa'] ); ?>
		<div class="customer_form_field__item">
			<label class="customer_form_field__item__label" for="customer_visit_shop">来店ショップ</label>
			<?php get_shoplist_field( $post ); ?>
		</div>
		<div class="customer_form_field__item">
			<p class="customer_form_field__item__label">施術メニュー</p>
			<?php get_customer_menu_field( $post ); ?>
		</div>
		<?php echo SR_input::input_field( 'number', 'customer_peyment', 'お支払い金額' ); ?>
		<div class="customer_form_field__item">
			<label for="customer_treatment_datail">施術メニュー詳細</label>
			<textarea name="customer_treatment_datail" id="customer_treatment_datail_<?php echo SR_Config::PREFIX . 'report' . '0'; ?>"><?php echo get_post_meta( $post->ID, 'treatment_datail[' . SR_Config::PREFIX . 'report' . '0' . ']', true ); ?></textarea>
		</div>
	</div>
<?php }
