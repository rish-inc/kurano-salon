<?php
/*
 * Gender data contoller
 */

function get_gender_field( $post ) {
	$gender_datas =  [ "man" => "男性", "woman" => "女性" ];
	$get_gender = get_post_meta( $post->ID, 'customer_gender', true );
	$genders = $get_gender ? $get_gender : array();
	foreach ( $gender_datas as $gender_data_key => $gender_data_value ) :
		if ( in_array( $gender_data_value, $genders ) ) {
			$gender_check = "checked";
		} else {
			$gender_check = "";
		}
		?>
		<?php
			echo '<label class="customer_form_field__item__label">' . $gender_data_value . ' <input type="radio" name="customer_gender[]" id="' . $gender_data_key . '" value="' . $gender_data_value . '" ' . $gender_check . '></label>';
		?>
	<?php endforeach;
}
