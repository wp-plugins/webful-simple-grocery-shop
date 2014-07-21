jQuery(function() {  
	var pull  = jQuery('#res_btn');  
		menu  = jQuery('.shop_cat_wrap ul');  
		menuHeight = menu.height();  
  
	jQuery(pull).on('click', function(e) {  
		e.preventDefault();  
		menu.slideToggle();  
	});  
}); 

jQuery(window).resize(function(){  
	var w = jQuery(window).width();  
	if(w > 320 && menu.is(':hidden')) {  
		menu.removeAttr('style');  
	}  
});