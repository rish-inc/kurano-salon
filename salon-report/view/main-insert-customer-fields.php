<?php
/*
 * Inesrt custom fields for shop taxonomy.
 */
@include_once( get_theme_file_path( '/salon-report/contoroller/gender.php' ) );
@include_once( get_theme_file_path( '/salon-report/contoroller/shoplist.php' ) );
@include_once( get_theme_file_path( '/salon-report/contoroller/customer_menu.php' ) );

function sr_insert_customer_fields( $wp_object, $callback_args ) {
	global $post;
	$loop = $callback_args[ "id" ];
	// var_dump( $wp_object );
	// wp_nonce_field( 'sr_insert_customer_fields', 'sr_customer_nonce[' . $loop . ']' );
	?>
	<div class="customer_form_field">
		<div class="customer_form_field__item">
			<label class="customer_form_field__item__label" for="customer_visit_datetime">来店日時</label>
			<input class="js-datetime" type="datetime-local" name="customer_visit_datetime[<?php echo $loop; ?>]" id="customer_visit_datetime_<?php echo $loop; ?>" value="<?php echo get_post_meta( $post->ID, 'customer_visit_datetime[' . $loop . ']', true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<label class="customer_form_field__item__label" for="customer_visit_shop">来店ショップ</label>
			<?php get_shoplist_field( $post, $loop ); ?>
		</div>
		<div class="customer_form_field__item">
			<p class="customer_form_field__item__label">施術メニュー</p>
			<?php get_customer_menu_field( $post, $loop ); ?>
		</div>
		<div class="customer_form_field__item">
			<label for="customer_peyment">お支払い金額</label>
			<input type="number" name="customer_peyment[<?php echo $loop; ?>]" id="customer_peyment_<?php echo $loop; ?>" value="<?php echo get_post_meta( $post->ID, 'peyment[' . $loop . ']', true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<label for="customer_treatment_datail">施術メニュー詳細</label>
			<textarea name="customer_treatment_datail" id="customer_treatment_datail_<?php echo $loop; ?>"><?php echo get_post_meta( $post->ID, 'treatment_datail[' . $loop . ']', true ); ?></textarea>
		</div>
	</div>
<?php }
