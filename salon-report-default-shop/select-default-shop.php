<?php
/**
 * Plugin name: Select default shop for Salon Report
 * Plugin URI: https://github.com/rish-inc/kurano-salon/tree/main/salon-report/
 * Description: Add on plugin for select default shop
 * Version: 1.0.0
 * Author: yat8823jp
 * Author URI: https:rish.style
 * Text Domain: salon-report-default-shop
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package salon-report-default-shop
 * @author yat8823jp
 * @license GPL-2.0+
 */

/*
 * wp_enqueue scripts and styles
 */
function sr_select_default_shop_scripts( $hook_suffix ) {
	wp_enqueue_script( 'select-default-shop', plugins_url() . '/salon-report-default-shop/select-default-shop.js', array(), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'sr_select_default_shop_scripts' );
