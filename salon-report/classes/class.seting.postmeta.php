<?php
/*
 * seting postmeta
 * $type    = input type
 * $name    = input name
 * $title   = label title
 * $classes = input class Array();
 */


class SR_input {
	public $name_attr;
	public $data, $type, $name, $title, $classes = array();
	public static function input_field ( $type, $name, $title, $classes = NULL ) {
		global $post;
		$attr = SR_fieldname_to_attr::change_id_name( $name )[0];
		$value = get_post_meta( $post -> ID, $attr['name'], true );
		$class = $classes ? implode( " ", $classes ) : $classes;
		printf( '<label class="customer_form_field__item__label %s" for="%s">%s</label>', $class, $attr['id'], $title );
		echo "\n";;
		printf( '<input type="%s" name="%s" id="%s" value="%s">', $type, $attr['name'], $attr['id'], $value );
	}
}
