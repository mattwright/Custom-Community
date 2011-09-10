<?php

class Custom_Community{
	
	/**
	 * PHP 4 constructor
	 *
	 * @package Custom Community
	 * @since 1.8.3
	 */
	function custom_community() {
		$this->__construct();
	}

	/**
	 * PHP 5 constructor
	 *
	 * @package Custom Community
	 * @since 1.8.3
	 */	
	function __construct() {
		global $bp;
		
		
		// Load predefined constants first thing
		add_action( 'bp_cc_init', array( $this, 'load_constants' ), 2 );
		
		// Includes necessary files
		add_action( 'bp_cc_init', array( $this, 'includes' ), 100, 4 );
		
		// Includes the necessary js
		add_action('wp_enqueue_scripts', array( $this, 'cc_js_site' ), 2 );
		
		// Let plugins know that Custom Community has started loading
		$this->init_hook();

		// Let other plugins know that Custom Community has finished initializing
		$this->loaded();
		
		$Theme_Generator = new Theme_Generator();
	}
	
	/**
	 * Defines Custom Community init action
	 *
	 * This action fires on WP's init action and provides a way for the rest of Custom Community,
	 * as well as other dependent plugins, to hook into the loading process in an
	 * orderly fashion.
	 *
	 * @package Custom Community
	 * @since 1.8.3
	 */	
	function init_hook() {
		do_action( 'bp_cc_init' );
	}
	
	/**
	 * Defines Custom Community action
	 *
	 * This action tells Custom Community and other plugins that the main initialization process has
	 * finished.
	 * 
	 * @package Custom Community
	 * @since 1.8.3
	 */	
	function loaded() {
		do_action( 'bp_cc_loaded' );
	}
	
	/**
	 * Defines constants needed throughout the theme.
	 *
	 * These constants can be overridden in bp-custom.php or wp-config.php.
	 *
	 * @package Custom Community
	 * @since 1.8.3
	 */		
	function load_constants() {
		
		// The slug used when deleting a doc
		if ( !defined( 'CC_TEMPLATE_PATH' ) )
			define( 'CC_TEMPLATE_PATH', 'CC_TEMPLATE_PATH' );
			
	}	
	
	/**
	 * Loads the textdomain for the plugin
	 *
	 * @package Custom Community
	 * @since 1.8.3
	 */	 
	function load_plugin_textdomain() {
		load_plugin_textdomain( 'cc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	
	/**
	 * Includes files needed by Custom Community
	 *
	 * @package Custom Community
	 * @since 1.8.3
	 */	
	function includes() {
			
	
		require_once($this->require_path('/_inc/ajax.php'));
		
		// Helper Functions
		require_once($this->require_path('/core/includes/helper-functions.php'));
		
		// Theme layout specific functions
		require_once($this->require_path('/core/includes/theme-generator/style.php'));
		require_once($this->require_path('/core/includes/theme-generator/theme-generator.php'));
		
		// Wordpress specific functions
		require_once($this->require_path('/core/includes/wp/shortcodes.php'));
		require_once($this->require_path('/core/includes/wp/templatetags.php'));
		require_once($this->require_path('/core/includes/wp/widgets.php'));

		// Buddypress specific functions
		if(defined('BP_VERSION')){
			require_once($this->require_path('/core/includes/bp/templatetags.php'));
			require_once($this->require_path('/core/includes/bp/buddydev-search.php'));
		}
		
		// TKF specific functions
		require_once($this->require_path('/core/includes/tkf/wp/detect.php'));
		
		
		// Admin specific functions
		//if ( is_admin() )
		//	require_once($this->require_path('admin/cheezcap.php'));
			
	}
	
	### add css and js
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
	
	/** check if its a child theme or parent and return the correct path */
	function require_path($path){
	if( TEMPLATEPATH != STYLESHEETPATH && is_file(STYLESHEETPATH . $path) ): 	
        return STYLESHEETPATH . $path;
    else:
        return TEMPLATEPATH . $path;
    endif;
	}
}

?>