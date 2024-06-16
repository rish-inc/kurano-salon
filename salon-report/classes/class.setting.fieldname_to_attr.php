<?php
/*
 * Get field name convert to id and name attr.
 * $name    = get field name
 */

class SR_fieldname_to_attr {
	public $name;

	public static function change_id_name ( $name ) {
		$attr['id']   = $name . '[' . SR_Config::PREFIX . 'report' . '0' . ']';
		$attr['name'] = $name . '_' . SR_Config::PREFIX . 'report' . '0';
		return array( $attr );
	}
}
