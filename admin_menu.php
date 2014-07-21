<?php
// action function for above hook
function wc_ad_pages() {
    // main_sub Menu Page
    add_menu_page(__('My Shop','root'), __('My Shop','root'), 'manage_options', 'mt-top-level-handle', 'wc_my_shop');

    // Locations Page sub menu
    add_submenu_page('mt-top-level-handle', __('Add Category','root'), __('Add Category','root'), 'manage_options', 'add_category', 'add_category');
	
	add_submenu_page('mt-top-level-handle', __('Manage Categories','root'), __('Manage Categories','root'), 'manage_options', 'product_categories', 'product_categories');

	// Foods add page sub menu
    add_submenu_page('mt-top-level-handle', __('Add Products','root'), __('Add Products','root'), 'manage_options', 'add_product', 'add_product_page');

    // Foods page sub menu
    add_submenu_page('mt-top-level-handle', __('Manage Products','root'), __('Manage Products','root'), 'manage_options', 'sub-page2', 'product_page');
	
	// List Orders
    add_submenu_page('mt-top-level-handle', __('List Orders','root'), __('List Orders','root'), 'manage_options', 'list_orders', 'list_orders_page');
}