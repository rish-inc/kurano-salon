<?php
/*
 * seting postmeta
 * $type    = input type
 * $name    = input name
 * $title   = label title
 * $classes = input class Array();
 */


class SR_input {
	public $name_attr, $loop_count;
	public $data, $type, $name, $title, $required_flg, $classes = array();
	public static function input_field ( $type, $name, $title, $loop_count, $required_flg = NULL, $classes = NULL ) {
		global $post;
		$attr = SR_fieldname_to_attr::change_id_name( $name, $loop_count )[0];
		$value = get_post_meta( $post -> ID, $attr['name'], true );
		if ( $required_flg ) {
			$required = "required";
			$title = $title . "<span class='required'> (必須)";
		} else {
			$required = "";
		}
		$class = $classes ? implode( " ", $classes ) : $classes;
		switch( $type ) {
			case 'datetime-local':
				$validation = '<p class="is-error">日付を選択してください</p>';
				break;
			case 'number':
				$validation = '<p class="is-error">数字を入力してください</p>';
				break;
			default:
				$validation = '';
				break;
		}

		printf( '<label class="customer_form_field__item__label %s" for="%s">%s</label>', $class, $attr['id'], $title );
		echo "\n";
		if ( $value ) {
			printf( '<div class="cf-input-field"><input type="%s" name="%s" id="%s" value="%s" %s>%s</div>', $type, $attr['name'], $attr['id'], $value, $required, $validation );
		} else {
			printf( '<div class="cf-input-field"><input type="%s" name="%s" id="%s" %s>%s</div>', $type, $attr['name'], $attr['id'], $required, $validation );
		}
	}
}
