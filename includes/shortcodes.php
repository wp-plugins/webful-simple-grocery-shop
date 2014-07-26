<?php
include_once(dirname(__FILE__).'/my_shop.php'); //My shop function inside..

function my_bag() { 
	global $wpdb;
	if(isset($_SESSION['shopping_bag'])) { 
		$items = count($_SESSION['shopping_bag']);
	} else { 
		$items = 0;
	}	
	$content = '<div class="bag_wrap">';
	$content .= '<img src="'.plugins_url('../images/shopping_bag.png' , __FILE__ ).'" class="shopping_bag" width="50" />';
	$content .= '<p>'.$items.' Items</p>';
	$content .= '<a href="checkout">Checkout</a>';
	$content .= '<div class="clearIt"></div>';
	$content .= '</div><!--mybag warp ends here-->';
	
	echo $content;
}//my bag function ends here.-
add_shortcode('my_bag', 'my_bag');

function my_checkout() { 
	global $wpdb;

	$content = '';
	if(isset($_SESSION['checkout_done'])) {
		$content .= '<div class="success_message">'.$_SESSION['checkout_done'].'</div><!--add to cart success message here.-->';
		unset($_SESSION['checkout_done']);
	}
	
	if(!isset($_SESSION['shopping_bag'])) { 
		$content .= 'Your shopping bag is empty';
		echo $content;
		exit();
	}
	
	$content .= '<h3>Items in your bag</h3>';
	$content .= '<table cellpadding="5" cellspacing="0" border="1" width="100%">';
	$content .= '<tr>';
	$content .= '<th width="40">SR#</th>';
	$content .= '<th width="220">Product</th>';
	$content .= '<th width="40">Size</th>';
	$content .= '<th width="40">QTY</th>';
	$content .= '<th>Comments</th>';
	$content .= '</tr>';
	
	$counter = 1;
	
	foreach($_SESSION['shopping_bag'] as $bag) { 
		$products_row = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_product_menu WHERE product_id='".$bag['product_id']."'");
		foreach($products_row as $products_r) { 
			$product_name = $products_r->product_name;
		}
		$content .= '<tr>';
		$content .= '<td>'.$counter.'</td>';
		$content .= '<td>'.$product_name.'</td>';
		$content .= '<td>'.$bag['size'].'</td>';
		$content .= '<td>'.$bag['qty'].'</td>';
		$content .= '<td>'.$bag['comment'].'</td>';
		$content .= '</tr>';	
		
		$counter++;
	}
	$content .= '</table><br>';

	$content .= '<p>Please fill your information below to submit order. We will contact you within 12 hours.</p>';
	$content .= '<form method="post" action="">';
	$content .= '<table width="500" cellpadding="10">';
	
	$content .= '<tr><th width="150px">Full Name</th><td>';
	$content .= '<input type="text" required="required" name="full_name" placeholder="Full Name">';
	$content .= '</td></tr>';
	
	$content .= '<tr><th>Phone Number</th><td>';
	$content .= '<input type="text" required="required" name="phone_number" placeholder="Phone Number">';
	$content .= '</td></tr>';
	
	$content .= '<tr><th>Delivery Date</th><td>';
	$content .= '<input type="text" name="delivery_date" placeholder="Format 12/30/2014">';
	$content .= '</td></tr>';
	
	$content .= '<tr><th>Delivery Address</th><td>';
	$content .= '<textarea name="address_1" placeholder="Address"></textarea>';
	$content .= '</td></tr>';
	
	$content .= '<tr><th>Property Management Company and Phone Number</th><td>';
	$content .= '<textarea name="address_2" placeholder="Property Management Company and Phone Number"></textarea>';
	$content .= '</td></tr>';
	
	$content .= '<tr><th>City</th><td>';
	$content .= '<input type="text" name="city" placeholder="City">';
	$content .= '</td></tr>';
	
	$content .= '<tr><th>State</th><td>';
	$content .= '<input type="text" name="province" placeholder="State">';
	$content .= '</td></tr>';
	
	$content .= '<tr><th>Country</th><td>';
	$content .= '<input type="text" name="country" placeholder="Country">';
	$content .= '</td></tr>';
	
	$content .= '<tr><th>&nbsp;</th><td>';
	$content .= '<input type="hidden" name="my_checkout" value="1">';
	$content .= '<input type="submit" value="Checkout">';
	$content .= '</td></tr>';
	
	$content .= '</table>';
	$content .= '</form>';
	echo $content;
}
add_shortcode('my_checkout', 'my_checkout');