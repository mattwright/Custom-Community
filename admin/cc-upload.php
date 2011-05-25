<?php

add_action('wp_ajax_cc_ajax_img_upload', 'cc_ajax_img_upload');

function cc_ajax_img_upload() {

global $wpdb; // this is how you get access to the database
/* echo "<pre>";
print_r($wpdb);
echo "</pre>"; */

if($_POST['type']){
	$save_type = $_POST['type'];
}else $save_type = null;

//Uploads
if($save_type == 'upload'){

	$clickedID = $_POST['data']; // Acts as the name
	$filename = $_FILES[$clickedID];
	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 

	$override['test_form'] = false;
	$override['action'] = 'wp_handle_upload';    
	$uploaded_file = wp_handle_upload($filename,$override);
 
	$upload_tracking[] = $clickedID;
	

if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
	else { echo $uploaded_file['url']; } // Is the Response
}
elseif($save_type == 'image_reset'){
	
		$id = $_POST['data']; // Acts as the name
		pagelines_update_option($id, null);
		

}

die();
}

        
//add_action('admin_footer', 'my_action_javascript');

function my_action_javascript() {
?>

<script type="text/javascript" >

    jQuery(document).ready(function(){
    	jQuery('.image_upload_button').each(function(){

    		var clickedObject = jQuery(this);
    		var clickedID = jQuery(this).attr('id');
    		var actionURL = jQuery(this).parent().find('.ajax_action_url').val();

    		new AjaxUpload(clickedID, {
    			  action: actionURL,
    			  name: clickedID, // File upload name
    			  data: { // Additional data to send
    					action: 'cc_ajax_img_upload',
    					type: 'upload',
    					data: clickedID },
    			  autoSubmit: true, // Submit file after selection
    			  responseType: false,
    			  onChange: function(file, extension){},
    			  onSubmit: function(file, extension){
    					clickedObject.text('Uploading'); // change button text, when user selects file	
    					this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
    					interval = window.setInterval(function(){
    						var text = clickedObject.text();
    						if (text.length < 13){	clickedObject.text(text + '.'); }
    						else { clickedObject.text('Uploading'); } 
    					}, 200);
    			  },
    			  onComplete: function(file, response) {

    				window.clearInterval(interval);
    				clickedObject.text('Upload Image');	
    				this.enable(); // enable upload button

    				// If there was an error
    				if(response.search('Upload Error') > -1){
    					var buildReturn = '<span class="upload-error">' + response + '</span>';
    					jQuery(".upload-error").remove();
    					clickedObject.parent().after(buildReturn);

    				}
    				else{

    					var previewSize = clickedObject.parent().find('.image_preview_size').attr('value');

    					var buildReturn = '<img style="width:'+previewSize+'px;" class="pagelines_image_preview" id="image_'+clickedID+'" src="'+response+'" alt="" />';

    					jQuery(".upload-error").remove();
    					jQuery("#image_" + clickedID).remove();	
    					clickedObject.parent().after(buildReturn);
    					jQuery('img#image_'+clickedID).fadeIn();
    					clickedObject.next('span').fadeIn();
    					clickedObject.parent().find('.uploaded_url').val(response);
    				}
    			  }
    			});

    		});

    		//AJAX Remove (clear option value)
    		jQuery('.image_reset_button').click(function(){

    			var clickedObject = jQuery(this);
    			var clickedID = jQuery(this).attr('id');
    			var theID = jQuery(this).attr('title');	
    			var actionURL = jQuery(this).parent().find('.ajax_action_url').val();
    			
    			var ajax_url = actionURL;

    			var data = {
    					action: 'cc_ajax_img_upload',
    					type: 'image_reset',
    					data: theID
    				};

    			jQuery.post(ajax_url, data, function(response) {
    				var image_to_remove = jQuery('#image_' + theID);
    				var button_to_hide = jQuery('#reset_' + theID);
    				image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
    				button_to_hide.fadeOut();
    				clickedObject.parent().find('.uploaded_url').val('');				
    			});

    			return false; 

    		});


    });      
   
    </script>
<?php } ?>