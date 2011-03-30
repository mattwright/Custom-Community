<?php 
require_once('shortcodes.php');
require_once('templatetags.php');
require_once('cc_widgets.php');

if(defined('BP_VERSION')) {
	require_once('bp-templatetags.php');
}
	### add css and js
add_action('wp_enqueue_scripts', 'cc_js_site');
 
### enqueue js for the slider
function cc_js_site() {
     if( isset( $_GET['page'] ) )
        return;

    wp_enqueue_script( 'jquery' );
//	wp_register_script('my-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2');
	wp_register_script('my-jquery-ui-site', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js',false,'1.5.3');
	wp_enqueue_script( 'my-jquery' );
	wp_enqueue_script( 'my-jquery-ui-site' );
	
	wp_register_script('reflection',get_template_directory_uri() . '/_inc/js/reflection.js','','' );
	wp_enqueue_script('reflection');
	
}
?>