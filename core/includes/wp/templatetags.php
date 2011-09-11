<?php 
/**
 * Check if WP or BP and if BP check if WO or MU and grive back the corect title ;-)
 *
 * @package Custom Community
 * @since 1.8.3
 */	
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

/**
 * Load the Array for the Top Slider depance on the Page or Theme Settings
 *
 * @package Custom Community
 * @since 1.8.3
 */	
function cc_slidertop(){
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
		$slidercat = '0';
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

/**
 * Load the Array for the List Posts depance on the Page or Theme Settings
 *
 * @package Custom Community
 * @since 1.8.3
 */	
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
?>