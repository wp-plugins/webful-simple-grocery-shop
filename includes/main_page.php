<?php
function wc_my_shop() {
    echo "<h2>" . __( 'Webful My Shop Options', 'menu-test' ) . "</h2>";
	 //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	?>
    <div class="wrap">
    	<div style="float:left;margin-right:7px;width:600px;">
		<p>This plugin helps you to make your shop online and add products of your shop with categories, so that your customers can place orders online.</p>
        
        <p>During activation of this plugin it creates 2 pages Products and Checkout with required shortcodes you can change products page to anything but use shortcode. You also can change title of Checkout page but keep url /checkout/ as that is required by plugin. Use the shotcode below to show shopping page in widget or header of your site.</p>
        
        <h2>Shortcodes</h2>
        <p>Use following shortcode to list categories and products.</p>
    	<pre>
        //Shortcode
        [my_shop]
        
        //PHP function for template.
        &lt;?php my_shop(); ?&gt;
        </pre>
        <p>Use following shortcode for shopping bag.</p>
        <pre>
        //Shortocode
        [my_bag]
        
        //PHP function for template.
        &lt;? my_bag(); ?&gt;
        </pre>
        
        <p>Use following shortcode for checkout page.</p>
        <pre>
        //Shortocode
        [my_checkout]
        
        //PHP function for template.
        &lt;? my_checkout(); ?&gt;
        </pre>
       </div>
       
       <div style="float:right;margin-left:6px;max-width:450px;">
       		<h2>Our Products</h2>
                <a href="http://codecanyon.net/item/multi-store-php-point-of-sale/7511262?ref=webfulcreationsvision" target="_blank"><img src="http://www.make-mywebsite.com/wp-content/uploads/2014/05/6.jpg" alt="PHP Multi Store Point of Sale" align="left" hspace="5" vspace="5" /></a>
    
    <a href="http://codecanyon.net/item/php-general-ledger-accounting/6060549?ref=webfulcreationsvision" target="_blank"><img src="http://www.make-mywebsite.com/wp-content/uploads/2014/05/2.jpg" alt="PHP General Ledger" align="left" hspace="5" vspace="5" /></a>
    
    <a href="http://codecanyon.net/item/php-project-management-system/6971369?ref=webfulcreationsvision" target="_blank"><img src="http://www.make-mywebsite.com/wp-content/uploads/2014/05/5.jpg" alt="PHP Project Management System" align="left" hspace="5" vspace="5" /></a>
    
    <a href="http://codecanyon.net/item/php-login-user-management-with-message-center/5862673?ref=webfulcreationsvision" target="_blank"><img src="http://www.make-mywebsite.com/wp-content/uploads/2014/05/1.jpg" alt="PHP login and user management with message center" align="left" hspace="5" vspace="5" /></a>
    
    <a href="http://codecanyon.net/item/webful-wordpress-reputation-management/6346911?ref=webfulcreationsvision" target="_blank"><img src="http://www.make-mywebsite.com/wp-content/uploads/2014/05/4.jpg" alt="Wordpress Reputation Management System" align="left" hspace="5" vspace="5" /></a>
    
    <a href="http://codecanyon.net/item/webful-wordpress-restaurant-menu/6276466?ref=webfulcreationsvision" target="_blank"><img src="http://www.make-mywebsite.com/wp-content/uploads/2014/05/3.jpg" alt="Wordpress Restaurant Menu Plugin" align="left" hspace="5" vspace="5" /></a>
<div style="clear:both;"></div>
		<h2>Keep development alive!</h2>
        <p>Donate 5$ and keep development alive. Without your support we cannot keep this product update.</p>
        <div align="center">
        	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_donations">
                <input type="hidden" name="business" value="starsinthelake@gmail.com">
                <input type="hidden" name="lc" value="US">
                <input type="hidden" name="item_name" value="Wordpress Simple Shop">
                <input type="hidden" name="no_note" value="0">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
        </div>
        <h2>Get advanced checkout form!</h2>
        <p>Get credit card authorization form with new order. Credit card info would be emailed to site owner and other order details would be saved in orders section in wordpress site. So that you can charge your clients for their orders. <a href="http://phploginsystem.net/wp-content/uploads/2014/07/advancedform.jpg" target="_blank">Checkout Form can be seen here.</a>. We will send you another version of plugin which will handle this thing for you.</p>
       </div>
       <div align="center" style="position:relative;">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="starsinthelake@gmail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Wordpress Grocery Shop - Pro1">
<input type="hidden" name="amount" value="7.00">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<div style="text-align:center;">
<input type="hidden" name="on0" value="Email to send you plugin"><br />
<input type="text" name="os0" maxlength="200" placeholder="Email to send you plugin">
</div>
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

        </div>
       <div style="clear:both;"></div> 
    </div>
<?php }