<?php 
function switch_css(){
	global $cap;
	if(isset( $_GET['show_style']))
		$cap->style_css =$_GET['show_style']; 
		
	switch ($cap->style_css)
        {
        case 'dark':
		?><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_inc/css/style-dark.css" type="text/css" media="screen" /><?php	
        break;
        case 'natural':
		?><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_inc/css/style-natural.css" type="text/css" media="screen" /><?php	
        break;
        case 'white':
		?><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_inc/css/style-white.css" type="text/css" media="screen" /><?php	
        break;
        case 'light':
		?><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_inc/css/style-light.css" type="text/css" media="screen" /><?php	
        break;
        case 'grey':
		?><link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" /><?php	
        break;
        case 'black':
		?><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_inc/css/style-black.css" type="text/css" media="screen" /><?php	
        break;
        }
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
				
	
				if($cap->slideshow_caption == 'off'){
					$caption = 'off';
				}	else {
					$caption = 'on';
				}
				if($cc_page_options['cc_page_slider_caption'] == 1){
					$caption = 'off';
				}
				
				if($cap->slideshow_cat != ''){
					$slidercat =  $cap->slideshow_cat;
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
				
				if($slider_style == 'full width' || $slider_style == 'full-width-image' ){
					$atts = array(
						'category_name' => $slidercat,
						'slider_nav' => 'off',
						'caption' => $caption,
						'caption_width' => '1006',
						'width' => '1006',
						'height' => '250',
						'id' => 'slidertop',
					);
				} else {
					$atts = array(
						'amount' => '4',
						'category_name' => $slidercat,
						'slider_nav' => 'on',
						'caption' => $caption,
						'id' => 'slidertop',
						);					
				}
				return slider($atts,$content = null);
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
$cc_page_options=get_cc_page_options(); 
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