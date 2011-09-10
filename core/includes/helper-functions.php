<?php 
global $cap;

function require_path($path){
	Custom_Community::require_path($path);
}

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
	

function cc_slider_shadow() {
	global $cap;
	if ($cap->slideshow_shadow == "shadow") { 
		return "slider-shadow.png"; 
	} else { 
		return "slider-shadow-sharp.png"; 
	}
}  

/** check if its a child theme or parent and return the correct path */

function cc_require_path($path){
	if( TEMPLATEPATH != STYLESHEETPATH && is_file(STYLESHEETPATH . $path) ): 	
        return STYLESHEETPATH . $path;
    else:
        return TEMPLATEPATH . $path;
    endif;
}


### Define excerpt length

add_filter('excerpt_length', 'cc_excerpt_length');

function cc_excerpt_length() {
	global $cap;
	$excerpt_length = 30;
	if($cap->excerpt_length){
		$excerpt_length = $cap->excerpt_length;
	}
	return $excerpt_length;
}

function slide1_excerpt_length() {
	return 30;
}

if($cap->bp_profiles_nav_order != ''){
	add_action( 'wp', 'cc_change_profile_tab_order', 999 );
}

function cc_change_profile_tab_order() {
	global $bp, $cap;
	 
	$order = $cap->bp_profiles_nav_order;
	$order = str_replace(' ','',$order); 
	$order = explode(",", $order);
	$i = 1;
	foreach($order as $item) {
		$bp->bp_nav[$item]['position'] = $i;
		$i ++;
	}
}

if($cap->bp_groups_nav_order != ''){
	add_action('wp', 'cc_change_groups_tab_order');
}

function cc_change_groups_tab_order() {
	global $bp, $cap;
	 
	$order = $cap->bp_groups_nav_order;
	$order = str_replace(' ','',$order); 
	$order = explode(",", $order);
	$i = 1;
	foreach($order as $item) {
		$bp->bp_options_nav['groups'][$item]['position'] = $i;
		$i ++;
	}
}
?>