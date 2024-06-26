<?php
/*
 * Inesrt custom fields for shop taxonomy.
 */
function sr_insert_customer_fields ( $post, $args ) {
	global $post;
	$loop_count = $args['args'][0];
	wp_nonce_field( SR_Config::NAME . 'fields', SR_Config::PREFIX . 'report' );

	$handdraw         = SR_fieldname_to_attr::change_id_name( 'handDraw', $loop_count )[0];
	$handdraw_hidden  = SR_fieldname_to_attr::change_id_name( 'customer_handdraw', $loop_count )[0];
	$treatment_datail = SR_fieldname_to_attr::change_id_name( 'customer_treatment_datail', $loop_count )[0];
?>
	<div class="customer_form_field">
		<div class="customer_form_field__item">
			<?php echo SR_input::input_field( 'datetime-local', 'customer_visit_datetime', '来店日時', $loop_count, 'true', ['js-datetime'] ); ?>
		</div>
		<div class="customer_form_field__item">
			<label class="customer_form_field__item__label" for="customer_visit_shop">来店ショップ</label>
			<div class="cf-input-field">
				<?php get_shoplist_field( $post, $loop_count ); ?>
			</div>
		</div>
		<div class="customer_form_field__item">
			<p class="customer_form_field__item__label">施術メニュー</p>
			<?php get_customer_menu_field( $post, $loop_count ); ?>
		</div>
		<div class="customer_form_field__item">
			<label for="customer_treatment_datail">施術メモ</label>
			<div id="<?php echo $handdraw['name'] ?>" class="hand-draw"></div>
			<input type="hidden" id="<?php echo $handdraw_hidden['id'] ?>" name="<?php echo $handdraw_hidden['name'] ?>" class="js-handdraw-data" value="<?php echo get_post_meta( $post->ID, $handdraw_hidden['name'], true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<?php echo SR_input::input_field( 'number', 'customer_peyment', 'お支払い金額', $loop_count ); ?>
		</div>
		<div class="customer_form_field__item">
			<label for="customer_treatment_datail">施術メニュー詳細</label>
			<textarea name="<?php echo $treatment_datail['name'] ?>" id="<?php echo $treatment_datail['id'] ?>"><?php echo esc_html( get_post_meta( $post->ID, $treatment_datail['name'], true ) ); ?></textarea>
		</div>
	</div>
<?php
}
