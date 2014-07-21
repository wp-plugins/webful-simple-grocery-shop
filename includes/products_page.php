<?php
function product_page() {
	echo "<div class='wrap'><h2>" . __( 'Manage Items', 'menu-test' ) . "<a class='add-new-h2' href='admin.php?page=add_product'>Add New</a></h2>";
?>
 <div class="col-wrap">
<table cellpadding="0" cellspacing="0" border="0" class="wp-list-table widefat fixed tags" id="example">
	<thead>
		<tr>
		<th>Category</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
		</tr>
	</thead>
	<tbody>
	<?php
	global $wpdb;
	if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	//delete row 
	if(isset($_GET['delete_row']) && $_GET['delete_row'] != '') {
		$wpdb->delete($wpdb->prefix.'wc_product_menu', array( 'product_id' => $_GET['delete_row']));
?>
        <div class="updated"><p><strong><?php _e('Record Deleted Successfully!.', 'menu-test' ); ?></strong></p></div>
        <?php		 
	}

		$product_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_product_menu ORDER by product_category ASC");
		
		foreach($product_rows as $product_row) {
	?>
    
    	<tr valign="top" class="post-50 type-post status-publish format-standard hentry category-uncategorized alternate iedit author-self" id="post-50">
		<?php $cat_rows = $wpdb->get_results("SELECT * from ".$wpdb->prefix."wc_shop_category WHERE cat_id='".$product_row->product_category."'"); 
			foreach($cat_rows as $cat_row) { 
				$cat_name = $cat_row->cat_name;
			}
		?>
        		<td class="column-title">
                <strong><a href="admin.php?page=add_product&update_row=<?php echo $product_row->product_id; ?>">
				<?php echo $cat_name; ?></a></strong>
				<div class="row-actions"><span class="edit"><a href="admin.php?page=add_product&update_row=<?php echo $product_row->product_id; ?>">Edit</a> | </span><span class="inline hide-if-no-js"><a href="admin.php?page=sub-page2&delete_row=<?php echo $product_row->product_id; ?>">Delete</a></div></td>			
    
    <td class="author column-author"><?php echo $product_row->product_name; ?></td>
    <td class="author column-author"><?php echo $product_row->product_description; ?></td>
    <td class="author column-author"><?php echo $product_row->product_price; ?></td>
    </tr>
    <?php } ?>
	</tbody>
</table>
        </div>
<?php
	echo '</div><!--wrap_colosing-->';
}