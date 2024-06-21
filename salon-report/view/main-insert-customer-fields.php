<?php
/*
 * Inesrt custom fields for shop taxonomy.
 */
function sr_insert_customer_fields() {
	global $post;
	wp_nonce_field( SR_Config::NAME . 'fields', SR_Config::PREFIX . 'report' );
	$handdraw = SR_fieldname_to_attr::change_id_name( 'customer_handdraw' )[0];
	$treatment_datail = SR_fieldname_to_attr::change_id_name( 'customer_treatment_datail' )[0];
	?>
	<div class="customer_form_field">
		<div class="customer_form_field__item">
			<?php echo SR_input::input_field( 'datetime-local', 'customer_visit_datetime', '来店日時', ['js-datetime'] ); ?>
		</div>
		<div class="customer_form_field__item">
			<label class="customer_form_field__item__label" for="customer_visit_shop">来店ショップ</label>
			<?php get_shoplist_field( $post ); ?>
		</div>
		<div class="customer_form_field__item">
			<p class="customer_form_field__item__label">施術メニュー</p>
			<?php get_customer_menu_field( $post ); ?>
		</div>
		<div class="customer_form_field__item">
			<label for="customer_treatment_datail">施術メモ</label>
			<div id="handDraw" class="hand-draw"></div>
			<input type="hidden" data-loop="0" id="<?php echo $handdraw['id'] ?>" name="<?php echo $handdraw['name'] ?>" class="js-handdraw-data" value="<?php echo get_post_meta( $post->ID, $handdraw['name'], true ); ?>">
		</div>
		<div class="customer_form_field__item">
			<?php echo SR_input::input_field( 'number', 'customer_peyment', 'お支払い金額' ); ?>
		</div>
		<div class="customer_form_field__item">
			<label for="customer_treatment_datail">施術メニュー詳細</label>
			<textarea name="<?php echo $treatment_datail['name'] ?>" id="<?php echo $treatment_datail['id'] ?>"><?php echo get_post_meta( $post->ID, $treatment_datail['name'], true ); ?></textarea>
		</div>
	</div>
<?php }
