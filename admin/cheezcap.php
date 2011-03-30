<?php
//
// CheezCap - Cheezburger Custom Administration Panel
// (c) 2008 - 2010 Cheezburger Network (Pet Holdings, Inc.)
// LOL: http://cheezburger.com
// Source: http://code.google.com/p/cheezcap/
// Authors: Kyall Barrows, Toby McKes, Stefan Rusek, Scott Porad
// License: GNU General Public License, version 2 (GPL), http://www.gnu.org/licenses/gpl-2.0.html
//
require_once('get-pro.php');
require_once('style.php');
require_once('page-meta-box.php');
require_once('post-meta-box.php');

require_once('cc-upload.php');
require_once('library.php');
require_once('config.php');

$cap = new autoconfig();

if ( ! defined( 'LOADED_CONFIG' ) ) {
    add_action( 'admin_menu', 'cap_add_admin' );
    define( 'LOADED_CONFIG', 1 );
}

function cap_add_admin() {
	global $themename, $req_cap_to_edit;

	if ( ! current_user_can ( $req_cap_to_edit ) )
		return;
	
	if ( isset( $_GET['page'] ) && $_GET['page'] == basename( __FILE__ ) ) {
		$options = cap_get_options();
		$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
		$method = false;
		$done = false;
		$data = new ImportData();
		switch ( $action ) {
			case 'save':
				$method = 'Update';
				break;
			case 'Reset':			
				global $wpdb;
				$options = $wpdb->get_results("SELECT * FROM wp_options ORDER BY option_name");
				foreach((array) $options as $option) :
		  			$option->option_name = esc_attr($option->option_name);
		  			if(substr($option->option_name, 0, 4)=='cap_') {
		    			delete_option($option->option_name);     
		  			}
	      		endforeach;
	      		$method = false;
				
				break;
			case 'Export':
				$method = 'Export';
				$done = 'cap_serialize_export';
				break;
			case 'Import':
				$method = 'Import';
				$data = unserialize( file_get_contents( $_FILES['file']['tmp_name'] ) );
				break;
		}

		if ( $method ) {
			foreach ( $options as $group ) {
				foreach ( $group->options as $option ) {
					call_user_func( array( $option, $method ), $data );
				}
	    		}
			if ( $done )
				call_user_func( $done, $data );
		}
	}

	$pgName = "$themename Settings";
	$hook = add_theme_page( $pgName, $pgName, isset( $req_cap_to_edit ) ? $req_cap_to_edit : 'manage_options', basename( __FILE__ ), 'top_level_settings' );
	add_action( "admin_print_scripts-$hook", 'cap_admin_js_libs' );
	add_action( "admin_footer-$hook", 'cap_admin_js_footer' );
	add_action( "admin_print_styles-$hook", 'cap_admin_css' );
	add_action( "admin_footer-$hook", 'my_action_javascript');
	
}
