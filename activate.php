<?php
//Installation of plugin starts here.
function wc_shop_install() {
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
		$sql = 'CREATE TABLE '.$wpdb->prefix.'wc_shop_category (
			`cat_id` bigint(20) NOT NULL AUTO_INCREMENT,
			`cat_name` text NOT NULL,
  			`cat_description` varchar(800) NOT NULL,
  			`cat_featured_img` varchar(200) NOT NULL,
  			PRIMARY KEY (`cat_id`)
		)';	
		dbDelta($sql);
	
		$sql = 'CREATE TABLE '.$wpdb->prefix.'wc_product_menu (
			`product_id` bigint(20) NOT NULL AUTO_INCREMENT,
			`product_category` bigint(20) NOT NULL,
  			`product_name` text NOT NULL,
  			`product_description` varchar(800) NOT NULL,
			`product_thumb` varchar(200) NOT NULL,
			`product_price` varchar(200) NOT NULL,
  			PRIMARY KEY (`product_id`)
		)';	
		dbDelta($sql);
		
		$sql = 'CREATE TABLE '.$wpdb->prefix.'wc_orders (
			`order_id` bigint(20) NOT NULL AUTO_INCREMENT,
			`order_date` date NOT NULL,
			`full_name` text NOT NULL,
  			`phone_number` text NOT NULL,
  			`delivery_date` varchar(200) NOT NULL,
			`address_1` varchar(200) NOT NULL,
			`address_2` varchar(200) NOT NULL,
			`city` varchar(200) NOT NULL,
  			`province` varchar(200) NOT NULL,
			`country` varchar(200) NOT NULL,
			`order_status` varchar(200) NOT NULL,
			PRIMARY KEY (`order_id`)
		)';	
		dbDelta($sql);
		
		$sql = 'CREATE TABLE '.$wpdb->prefix.'wc_order_meta (
			`order_meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
			`order_id` bigint(20) NOT NULL,
  			`product_id` bigint(20) NOT NULL,
			`quantity` varchar(50) NOT NULL,
			`comments` varchar(300) NOT NULL, 
			`size` varchar(50) NOT NULL,
  			PRIMARY KEY (`order_meta_id`)
		)';	
		dbDelta($sql);
		
	if(!get_page_by_title('Checkout')) {
	$checkout_page = array(
		'post_title' => 'Checkout',
		'post_content' => '[my_checkout]',
		'post_status' => 'publish',
		'post_type' => 'page',
		'post_author' => 1,
		'post_date' => date('Y-m-d H:m:s')
	);
	$post_id = wp_insert_post($checkout_page);
	}
	
	if(!get_page_by_title('Products')) {
	$products_page = array(
		'post_title' => 'Products',
		'post_content' => '[my_shop]',
		'post_status' => 'publish',
		'post_type' => 'page',
		'post_author' => 1,
		'post_date' => date('Y-m-d H:m:s')
	);
	$post_id = wp_insert_post($products_page);
	}
}//end of function wc_restaurant_install()	
