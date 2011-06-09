<?php 
require_once(cc_require_path('/core/shortcodes.php'));
require_once('templatetags.php');
require_once('cc_widgets.php');

if(defined('BP_VERSION')) {
	require_once('bp-templatetags.php');
}
	### add css and js
add_action('wp_enqueue_scripts', 'cc_js_site');
 
### enqueue js for the slider
function cc_js_site() {
     if( is_admin() )
        return;

    wp_deregister_script( 'ep-jquery-css' );
        
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui' );	
	wp_enqueue_script( 'jquery-ui-tabs' );
	
	wp_register_script('reflection',get_template_directory_uri() . '/_inc/js/reflection.js','','' );
	wp_enqueue_script('reflection');
	
}
?>