<?php
if(!defined('WP_UNINSTALL_PLUGIN')) {
	exit();
}
global $wpdb;
//Unistalling tables
$wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.'wc_shop_category');
$wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.'wc_product_menu');
$wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.'wc_orders');
$wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.'wc_order_meta');