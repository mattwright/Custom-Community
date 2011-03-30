<?php 
	function cc_post_metabox(){ 	
		global $post;
		
	   	$cc_post_options=get_cc_post_options();

		if($cc_post_options['cc_post_template_on'] == 1){
			$checked_post_template = "checked";
		} else {
			$checked_post_template = "";
		}
		if($cc_post_options['cc_post_template_avatar'] == 1){
			$checked_post_template_avatar = "checked";
		} else {
			$checked_post_template_avatar = "";
		}
		if($cc_post_options['cc_post_template_date'] == 1){
			$checked_post_template_date = "checked";
		} else {
			$checked_post_template_date = "";
		}
		if($cc_post_options['cc_post_template_tags'] == 1){
			$checked_post_template_tags = "checked";
		} else {
			$checked_post_template_tags = "";
		}
		if($cc_post_options['cc_post_template_comments_info'] == 1){
			$checked_post_template_comments_info = "checked";
		} else {
			$checked_post_template_comments_info = "";
		}

		$option_post_templates[0] = "img-left-content-right";
		$option_post_templates[1] = "more options in the pro version";
		
		?>
		
	<style type="text/css">
	#cc_page_template_amount{
		width:40px;
	}
	</style>
	<div id="cc_page_metabox" class="postbox">
		<div class="handlediv" title="<?php _e('klick','buddypress'); ?>">
			<br />
		</div>
		<h3 class="hndle"><?php _e('Custom Community settings')?></h3>
		<div class="inside">
			<b>Use a post template for this post</b>
			<p>You can select a predefined post template:<br />
				<label for="cc_post_template"><?php _e('Post template on')?>:</label>
				<input name="cc_post_template_on" id="cc_post_template_on" type="checkbox" <?php echo $checked_post_template ?> value="1" />
				Select a template to use:<select id="cc_post_template_type" name="cc_post_template_type">
						<?php foreach($option_post_templates as $option_template){?>
							<option <?php if($cc_post_options['cc_post_template_type'] == $option_template){?>selected="selected"<?php }?>><?php echo $option_template; ?></option>
						<?php }?>
				</select>
			</p>
		<b>Schow/hide meta info</b>
		<p>
		<label for="cc_post_templater"><?php _e('Hide avatar')?>:</label>
		<input name="cc_post_template_avatar" id="cc_post_template_avatar" type="checkbox" <?php echo $checked_post_template_avatar ?> value="1" />
		<label for="cc_post_templater"><?php _e('Hide date/category')?>:</label>
		<input name="cc_post_template_date" id="cc_post_template_date" type="checkbox" <?php echo $checked_post_template_date ?> value="1" />
		<label for="cc_post_templater"><?php _e('Hide tags')?>:</label>

		<input name="cc_post_template_tags" id="cc_post_template_tags" type="checkbox" <?php echo $checked_post_template_tags ?> value="1" />
		<label for="cc_post_templater"><?php _e('Hide comment-info')?>:</label>
		<input name="cc_post_template_comments_info" id="cc_post_template_comments_info" type="checkbox" <?php echo $checked_post_template_comments_info ?> value="1" />
		</p>

		</div>	
	</div>
<?php
 }
 
function cc_post_meta_add($id){
	if (isset($_POST['cc_post_template_on']) == "1") {
	 	update_post_meta($id,"_cc_post_template_on",1);
	}else{
	 	update_post_meta($id,"_cc_post_template_on",0);
	}

	if (isset($_POST['cc_post_template_type']) === true) {
	    update_post_meta($id,"_cc_post_template_type",$_POST["cc_post_template_type"]);
	}
	
	if (isset($_POST['cc_post_template_avatar']) == "1") {
	 	update_post_meta($id,"_cc_post_template_avatar",1);
	}else{
	 	update_post_meta($id,"_cc_post_template_avatar",0);
	}
	if (isset($_POST['cc_post_template_date']) == "1") {
	 	update_post_meta($id,"_cc_post_template_date",1);
	}else{
	 	update_post_meta($id,"_cc_post_template_date",0);
	}
	if (isset($_POST['cc_post_template_tags']) == "1") {
	 	update_post_meta($id,"_cc_post_template_tags",1);
	}else{
	 	update_post_meta($id,"_cc_post_template_tags",0);
	}
	if (isset($_POST['cc_post_template_comments_info']) == "1") {
	 	update_post_meta($id,"_cc_post_template_comments_info",1);
	}else{
	 	update_post_meta($id,"_cc_post_template_comments_info",0);
	}
}
 
  function get_cc_post_options(){
  	global $post;
	$cc_page['cc_post_template_on']=get_post_meta($post->ID,"_cc_post_template_on", true);
	$cc_page['cc_post_template_type']=get_post_meta($post->ID,"_cc_post_template_type", true);
	$cc_page['cc_post_template_avatar']=get_post_meta($post->ID,"_cc_post_template_avatar", true);
	$cc_page['cc_post_template_date']=get_post_meta($post->ID,"_cc_post_template_date", true);
	$cc_page['cc_post_template_tags']=get_post_meta($post->ID,"_cc_post_template_tags", true);
	$cc_page['cc_post_template_comments_info']=get_post_meta($post->ID,"_cc_post_template_comments_info", true);
	return $cc_page;
  } 
	add_action('edit_form_advanced', 'cc_post_metabox');
	add_action('save_post','cc_post_meta_add');
?>