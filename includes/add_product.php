<?php
//function page
function add_product_page() {
    echo "<h2>" . __( 'Add Items', 'menu-test' ) . "</h2>";
	
	 //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	global $wpdb;
	
    // variables for the field and option names 
    $hidden_field_name = 'mt_submit_hidden';
	
    // See if the user has posted us some information
    if( isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'update' ) {
        // Read their posted value
		if($_POST['product_category'] != '' && $_POST['product_name'] != '') { 
			//process code
			extract($_POST);
			$product_description = stripslashes($product_description);
			$wpdb->update( 
						$wpdb->prefix.'wc_product_menu', 
						array( 
							'product_category' => $product_category,
							'product_name' => $product_name,
							'product_description' => $product_description,
							'product_thumb' => $product_thumb_img,
							'product_price' => $product_price
						), 
						array('product_id' => $_GET['update_row'])
					);
			?>
            <div class="updated"><p><strong><?php _e('item added successfuly!.', 'menu-test' ); ?></strong></p></div>
			<?php 
		} else {
			 ?>
             <div class="updated"><p><strong><?php _e('Category and Item Name is required.', 'menu-test' ); ?></strong></p></div>
             <?php
		}
    }
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y' ) {
		// Read their posted value
		if($_POST['product_category'] != '' && $_POST['product_name'] != '') { 
			//process code
			extract($_POST);
			$product_description = stripslashes($product_description);
			$wpdb->insert( 
						$wpdb->prefix.'wc_product_menu', 
						array( 
							'product_id' => NULL, 
							'product_category' => $product_category,
							'product_name' => $product_name,
							'product_description' => $product_description,
							'product_thumb' => $product_thumb_img,
							'product_price' => $product_price
						)
					);
					unset($product_name);
					unset($product_description);
					unset($product_thumb_img);
					unset($product_price);
			?>
            <div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
			<?php 
		} else {
			 ?>
             <div class="updated"><p><strong><?php _e('Category and Item Name is required.', 'menu-test' ); ?></strong></p></div>
             <?php
		}
    }
    echo '<div class="wrap">';
    // settings form
    ?>

<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="<?php if(isset($_GET['update_row'])){echo 'update'; } else { echo 'Y'; }?>">
<input type="hidden" name="id_id" value="<?php if(isset($_GET['update_row'])){echo $_GET['update_row'];} ?>" />
<?php
	if(isset($_GET['update_row'])) {
	$row = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_product_menu WHERE product_id='".$_GET['update_row']."'");
	
	foreach($row as $r) {
		$product_category = $r->product_category;
		$product_name = $r->product_name;
		$product_description = $r->product_description;
		$product_thumb = $r->product_thumb;
		$product_price = $r->product_price;
	}
	}
?>
<table class="form-table">
<tr>
	<td width="120"><?php _e("Select Category:", 'menu-test' ); ?> </td>
	<td>
    	<select name="product_category">
        	<option>Select Category</option>
            
            <?php
				$cat_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_shop_category ORDER by cat_name ASC");
				$options = '';
				foreach($cat_rows as $cat_row) {
					if($product_category == $cat_row->cat_id) {
						$options .= '<option selected="selected" value="'.$cat_row->cat_id.'">'.$cat_row->cat_name.'</option>';	
						} else {
					$options .= '<option value="'.$cat_row->cat_id.'">'.$cat_row->cat_name.'</option>';
					}
				}//foreach ends here.
			?>
            <?php echo $options; ?>
        </select>
    </td>
</tr>
<tr>
	<td><?php _e("Name:", 'menu-test' ); ?> </td>
	<td><input type="text" name="product_name" value="<?php if(isset($product_name)){echo $product_name;} ?>" /></td>
</tr>

<tr>
	<td><?php _e("Description:", 'menu-test' ); ?></td> 	
	<td>
    <?php
    $args = array("textarea_rows" => 5, "product_description" => "product_description", "editor_class" => "my_editor_custom", "media_buttons" => false);
 	if(isset($product_description)) {
	wp_editor($product_description, "product_description", $args);
    } else { 
    wp_editor('', "product_description", $args); 
    } ?>
    </td>
</tr>
<tr>
	<td width="120"><?php _e("Thumb Image:", 'menu-test' ); ?> </td>
	<td>
    <input id="upload_bottom_box_1_Img" type="text" size="36" name="product_thumb_img" value="<?php if(isset($product_thumb)){echo $product_thumb;} ?>" />
    <input id="upload_bottom_box_1_Img_button" class="button" type="button" value="Upload Image" />
    <br />Enter a URL or upload an image
     </td>
</tr>
<tr>
	<td><?php _e("Price:", 'menu-test' ); ?> </td>
	<td><input type="text" name="product_price" value="<?php if(isset($product_price)){echo $product_price;} ?>" /></td>
</tr>
</table>
<br />
<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>
</form>
</div>
<?php
}