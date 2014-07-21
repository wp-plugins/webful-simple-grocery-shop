<?php
//process items and shopping cart function.
//add to cart button function.
if(isset($_POST['product_id']) && isset($_POST['qty']) && $_POST['product_id'] != '' && $_POST['qty'] != '') { 
	add_to_cart($_POST['product_id'], $_POST['qty'], $_POST['size'], $_POST['comments']);
} else { 
	$_SESSION['success_message'] = 'Please enter quantity.';
}

if(isset($_POST['full_name']) && $_POST['full_name'] != '' && $_POST['my_checkout'] == '1') { 
	checkout($_POST['full_name'],$_POST['phone_number'],$_POST['delivery_date'],$_POST['address_1'],$_POST['address_2'],$_POST['city'],$_POST['province'],$_POST['country']);
	unset($_SESSION['shopping_bag']);
} 

function add_to_cart($product_id, $qty, $size, $comment) {
	myStartSession();
	if(isset($_SESSION['shopping_bag'])) {
		$cart = $_SESSION['shopping_bag'];
		$arr = array(
			'product_id' => $product_id,
			'qty' => $qty,
			'size' => $size, 
			'comment' => $comment
		);
		$cart[] = $arr;
		$_SESSION['shopping_bag'] = $cart;
		} else {
			$_SESSION['shopping_bag'] = array(
			array( 
				'product_id' => $product_id,
				'qty' => $qty,
				'size' => $size, 
				'comment' => $comment
			)
		);
	}
	$_SESSION['success_message'] = 'Cart updated successfuly.';
}//add_to_cart Function ends here.

function checkout($full_name, $phone_number, $delivery_date, $address_1, $address_2, $city, $province, $country) { 
	global $wpdb;
	myStartSession();
	$curr_date = date('Y-m-d');
	$wpdb->insert( 
		$wpdb->prefix.'wc_orders', 
		array( 
			'order_id' => NULL, 
			'full_name' => $full_name,
			'phone_number' => $phone_number,
			'delivery_date' => $delivery_date,
			'address_1' => $address_1,
			'address_2' => $address_2,
			'city' => $city,
			'province' => $province,
			'country' => $country,
			'order_status' => 'Pending',
			'order_date' => $curr_date
		)
	);
	$order_id = $wpdb->insert_id;
	
	foreach($_SESSION['shopping_bag'] as $bag) { 
		$wpdb->insert( 
			$wpdb->prefix.'wc_order_meta', 
				array( 
					'order_meta_id' => NULL, 
					'order_id' => $order_id,
					'product_id' => $bag['product_id'],
					'quantity' => $bag['qty'],
					'comments' => $bag['comment'],
					'size' => $bag['size']
				)
		);
	}
	extract($_POST);
	$message = '<h1>New order.</h1>';
	$message .= '<p>To check order details please Go to your wordpress dashboard and check orders section under shop menu.</p>';
	
	/*$message .= '<h3>Card Details</h3>';
	
	$message .= '<table width="100%" border="1px" cellpadding="5">';
	$message .= '<tr><th>First Name</th><td>';
	$message .= $card_first_name;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Last Name</th><td>';
	$message .= $card_last_name;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Phone Number</th><td>';
	$message .= $card_phone_num;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Name on card</th><td>';
	$message .= $card_nameoncard;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Type of card</th><td>';
	$message .= $card_card_type;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Credit card number</th><td>';
	$message .= $card_numberofcard;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Expiration Date</th><td>';
	$message .= $card_expirydate;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Security code</th><td>';
	$message .= $card_securitycode;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Billing Address</th><td>';
	$message .= $card_billingadd;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Cardholder Initials</th><td>';
	$message .= $card_holderinitials;
	$message .= '</td></tr>';
	
	$message .= '<tr><th>Date</th><td>';
	$message .= $card_date;
	$message .= '</td></tr>';
	$message .= '</table>';*/
	
			$mailto = get_option('admin_email');
			//getting set email addresses from database.
			$from_email = get_option('admin_email');
			$reply_to = get_option('admin_email');
			
			$mailheaders = "From:".$from_email;
			$mailheaders .="Reply-To:".$reply_to;
			$from = $from_email;
			$subject = 'New order at '.get_option('blogname');

			$headers = "FROM: ".$from;
					$semi_rand = md5(time());
					$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
			
					$headers .= "\nMIME-Version: 1.0\n" .
					"Content-Type: multipart/mixed;\n" .
					" boundary=\"{$mime_boundary}\"";
			
					$message .= "This is a multi-part message in MIME format.\n\n" .
					"--{$mime_boundary}\n" .
					"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
					"Content-Transfer-Encoding: 7bit\n\n" .
					$message . "\n\n";
					$message .= "--{$mime_boundary}\n" .
					"Content-Type: {$fileatt_type};\n" .
					" name=\"{$filename}\"\n" .
					"Content-Transfer-Encoding: base64\n\n" .
					mail($mailto, $subject, $message, $headers);
	$_SESSION['checkout_done'] = 'Thank you for order we will contact you within 12 hours.';	
}

if(isset($_POST['order_id']) && isset($_POST['order_status'])) { 
	update_order($_POST['order_id'], $_POST['order_status']);
}

function update_order($order_id, $status) { 
	global $wpdb;
	$wpdb->update( 
		$wpdb->prefix.'wc_orders', 
		array( 
			'order_status' => $status
		), 
		array('order_id' => $order_id)
	);
}