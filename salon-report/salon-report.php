<?php
/**
 * Plugin name: Salon Report
 * Plugin URI: https://github.com/rish-inc/kurano-salon/tree/main/salon-report/
 * Description: Salon Report plugin is add custom post type.
 * Version: 1.0.0
 * Author: yat8823jp
 * Author URI: https:rish.style
 * Text Domain: salon-report
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package salon-report
 * @author yat8823jp
 * @license GPL-2.0+
 */

/*
 * read templates
 */
class Salon_Report {
	public function __construct() {
		require_once plugin_dir_path( __FILE__ ) . 'classes/class.config.php';
		require_once plugin_dir_path( __FILE__ ) . 'classes/class.seting.postmeta.php';
		require_once plugin_dir_path( __FILE__ ) . 'classes/class.setting.fieldname_to_attr.php';
		require_once plugin_dir_path( __FILE__ ) . 'add_post_type.php';
		require_once plugin_dir_path( __FILE__ ) . 'add_custom_fields.php';

		require_once plugin_dir_path( __FILE__ ) . 'contoroller/read-assets.php';
		require_once plugin_dir_path( __FILE__ ) . 'contoroller/gender.php';
		require_once plugin_dir_path( __FILE__ ) . 'contoroller/shoplist.php';
		require_once plugin_dir_path( __FILE__ ) . 'contoroller/customer_menu.php';
		require_once plugin_dir_path( __FILE__ ) . 'contoroller/gender.php';
		require_once plugin_dir_path( __FILE__ ) . 'contoroller/shoplist.php';
		require_once plugin_dir_path( __FILE__ ) . 'contoroller/customer_menu.php';
		require_once plugin_dir_path( __FILE__ ) . 'contoroller/validation.php';

		require_once plugin_dir_path( __FILE__ ) . 'view/main-insert-customer-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'view/personal-insert-customer-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'view/shop-add-term-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'view/shop-edit-term-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'view/store-products-add-term-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'view/store-products-edit-term-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'view/manage_store_products_columns.php';

		require_once plugin_dir_path( __FILE__ ) . 'model/main-save-customer-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'model/personal-save-customer-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'model/shop-save-term-fields.php';
		require_once plugin_dir_path( __FILE__ ) . 'model/store-products-save-term-fields.php';

	}
}
new Salon_Report();
