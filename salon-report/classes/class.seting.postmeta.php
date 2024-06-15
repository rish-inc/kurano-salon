<?php
/*
 * seting postmeta
 */

class SR_input {
	public $name_attr;
	public $data, $type, $name, $title, $classes = array();
	public static function input_field ( $type, $name, $title, $classes = NULL ) {
		global $post;
		$attr_id   = $name . '[' . SR_Config::PREFIX . 'report' . '0' . ']';
		$attr_name = $name . '_' . SR_Config::PREFIX . 'report' . '0';
		$value = get_post_meta( $post -> ID, $name, true )[ SR_Config::PREFIX . 'report' . '0' ];
		$class = $classes ? implode( ", ", $classes ) : "";
		echo '<div class="customer_form_field__item">';
		printf( '<label class="%s" for="%s">%s</label>', $class, $attr_id, $title );
		printf( '<input type="%s" name="%s" id="%s" value="%s">', $type, $attr_name, $attr_id, $value );
		echo '</div>';
	}
}
