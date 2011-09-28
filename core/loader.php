<?php

define( 'CC_VERSION', '1.8.5' );

/**
 * loads custom community files
 *
 * @package Custom Community
 * @since 1.8.3
 */
function cc_init() {
	
	require( dirname( __FILE__ ) . '/custom-community.php' );
	$cc = new Custom_Community;
	
	require( dirname( __FILE__ ) . '/includes/buddydev-search.php' );
	//initialize
	BPUnifiedsearch::get_instance();//that is the beauty of singleton, no proliferation of globals and you can always acess the same instance if you want to :)
	
}

add_action( 'init', 'cc_init',1,1 );

?>