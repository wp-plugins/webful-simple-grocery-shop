<?php
function add_category() {
	echo '<h2>Add Product Category</h2>'; 
 //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	global $wpdb;
    // variables for the field and option names 
    $hidden_field_name = 'mt_submit_hidden';
	
    // See if the user has posted us some information
    if( isset($_POST[$hidden_field_name ]) && $_POST[$hidden_field_name ] == 'update') {
        // Read their posted value
		if($_POST['cat_name'] != '') { 
			//process code
			extract($_POST);
			$cat_description = stripslashes($cat_description);
			$wpdb->update( 
						$wpdb->prefix.'wc_shop_category', 
						array( 
							'cat_name' => $cat_name,
							'cat_description' => $cat_description,
							'cat_featured_img' => $featured_img
						),
						array('cat_id' => $_GET['update_row'])
					);
			?>
            <div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
			<?php 
		} else {
			 ?>
             <div class="updated"><p><strong><?php _e('Category and Item Name is required.', 'menu-test' ); ?></strong></p></div>
             <?php
		}
    }
   
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name ] == 'Y' ) {
        // Read their posted value
		if($_POST['cat_name'] != '') { 
			//process code
			extract($_POST);
			$cat_description = stripslashes($cat_description);
			
			$wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_shop_category WHERE cat_name='".$cat_name."'");
			$rows = $wpdb->num_rows;
			if($rows > 0) { 
			?>
            <div class="updated"><p><strong><?php _e('Category Already Exists with this name.', 'menu-test' ); ?></strong></p></div>	
			<?php } else {
			$wpdb->insert( 
						$wpdb->prefix.'wc_shop_category', 
						array( 
							'cat_id' => NULL,
							'cat_name' => $cat_name,
							'cat_description' => $cat_description,
							'cat_featured_img' => $featured_img
						)
					);
					unset($cat_name);
					unset($cat_description);
					unset($featured_img);
			?>
            <div class="updated"><p><strong><?php _e('Category added Successfuly!', 'menu-test' ); ?></strong></p></div>
			<?php }
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
<?php if(isset($_GET['update_row'])) { ?>
<input type="hidden" name="food_id_id" value="<?php echo $_GET['update_row']; ?>" />
<?php
	$cat_ne_id = $_GET['update_row'];
	} else { 
	$cat_ne_id = '0';
	}
	$food_row = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_shop_category WHERE cat_id='".$cat_ne_id."'");
	
	foreach($food_row as $food_r) {
		$cat_name = $food_r->cat_name;
		$cat_description = $food_r->cat_description;
		$featured_img = $food_r->cat_featured_img;
	}
?>
<table class="form-table">
<tr>
	<td><?php _e("Category Name:", 'menu-test' ); ?> </td>
	<td><input type="text" name="cat_name" value="<?php if(isset($cat_name)) {echo $cat_name;} ?>" /></td>
</tr>

<tr>
	<td><?php _e("Description:", 'menu-test' ); ?></td> 	
	<td>
    <?php
    $args = array("textarea_rows" => 5, "cat_description" => "cat_description", "editor_class" => "my_editor_custom", "media_buttons" => false);
 	if(isset($cat_description)) { 
		wp_editor($cat_description, "cat_description", $args);
	} else { 
		wp_editor('', "cat_description", $args);
	}
	?>
    </td>
</tr>

<tr>
	<td width="120"><?php _e("Featured Image:", 'menu-test' ); ?> </td>
	<td>
    <input id="upload_bottom_box_1_Img" type="text" size="36" name="featured_img" value="<?php if(isset($featured_img)){echo $featured_img;} ?>" />
    <input id="upload_bottom_box_1_Img_button" class="button" type="button" value="Upload Image" />
    <br />Enter a URL or upload an image
     </td>
</tr>

</table>
<br />
<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
</div>

<?php
}//add category function ends here.