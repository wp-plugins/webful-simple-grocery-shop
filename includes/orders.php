<?php

function list_orders_page() { 
	if (!current_user_can('manage_options')) {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	global $wpdb; 
	
	if(isset($_GET['order_id']) && $_GET['order_id'] != '') :
	//order id does exist, order detail would display.
	$order_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_orders WHERE order_id='".$_GET['order_id']."'");
	
	?>
    <style type="text/css">
    @media print {    
    	#adminmenuwrap, #adminmenuwrap *, #adminmenuback, #adminmenuback *{
        	display: none !important;
			width:0px;
	   	}
		#wpcontent { 
			margin-left:0px;
		}
	}
    </style>
    <div style="border:1px solid #000;padding:10px;width:720px;margin:auto;background-color:#FFF;margin-top:15px;">
    <h1 style="text-align:center;"><?php echo bloginfo('name'); ?> | Order Detail</h1>
    <hr />
    <?php foreach($order_rows as $order_row): ?>
    <p><strong>Full Name: </strong> <?php echo $order_row->full_name; ?> 
    &nbsp;&nbsp;&nbsp;<strong>Phone Number: </strong> <?php echo $order_row->phone_number; ?>
    &nbsp;&nbsp;&nbsp;<strong>Order Date: </strong> <?php echo $order_row->order_date; ?>
    <br /><strong>Delivery Date: </strong> <?php echo $order_row->delivery_date; ?>
    &nbsp;&nbsp;&nbsp;<strong>Order Status: </strong> <?php echo $order_row->order_status; ?>
    &nbsp;&nbsp;&nbsp;<strong>Order Id: </strong> <?php echo $order_row->order_id; ?>
    </p>
    <p><strong>Address: </strong> <?php echo $order_row->address_1.' '.$order_row->city.' '.$order_row->province.' '.$order_row->country; ?></p>
    <p><strong>Property Management Company and Phone Number: </strong> <?php echo $order_row->address_2; ?></p>
    <?php endforeach; ?>

    <h3>Order Detail</h3>
   <table cellspacing="0" cellpadding="5" width="100%" align="center" border="1">
    <tr>
            <th>Sr#</th>
            <th>Product Name</th>
            <th>Size</th>
           <th>Qty</th>
           <th>Comment</th>
        </tr>
       <?php
            $order_meta = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_order_meta WHERE order_id='".$_GET['order_id']."'");
            $counter = 1;
            foreach($order_meta as $order_info):			
            $products_row = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_product_menu WHERE product_id='".$order_info->product_id."'");
foreach($products_row as $products_r) { 
    $product_name = $products_r->product_name;
}
        ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $product_name; ?></td>
                <td><?php echo $order_info->size; ?></td>
                <td><?php echo $order_info->quantity; ?></td>
                <td><?php echo $order_info->comments; ?></td>
            </tr>
        <?php 
            $counter++;
            endforeach; 
        ?>
    </table>
</div>
    <?php
	
	else:  //Order id does not exist list order would display.
	
	echo "<div class='wrap'><h2>Customer Orders</h2>";
	?>
    
    <div class="col-wrap" id="example">
	&nbsp;<br />	

	<a class='add-new-h2' href="admin.php?page=<?php echo $_GET['page'];?>&list=Pending">Pending</a> <a class='add-new-h2' href="admin.php?page=<?php echo $_GET['page'];?>&list=Processed">Processed</a> <a class='add-new-h2' href="admin.php?page=<?php echo $_GET['page']; ?>&list=All">All</a><br />

<table cellspacing="0" class="wp-list-table widefat fixed tags">
	<thead>
	<tr>
        <th><a href="#">Date</a></th>
        <th>Full Name</th>
        <th>Phone#</th>
        <th>Delivery Date</th>
        <th>Address</th>
        <th>Status</th>
        <th>View</th>
     	<th>Update</th>
     </tr>
	</thead>
	<tfoot>
	<tr>
        <th><a href="#">Date</a></th>
        <th>Full Name</th>
        <th>Phone#</th>
        <th>Delivery Date</th>
        <th>Address</th>
        <th>Status</th>
        <th>View</th>
        <th>Update</th>
     </tr>
	</tfoot>
	<tbody data-wp-lists="list:tag" id="the-list">
    <?php
		global $wpdb;
		if (!current_user_can('manage_options')) {
	      wp_die( __('You do not have sufficient permissions to access this page.') );
    }


	if(isset($_GET['list']) && $_GET['list'] == 'Pending') { 
			$order_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_orders WHERE order_status='Pending' ORDER by order_id DESC");
		} else if(isset($_GET['list']) && $_GET['list'] == 'Processed') { 
			$order_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_orders WHERE order_status='Processed' ORDER by order_id DESC");
		} else if(isset($_GET['list']) && $_GET['list'] == 'All') { 
			$order_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_orders ORDER by order_id DESC");	
		} else { 
			$order_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_orders WHERE order_status='Pending' ORDER by order_id DESC");
		}
		foreach($order_rows as $order_row) {
	?>
     <tr class="alternate">
    	<td><?php echo $order_row->order_date; ?></td>
        <td><?php echo $order_row->full_name; ?></td>
        <td><?php echo $order_row->phone_number; ?></td>
        <td><?php echo $order_row->delivery_date; ?></td>
        <td><?php echo $order_row->address_1.' '.$order_row->city.' '.$order_row->province.' '.$order_row->country; ?></td>
        <td><?php echo $order_row->order_status; ?></td>
        <td><a href="admin.php?page=<?php echo $_GET['page']; ?>&order_id=<?php echo $order_row->order_id; ?>">View</a></td>

     	<td>

        	<form action="" method="post">

            	<select name="order_status">

                	<option value="Pending" <?php if($order_row->order_status == 'Pending') echo 'selected="selected"'; ?>>Pending</option>

                    <option value="Processed" <?php if($order_row->order_status == 'Processed') echo 'selected="selected"'; ?>>Processed</option>

                </select>

            	<input type="hidden" name="order_id" value="<?php echo $order_row->order_id; ?>" />

            	<input type="submit" value="Update" class="button" />

            </form>

        </td>

      </tr>

      <?php } ?>

      

   	</tbody>

</table>

</div></div>

	<?php
endif;
}//food categories ends here.