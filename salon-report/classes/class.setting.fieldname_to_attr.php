<?php
/*
 * Get field name convert to id and name attr.
 * $name    = get field name
 */

class SR_fieldname_to_attr {
	public $name, $loop_count;

	public static function change_id_name ( $name, $loop_count ) {
		$attr['id']   = $name . '[' . SR_Config::PREFIX . 'report' . $loop_count . ']';
		$attr['name'] = $name . '_' . SR_Config::PREFIX . 'report' . $loop_count;
		return array( $attr );
	}
}
