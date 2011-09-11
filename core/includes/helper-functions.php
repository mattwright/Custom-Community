<?php 
/**
 * Check if its a child theme or parent and return the correct path
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
function require_path($path){
	Custom_Community::require_path($path);
}
	
/**
 * Get the right img for the slideshow shadow
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
function cc_slider_shadow() {
	global $cap;
	if ($cap->slideshow_shadow == "shadow") { 
		return "slider-shadow.png"; 
	} else { 
		return "slider-shadow-sharp.png"; 
	}
}  

/**
 *  Define excerpt length
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
function cc_excerpt_length() {
	global $cap;
	$excerpt_length = 30;
	if($cap->excerpt_length){
		$excerpt_length = $cap->excerpt_length;
	}
	return $excerpt_length;
}

/**
 * Change the Profile tab order
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
add_action( 'wp', 'cc_change_profile_tab_order', 999 );
function cc_change_profile_tab_order() {
	global $bp, $cap;
		
	if($cap->bp_profiles_nav_order == '')
		return
	
	$order = $cap->bp_profiles_nav_order;
	$order = str_replace(' ','',$order); 
	$order = explode(",", $order);
	$i = 1;
	foreach($order as $item) {
		$bp->bp_nav[$item]['position'] = $i;
		$i ++;
	}
}

/**
 * Change the Groups tab order
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
add_action('wp', 'cc_change_groups_tab_order');
function cc_change_groups_tab_order() {
	global $bp, $cap;

	if($cap->bp_groups_nav_order == '')
		return
		
	$order = $cap->bp_groups_nav_order;
	$order = str_replace(' ','',$order); 
	$order = explode(",", $order);
	$i = 1;
	foreach($order as $item) {
		$bp->bp_options_nav['groups'][$item]['position'] = $i;
		$i ++;
	}
}

/**
 * Helper Function Leftsidebarwidth
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
function leftsidebar_width() {
	echo get_leftsidebar_width();
}
	function get_leftsidebar_width() {
		global $cap;
		$width = '224';
		if ( $cap->leftsidebar_width != '') { 
			$width = $cap->leftsidebar_width; 
		}
		$width .= 'px';		
		return $width; 
	}

/**
 * Helper Function rightsidebar_width
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
function rightsidebar_width() {
	echo get_rightsidebar_width();
}
	function get_rightsidebar_width() {
		global $cap;
		$width = '225';
		if ( $cap->rightsidebar_width != '') { 
			$width = $cap->rightsidebar_width; 
		}
		$width .= 'px';
		return $width; 
	}
	

/**
 * Find out the right color chema and create the array of css elements with the hex codes
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
	
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
	
/**
 * Find out the right color chema and create the array of css elements with the hex codes
 *
 * @package BuddyPress Custom Community
 * @since 1.8.3
 */
function color_scheme(){
echo get_color_scheme();
}
	function get_color_scheme(){
		global $cap;
		if(isset( $_GET['show_style']))
			$cap->style_css = $_GET['show_style']; 
			
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
?>