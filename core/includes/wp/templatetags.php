<?php 
/**
 * check if wordpress or buddypress - if buddypress, check if also MU and return the correct title
 * 
 * located: header.php
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
?>