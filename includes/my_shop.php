<?php
function my_shop() {
	global $wpdb;
	$cat_query = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_shop_category ORDER by cat_name ASC");

	$content = '<div class="shop_wrap">';
	$content .= '<div class="shop_cat_wrap">';
	$content .= '<h2 class="product_cat_head">Categories</h2>';
	$content .= '<ul>';
	foreach($cat_query as $category_row) {
		if(isset($_GET['page_id'])) { 
			$attr = "?page_id=".$_GET['page_id']."&shop_cat_id=".$category_row->cat_id;
		} else { 
			$attr = "?shop_cat_id=".$category_row->cat_id;
		}
		$content .= '<li><a href="'.$attr.'">'.$category_row->cat_name.'</a></li>';
	}
	$content .= '</ul>';
	$content .= '<a href="#" id="res_btn">Caretogies</a>';
	$content .= '</div><!--shop cat wrap ends here.-->';
	$content .= '<div class="shop_right_wrap">';
	if(isset($_SESSION['success_message'])) {
	$content .= '<div class="success_message">'.$_SESSION['success_message'].'</div><!--add to cart success message here.-->';
	unset($_SESSION['success_message']);
	}
	if(isset($_GET['shop_cat_id'])) { 
		$products_row = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_product_menu WHERE product_category='".$_GET['shop_cat_id']."' ORDER by product_name ASC");
		$cat_q = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_shop_category WHERE cat_id='".$_GET['shop_cat_id']."'");		
		
		foreach($cat_q as $category_r) {
			$content .= '<h1>'.$category_r->cat_name.'</h1>';
			if($category_r->cat_description != '') { 
				$content .= '<p>'.$category_r->cat_description.'</p><hr>';
			} else { 
				$content .= '<hr>';
			}
		}
	} else { 
		$products_row = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_product_menu WHERE product_id='atalfa' ORDER by product_name ASC");
		//Zaib you can work here.
		$content .= '<h2>Select a category.</h2>';
		$content .= 'Please select a category to list related products.';
		//zaib you have to end work here.
		
	}
	foreach($products_row as $product_row) {
	$content .= '<div class="product">';
	if($product_row->product_thumb != '') { 
		$product_thumb = '<img src="'.$product_row->product_thumb.'" class="product_thumb" width="50px" height="50px" />';
	} else { 
		$product_thumb = '';
	}
	if($product_row->product_price != '') { 
		$product_price = '<br><strong>Price: </strong>'.$product_row->product_price;
	} else { 
		$product_price = '';
	}
	$content .= '<div class="product_detail"><h3>'.$product_row->product_name.'</h3><p class="description">'.$product_thumb.''.$product_row->product_description.$product_price.'</p></div>';
	$content .= '<div class="product_form">';
	$content .= '<form name="add_product" method="post">';
	$content .= '<input type="text" name="comments" class="comment" placeholder="Comment" /><br>';
	$content .= '<input type="text" name="size" placeholder="size" />';
	$content .= '<input type="text" name="qty" placeholder="QTY" required="required" />';
	$content .= '<input type="hidden" name="product_id" value="'.$product_row->product_id.'" />';
	$content .= '<input type="submit" value="Add to cart" />';
	$content .= '</form>';
	$content .= '</div><!--product form ends here.-->';
	$content .= '<div class="clearIt"></div>';
	$content .= '</div><!--product ends here.-->';	
	}//end foreach
	$content .= '</div><!--right side ends here.-->';
	$content .= '<div class="clearIt"></div>';
	$content .= '</div><!--Shop Wrap Ends here.-->';
	echo $content;
}//get_cat_and_items ends here.
add_shortcode('my_shop', 'my_shop');
//category items