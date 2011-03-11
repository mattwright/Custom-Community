<?php 
require_once('shortcodes.php');
require_once('templatetags.php');
require_once('cc_widgets.php');

if(defined('BP_VERSION')) {
	require_once('bp-templatetags.php');
}
	### add css and js
add_action('admin_head','cc_css_admin');  
add_action('init', 'cc_js_admin');
add_action('wp_enqueue_scripts', 'cc_js_site');

### add css for the admin option page
function cc_css_admin() {
    if( isset($_GET['page']) && $_GET['page'] == 'cheezcap.php' ) {
		echo '<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css" rel="stylesheet" />';
	}
}

### enqueue js for the admin option page
function cc_js_admin() {

    if( ! isset( $_GET['page'] ) )
        return;

    if( $_GET['page'] == 'cheezcap.php' ) {
		wp_register_script('my-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2');
		wp_register_script('my-jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js',false,'1.7.1');
		wp_enqueue_script( 'my-jquery' );
		wp_enqueue_script( 'my-jquery-ui' );
    } 
}
 
### enqueue js for the slider
function cc_js_site() {
     if( isset( $_GET['page'] ) )
        return;
	wp_enqueue_script( 'jquery' );
//	wp_register_script('my-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2');
	wp_register_script('my-jquery-ui-site', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js',false,'1.5.3');
	wp_enqueue_script( 'my-jquery' );
	wp_enqueue_script( 'my-jquery-ui-site' );
	
	wp_register_script('reflection',get_bloginfo('template_directory') . '/_inc/js/reflection.js','','' );
	wp_enqueue_script('reflection');
	
}
?>