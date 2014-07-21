<?php
function product_categories() { 
	echo "<div class='wrap'><h2>" . __( 'Manage Product Categories', 'menu-test' ) . "<a class='add-new-h2' href='admin.php?page=add_category'>Add Product Category</a></h2>";
if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    } ?>
    
    <?php
	global $wpdb;
		if(isset($_GET['del_row']) && $_GET['del_row'] != '') { 
			$wpdb->get_results("DELETE from ".$wpdb->prefix."wc_shop_category WHERE cat_id='".$_GET['del_row']."'");
		?>
        <div class="updated"><p><strong><?php _e('Record Deleted Successfully!.', 'menu-test' ); ?></strong></p></div>	
	<?php
		}
	?>
    
    <div class="col-wrap" id="example">
<table cellspacing="0" class="wp-list-table widefat fixed tags">
	<thead>
	<tr>
        <th style="width:250px;" class="manage-column column-name sortable desc" id="name" scope="col"><a href="#">Category Name</a></th>
        
        <th style="" class="manage-column column-description sortable desc" id="description" scope="col">Category Description</th>
        </tr>
	</thead>

	<tfoot>
	<tr>
        <th style="" class="manage-column column-name sortable desc" id="name" scope="col"><a href="#">Category Name</a></th>
        
        <th style="" class="manage-column column-description sortable desc" id="description" scope="col">Category Description</th>
        </tr>

	</tfoot>

	<tbody data-wp-lists="list:tag" id="the-list">
		
        <?php
	global $wpdb;
	if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

		$cat_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_shop_category ORDER by cat_name ASC");
		
		foreach($cat_rows as $cat_row) {
	?>
        
     <tr class="alternate" id="tag-1">
        
        <td class="name column-name" style="width:250px;"><strong>
        <a title="Edit “Uncategorized”" href="admin.php?page=add_category&update_row=<?php echo $cat_row->cat_id; ?>" class="row-title"><?php echo $cat_row->cat_name; ?></a>
        </strong><br><div class="row-actions"><span class="edit">
        <a href="admin.php?page=add_category&update_row=<?php echo $cat_row->cat_id; ?>">Edit</a></span> | <span class="edit">
        <a href="admin.php?page=food_categories&del_row=<?php echo $cat_row->cat_id; ?>">Delete</a></span></td>
        
        <td class="description column-description"><?php echo $cat_row->cat_description; ?></td>
      </tr>
      <?php } ?>
      
   	</tbody>
</table>
</div></div>
	<?php
}//food categories ends here.