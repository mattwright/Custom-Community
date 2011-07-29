<?php 
function cc_wp_title(){
global $blog_id;
	if(defined('BP_VERSION')){
		if(defined('SITE_ID_CURRENT_SITE')){
			if($blog_id == SITE_ID_CURRENT_SITE){
				bp_page_title(''); 
			}else{ 
				wp_title(''); 
			}
		}else{
			bp_page_title(''); 
		} 
	} else { 
		wp_title(''); 
	} 
}
function switch_css(){
	global $cap;
		
	$switch_css =  array(
	'body_bg_color' => 'ffffff',
	'container_bg_color' => 'ffffff',
	'container_alt_bg_color' => 'ededed',
	'details_bg_color' => 'ededed', 
	'details_hover_bg_color' => 'f9f9f9',
	'font_color' => '888888',
	'font_alt_color' => 'afafaf',
	'link_color' => '489ed5',
	);

	if ($cap->style_css != false):;
	switch ($cap->style_css)
        {
        case 'dark':
			$switch_css =  array(
			'body_bg_color' => '333333',
			'container_bg_color' => '181818',
			'container_alt_bg_color' => '333333',
			'details_bg_color' => '181818', 
			'details_hover_bg_color' => '252525',
			'font_color' => '888888',
			'font_alt_color' => '555555',
			'link_color' => 'ffffff',
			);
        break;
        case 'natural':
			$switch_css =  array(
			'body_bg_color' => 'F5E5B3',
			'container_bg_color' => 'FFF9DB',
			'container_alt_bg_color' => 'F5E5B3',
			'details_bg_color' => 'FFF9DB', 
			'details_hover_bg_color' => 'FFE5B3',
			'font_color' => '888888',
			'font_alt_color' => 'aaaaaa',
			'link_color' => 'ff7400',
			);
        	
        break;
        case 'white':
			$switch_css =  array(
			'body_bg_color' => 'ffffff',
			'container_bg_color' => 'ffffff',
			'container_alt_bg_color' => 'ededed',
			'details_bg_color' => 'ededed', 
			'details_hover_bg_color' => 'f9f9f9',
			'font_color' => '888888',
			'font_alt_color' => 'afafaf',
			'link_color' => '489ed5',
			);
        break;
        case 'light':
			$switch_css =  array(
			'body_bg_color' => 'ededed',
			'container_bg_color' => 'ffffff',
			'container_alt_bg_color' => 'ededed',
			'details_bg_color' => 'ffffff', 
			'details_hover_bg_color' => 'f9f9f9',
			'font_color' => '888888',
			'font_alt_color' => 'afafaf',
			'link_color' => '529e81',
			);
        break;
        case 'grey':
			$switch_css =  array(
			'body_bg_color' => 'f1f1f1',
			'container_bg_color' => 'dddddd',
			'container_alt_bg_color' => 'f1f1f1',
			'details_bg_color' => 'dddddd', 
			'details_hover_bg_color' => 'ededed', 
			'font_color' => '555555',
			'font_alt_color' => 'aaaaaa',
			'link_color' => '1f8787',
			);
        break;
        case 'black':
			$switch_css =  array(
			'body_bg_color' => '000000',
			'container_bg_color' => '000000',
			'container_alt_bg_color' => '333333',
			'details_bg_color' => '333333', 
			'details_hover_bg_color' => '181818',
			'font_color' => '888888',
			'font_alt_color' => '555555',
			'link_color' => 'ffffff',
			);
        break;
      }
      endif;
      return $switch_css;
}



function color_scheme(){
echo get_color_scheme();
}
	function get_color_scheme(){
		global $cap;
		if(isset( $_GET['show_style']))
			$cap->style_css =$_GET['show_style']; 
			
		switch ($cap->style_css)
	        {
	        case 'dark':
			$color = 'dark';
	        break;
	        case 'natural':
			$color = 'natural';
	        break;
	        case 'white':
			$color = 'white';
	        break;
	        case 'light':
			$color = 'light';
	        break;
	        case 'grey':
			$color = 'grey';
	        break;
	        case 'black':
			$color = 'black';
	        break;
	        default:
			$color = 'grey';
	        break;
	        }
	        return $color; 
	}

function slidertop(){
	global $cc_page_options, $cap;

	$slideshow_time = '5000';

	if($cap->slideshow_caption == 'off'){
		$caption = 'off';
	}	else {
		$caption = 'on';
	}
	if($cc_page_options['cc_page_slider_caption'] == 1){
		$caption = 'off';
	}
	
	if($cap->slideshow_amount != ''){
		$slideshow_amount = $cap->slideshow_amount;
	}	else {
		$slideshow_amount = '4';
	}
	if($cc_page_options['cc_page_slider_on'] == 1 && $cc_page_options['cc_page_slider_amount'] != ''){
		$slideshow_amount = $cc_page_options['cc_page_slider_amount'];
	}
	
	if($cap->slideshow_time != ''){
		$slideshow_time = $cap->slideshow_time;
	}	
	
	if($cap->slideshow_orderby != ''){
		$slideshow_orderby = $cap->slideshow_orderby;
	}	else {
		$slideshow_orderby = 'DESC';
	}
	if($cc_page_options['cc_page_slider_on'] == 1 && $cc_page_options['cc_page_slider_orderby'] != ''){
		$slideshow_orderby = $cc_page_options['cc_page_slider_orderby'];
	}			
	
	if($cap->slideshow_post_type != ''){
		$slideshow_post_type = $cap->slideshow_post_type;
	}	else {
		$slideshow_post_type = 'post';
	}
	if($cc_page_options['cc_page_slider_on'] == 1 && $cc_page_options['cc_page_slider_post_type'] != ''){
		$slideshow_post_type = $cc_page_options['cc_page_slider_post_type'];
	}
	
	if($cap->slideshow_show_page != ''){
		$slideshow_show_page = $cap->slideshow_show_page;
	}	else {
		$slideshow_show_page = '';
	}
	
	if($cc_page_options['cc_page_slider_on'] == 1){
		$slideshow_show_page = $cc_page_options['cc_page_slider_show_page'];
	}

	
	if($cap->slideshow_cat == 'All categories'){
		$slidercat =  '';
	}
	if($cap->slideshow_cat != '' && $cap->slideshow_cat != 'All categories'){
		$slidercat = $cap->slideshow_cat;
	}
	
	if($cc_page_options['cc_page_slider_on'] == 1 && $cc_page_options['cc_page_slider_cat'] != ''){
		$slidercat = $cc_page_options['cc_page_slider_cat'];
	}

	if($cap->slideshow_style == 'full width'){
	$slider_style = 'full width';
	}
	if($cc_page_options['cc_page_slider_on'] == 1 && $cc_page_options['cc_page_slider_style'] != ''){
	$slider_style = $cc_page_options['cc_page_slider_style'];						
	}

	if($slider_style == 'full width' || $slider_style == 'full-width-image' ){ ?>
		<style type="text/css">
			div#cc_slider-top div.cc_slider .featured .ui-tabs-panel{
			width: 100%;
			}
		</style>
	<?php }
	
	if($slider_style == 'full width' || $slider_style == 'full-width-image' ){
		$atts = array(
			'amount' => $slideshow_amount,
			'category_name' => $slidercat,
			'slider_nav' => 'off',
			'caption' => $caption,
			'caption_width' => '1006',
			'width' => '1006',
			'height' => '250',
			'id' => 'slidertop',
			'time_in_ms' => $slideshow_time,
			'orderby' => $slideshow_orderby,
			'page_id' => $slideshow_show_page,
			'post_type' =>$slideshow_post_type
		);
	} else {
		$atts = array(
			'amount' => '4',
			'category_name' => $slidercat,
			'slider_nav' => 'on',
			'caption' => $caption,
			'id' => 'slidertop',
			'time_in_ms' => $slideshow_time,
			'orderby' => $slideshow_orderby,
			'page_id' => $slideshow_show_page,
			'post_type' =>$slideshow_post_type
 			);					
	}

	$tmp .= '<div id="cc_slider-top">';
	$tmp .= slider($atts,$content = null);
	$tmp .= '</div>';
	if($cap->slideshow_shadow != "no shadow"){
		$tmp .= '<div class="slidershadow" style="margin-top:-12px; margin-bottom:-30px;"><img src="'.get_template_directory_uri().'/images/slideshow/'.cc_slider_shadow().'"></img></div>';
	}
		
	return $tmp;

}

function style_switcher(){?>
<p>
		Colour scheme: 
		<a href="?show_style=dark">dark</a> |
		<a href="?show_style=natural">natural</a> |
		<a href="?show_style=white">white</a> |
		<a href="?show_style=light">light</a> |
		<a href="?show_style=grey">grey</a> |
		<a href="?show_style=black">black</a>
</p>
<?php
}

function cc_list_posts_on_page(){
$cc_page_options=cc_get_page_meta(); 
    if(isset($cc_page_options) && $cc_page_options['cc_page_template_on'] == 1){
    
    switch ($cc_page_options['cc_posts_on_page_type'])
        {
        case 'img-mouse-over':
    	$atts = array(
			'amount' => $cc_page_options['cc_page_template_amount'],
			'category_name' => $cc_page_options['cc_page_template_cat'],
			'img_position' => 'mouse_over',
			);
        echo cc_list_posts($atts,$content = null); 
        break;
        case 'img-left-content-right':
		$atts = array(
			'amount' => $cc_page_options['cc_page_template_amount'],
			'category_name' => $cc_page_options['cc_page_template_cat'],
			'img_position' => 'left',
			);
        echo cc_list_posts($atts,$content = null); 
        break;
        case 'img-right-content-left':
		$atts = array(
			'amount' => $cc_page_options['cc_page_template_amount'],
			'category_name' => $cc_page_options['cc_page_template_cat'],
			'img_position' => 'right',
			);
        echo cc_list_posts($atts,$content = null); 
        break;
        case 'img-over-content':
		$atts = array(
			'amount' => $cc_page_options['cc_page_template_amount'],
			'category_name' => $cc_page_options['cc_page_template_cat'],
			'img_position' => 'over',
			);
        echo cc_list_posts($atts,$content = null); 
        break;
        case 'img-under-content':
		$atts = array(
			'amount' => $cc_page_options['cc_page_template_amount'],
			'category_name' => $cc_page_options['cc_page_template_cat'],
			'img_position' => 'under',
			);
        echo cc_list_posts($atts,$content = null); 
        break;
        }
	}
}


function cc_groups_header() {
global $cap; ?>
    
    <?php do_action( 'bp_before_group_header' ) ?>

    <div id="item-actions">
	<?php if ( bp_group_is_visible() ) : ?>

		<h3><?php _e( 'Group Admins', 'buddypress' ) ?></h3>
		<?php bp_group_list_admins() ?>

		<?php do_action( 'bp_after_group_menu_admins' ) ?>

		<?php if ( bp_group_has_moderators() ) : ?>
			<?php do_action( 'bp_before_group_menu_mods' ) ?>

			<h3><?php _e( 'Group Mods' , 'buddypress' ) ?></h3>
			<?php bp_group_list_mods() ?>

			<?php do_action( 'bp_after_group_menu_mods' ) ?>
		<?php endif; ?>

	<?php endif; ?>
</div><!-- #item-actions -->

	<div id="item-header-avatar">
		<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>">
			<?php $asize = '150';
			if($cap->bp_groups_avatar_size !=  '') 
				$asize = $cap->bp_groups_avatar_size;
	
			bp_group_avatar('type=full&width='.$asize.'&height='.$asize); ?>
		</a>
	</div><!-- #item-header-avatar -->

<div id="item-header-content">
	<h2><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></h2>
	<span class="highlight"><?php bp_group_type() ?></span> <span class="activity"><?php printf( __( 'active %s ago', 'buddypress' ), bp_get_group_last_active() ) ?></span>

	<?php do_action( 'bp_before_group_header_meta' ) ?>

	<div id="item-meta">
		<?php bp_group_description() ?>

		<?php bp_group_join_button() ?>

		<?php do_action( 'bp_group_header_meta' ) ?>
	</div>
</div><!-- #item-header-content -->

<?php do_action( 'bp_after_group_header' ) ?>

<?php do_action( 'template_notices' ) ?>

<?php }

function cc_groups_sidebar() {
global $cap;
    do_action( 'bp_before_group_header' ) ?>
	<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

		<div id="item-header-avatar">
			<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>">
				<?php $asize = '150';
				if($cap->bp_groups_avatar_size !=  '') 
					$asize = $cap->bp_groups_avatar_size;

				bp_group_avatar('type=full&width='.$asize.'&height='.$asize); ?>
			</a>
		</div><!-- #item-header-avatar -->

		<h3 style="" class="widgettitle"><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></h3>
		
		<span class="highlight"><?php bp_group_type() ?></span> <span class="activity"><?php printf( __( 'active %s ago', 'buddypress' ), bp_get_group_last_active() ) ?></span>
		<?php do_action( 'bp_before_group_header_meta' ) ?>
	
		
		<div id="item-meta">
			<?php bp_group_join_button() ?>
		</div>
		<div class="widget">
		</div>
		<div class="clear"></div>
		<div id="item-meta">
		 <h3 class="widgettitle">Description</h3>
			<?php bp_group_description() ?>
		</div>
		<?php do_action( 'bp_group_header_meta' ) ?>

		<div style="height:105px" id="item-list">
		<?php if ( bp_group_is_visible() ) : ?>
			<h3 class="widgettitle">Group Admins</h3>
			<?php bp_group_list_admins() ?>
			<?php do_action( 'bp_after_group_menu_admins' ) ?>
		</div>
		<div id="item-list">

			<?php if ( bp_group_has_moderators() ) : ?>
				<?php do_action( 'bp_before_group_menu_mods' ) ?>
				<h3 style="" class="widgettitle">Group Moderators</h3>
				<?php bp_group_list_mods() ?>
				<?php do_action( 'bp_after_group_menu_mods' ) ?>
			<?php endif; ?>
		<?php endif; ?>
		</div><!-- #item-actions -->
	<?php endwhile; endif; ?>
	<?php do_action( 'bp_after_group_header' ) ?>
	<?php do_action( 'template_notices' ) ?>

<?php } 

function cc_profiles_header(){ 
global $cap; ?>


<div id="item-header-avatar">
	<a href="<?php bp_user_link() ?>">
		<?php $asize = '150';
			if($cap->bp_profiles_avatar_size !=  '') 
				$asize = $cap->bp_profiles_avatar_size;?>
		
		<?php bp_displayed_user_avatar( 'type=full&width='.$asize.'&height='.$asize ) ?>
	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<h2 class="fn"><a href="<?php bp_user_link() ?>"><?php bp_displayed_user_fullname() ?></a> <span class="highlight">@<?php bp_displayed_user_username() ?> <span>?</span></span></h2>
	<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ) ?></span>

	<?php do_action( 'bp_before_member_header_meta' ) ?>

	<div id="item-meta">
		<?php if ( function_exists( 'bp_activity_latest_update' ) ) : ?>
			<div id="latest-update">
				<?php bp_activity_latest_update( bp_displayed_user_id() ) ?>
			</div>
		<?php endif; ?>

		<div id="item-buttons">
			<?php if ( function_exists( 'bp_add_friend_button' ) ) : ?>
				<?php bp_add_friend_button() ?>
			<?php endif; ?>

			<?php if ( is_user_logged_in() && !bp_is_my_profile() && function_exists( 'bp_send_public_message_link' ) ) : ?>
				<div class="generic-button" id="post-mention">
					<a href="<?php bp_send_public_message_link() ?>" title="<?php _e( 'Mention this user in a new public message, this will send the user a notification to get their attention.', 'buddypress' ) ?>"><?php _e( 'Mention this User', 'buddypress' ) ?></a>
				</div>
			<?php endif; ?>

			<?php if ( is_user_logged_in() && !bp_is_my_profile() && function_exists( 'bp_send_private_message_link' ) ) : ?>
				<div class="generic-button" id="send-private-message">
					<a href="<?php bp_send_private_message_link() ?>" title="<?php _e( 'Send a private message to this user.', 'buddypress' ) ?>"><?php _e( 'Send Private Message', 'buddypress' ) ?></a>
				</div>
			<?php endif; ?>
		</div><!-- #item-buttons -->

		<?php
		 /***
		  * If you'd like to show specific profile fields here use:
		  * bp_profile_field_data( 'field=About Me' ); -- Pass the name of the field
		  */
		?>

		<?php do_action( 'bp_profile_header_meta' ) ?>

	</div><!-- #item-meta -->

</div><!-- #item-header-content -->

<?php do_action( 'bp_after_member_header' ) ?>

<?php do_action( 'template_notices' ) ?>

<?php }

function cc_profiles_sidebar(){ 
global $cap ?>
		<?php do_action( 'bp_before_member_header' ) ?>
<div id="item-header-avatar">
		<a href="<?php bp_user_link() ?>">
		<?php $asize = '150';
			if($cap->bp_profiles_avatar_size !=  '') 
				$asize = $cap->bp_profiles_avatar_size;?>
		
		<?php bp_displayed_user_avatar( 'type=full&width='.$asize.'&height='.$asize ) ?>
	</a>
</div><!-- #item-header-avatar -->

	
	<h3 style="" class="widgettitle"><a href="<?php bp_user_link() ?>"><?php bp_displayed_user_fullname() ?></a> </h3>
	<span class="highlight">@<?php bp_displayed_user_username() ?> <span>?</span></span>
	<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ) ?></span>

	<?php do_action( 'bp_before_member_header_meta' ) ?>

	<div id="item-meta">
		<?php if ( function_exists( 'bp_activity_latest_update' ) ) : ?>
			<div id="latest-update">
				<?php bp_activity_latest_update( bp_displayed_user_id() ) ?>
			</div>
		<?php endif; ?>
	</div>
<div class="widget">
		</div>
	<div id="item-meta">
		<div id="item-buttons">
			<?php if ( function_exists( 'bp_add_friend_button' ) ) : ?>
				<?php bp_add_friend_button() ?>
			<?php endif; ?>

			<?php if ( is_user_logged_in() && !bp_is_my_profile() && function_exists( 'bp_send_public_message_link' ) ) : ?>
				<div class="generic-button" id="post-mention">
					<a href="<?php bp_send_public_message_link() ?>" title="<?php _e( 'Mention this user in a new public message, this will send the user a notification to get their attention.', 'buddypress' ) ?>"><?php _e( 'Mention this User', 'buddypress' ) ?></a>
				</div>
			<?php endif; ?>

			<?php if ( is_user_logged_in() && !bp_is_my_profile() && function_exists( 'bp_send_private_message_link' ) ) : ?>
				<div class="generic-button" id="send-private-message">
					<a href="<?php bp_send_private_message_link() ?>" title="<?php _e( 'Send a private message to this user.', 'buddypress' ) ?>"><?php _e( 'Send Private Message', 'buddypress' ) ?></a>
				</div>
			<?php endif; ?>
		</div><!-- #item-buttons -->

		<?php
		 /***
		  * If you'd like to show specific profile fields here use:
		  * bp_profile_field_data( 'field=About Me' ); -- Pass the name of the field
		  */
		?>

		<?php do_action( 'bp_profile_header_meta' ) ?>

	</div><!-- #item-meta -->


<?php do_action( 'bp_after_member_header' ) ?>

<?php do_action( 'template_notices' ) ?>

<?php } ?>