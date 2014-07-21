jQuery(document).ready(function($){
    var bottom_box_1_uploader;
	
    $('#upload_bottom_box_1_Img_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (bottom_box_1_uploader) {
            bottom_box_1_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        bottom_box_1_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        bottom_box_1_uploader.on('select', function() {
            attachment = bottom_box_1_uploader.state().get('selection').first().toJSON();
            $('#upload_bottom_box_1_Img').val(attachment.url);
        });
 
        //Open the uploader dialog
        bottom_box_1_uploader.open();
 
    });
	// bottom_box_1_uploader starts here.
});
jQuery(document).ready(function() {
		oTable = jQuery('#example').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
	} );