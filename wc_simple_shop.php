<?php
/*
Plugin Name: Wordpress Simple Shop
Plugin URI: http://www.webfulcreations.com/
Description: Plugin helps to make Shop with products and orders.
Version: 1.0
Author: Ateeq Rafeeq 
Author URI: http://www.make-mywebsite.com/
License: GPLv2 or later
*/
if(!defined('DS')) {
  define('DS','/'); //Defining Directory seprator, not using php default Directory seprator to avoide problem in windows.
}

//Define folder name.
define('WC_SIMPLE_SHOP_FOLDER', dirname(plugin_basename(__FILE__)));
define('WC_SIMPLE_SHOP_DIR', plugin_dir_path( __FILE__ ));
//end of defining locations. for plugin directory.

add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}

include_once(WC_SIMPLE_SHOP_DIR.'activate.php'); //Activate plugin functions.
register_activation_hook(__FILE__, 'wc_shop_install'); //plugin activation hook.


include_once(WC_SIMPLE_SHOP_DIR.'admin_menu.php'); //admin menu functions
add_action('admin_menu', 'wc_ad_pages'); // Hook for adding admin menus

//admin pages starts here.
include_once(WC_SIMPLE_SHOP_DIR.'includes'.DS.'main_page.php'); //Main Page Function.
include_once(WC_SIMPLE_SHOP_DIR.'includes'.DS.'add_category.php'); //Add Category Function.
include_once(WC_SIMPLE_SHOP_DIR.'includes'.DS.'product_categories.php'); //Manage Food categories Function.
include_once(WC_SIMPLE_SHOP_DIR.'includes'.DS.'add_product.php'); //Add food Function.
include_once(WC_SIMPLE_SHOP_DIR.'includes'.DS.'products_page.php'); //Add food Function.
include_once(WC_SIMPLE_SHOP_DIR.'includes'.DS.'shortcodes.php'); //Add food Function.
include_once(WC_SIMPLE_SHOP_DIR.'includes'.DS.'orders.php'); //Order List ends here..
include_once(WC_SIMPLE_SHOP_DIR.'includes'.DS.'process_shopping.php'); //Add food Function.
//admin pages ends here.

//adding styles and scripts to theme front end,.
function wc_enqeue_scripts() { 
	wp_register_style('wc_shop_style', plugins_url('css/style.css', __FILE__ ), array());
    wp_enqueue_style('wc_shop_style');
	//addingstyles
	wp_register_script('wc_shop_js', plugins_url('js/myshop.js', __FILE__ ), array('jquery'), '1.1');
    wp_enqueue_script('wc_shop_js');
}
add_action('wp_enqueue_scripts', 'wc_enqeue_scripts');
//enque scripts and styles ends here. For theme front.

//adding styles and scripts for worpress admin
add_action('admin_enqueue_scripts', 'restaurant_admin_scripts');
 
function restaurant_admin_scripts() {
    if((isset($_GET['page']) && $_GET['page'] == 'sub-page2') || (isset($_GET['page']) && $_GET['page'] == 'add_product') || (isset($_GET['page']) && $_GET['page'] == 'add_category')) {
        //register styles.
		wp_register_style('demo-style', plugins_url('includes/media/css/demo_page.css', __FILE__ ), array());
    	wp_enqueue_style('demo-style');
		wp_register_style('demo-table', plugins_url('includes/media/css/demo_table_jui.css', __FILE__ ), array());
    	wp_enqueue_style('demo-table');
		wp_register_style('table-css', plugins_url('includes/themes/smoothness/jquery-ui-1.8.4.custom.css', __FILE__ ), array());
    	wp_enqueue_style('table-css');
		//register admin js.
		wp_register_script('dt-js', plugins_url('includes/media/js/jquery.dataTables.js', __FILE__ ), array('jquery'), '1.3');
        wp_enqueue_script('dt-js');
		wp_enqueue_media();
		wp_register_script('my-admin-js', plugins_url('js/my-admin.js', __FILE__ ), array('jquery'), '1.1');
        wp_enqueue_script('my-admin-js');
		}
}
//end of adding styles and scripts for wordpress admin.