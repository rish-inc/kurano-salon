<?php
/*
 * Manage store pdoducts columns
 */

function add_column_for_store_products( $columns ) {
	$columns['sr_custom_store_products_price'] = '金額';
	return $columns;
}
add_filter( 'manage_edit-store_products_columns', 'add_column_for_store_products', 1, 2 );

function load_data_column_for_store_products( $content, $column_name, $term_id ) {
    if ( $column_name == 'sr_custom_store_products_price' ) {
        $store_products = get_term_meta( $term_id, 'sr_custom_store_products_price', true );

        switch ( $store_products ) {
            case '':
                echo '';
                break;
            default:
                echo esc_html( number_format( $store_products ) ) . "円";
        }
    }
}
add_action('manage_store_products_custom_column', 'load_data_column_for_store_products', 10, 3 );

function sortable_column_for_store_products( $columns ) {
    $columns['sr_custom_store_products_price'] = '金額';
    return $columns;
}
add_filter( 'manage_edit-store_products_sortable_columns', 'sortable_column_for_store_products' );
