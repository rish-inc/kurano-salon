<?php
/*
 * Customer menu data contoller
 * Loading treatment-menu-label terms
 */
function get_customer_menu_field( $post ) {
	$menu_terms = get_terms( 'treatment' , array( 'hide_empty' => false ) );
	$users = get_users(
		array (
			'orderby' => 'ID',
			'order' => 'ASC',
		)
	);
?>
<ul id="customer_menu_<?php echo SR_Config::PREFIX . 'report' . "0"; ?>" class="customer_form_field__multibox">
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
			<?php echo( $menu_term -> name ); ?> <input class="js-check-menu" type="checkbox" name="customer_menu[<?php echo SR_Config::PREFIX . 'report' . "0"; ?>]" value="<?php echo( $menu_term -> name ); ?>" <?php echo $customer_menu_checked; ?>>
		</label>
		<select class="customer_form_field__multibox__selector js-menu-staff" name="customer_staff[<?php echo SR_Config::PREFIX . 'report' . "0"; ?>]['<?php echo $menu_slug; ?>']">
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
				$get_designate = get_post_meta( $post->ID, 'designate[' . SR_Config::PREFIX . 'report' . "0" . ']', true );
				$designate = $get_designate ? $get_designate : array();
				if ( isset( $designate["'$menu_slug'"] ) )  {
					$designate_check = "checked";
				} else {
					$designate_check = "";
				}
			?>
			<span>
				<label>指名 <input class="js-check-designate" type="checkbox" name="designate['<?php echo $menu_slug; ?>'][<?php echo SR_Config::PREFIX . 'report' . "0"; ?>]" <?php echo $designate_check; ?>></label>
			</span>
		</div>
	<li>
<?php endforeach; ?>
</ul>
<?php }
