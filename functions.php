<?php
require_once('admin/cheezcap.php');
require_once('core/core-loader.php');

global $content_width, $cap;

### Add Sidebars
register_sidebars( 1,
	array(
		'name'          => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>'
	)
);
register_sidebars( 1,
	array(
		'name' => 'left sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	)
);
register_sidebars( 1,
	array(
		'name' => 'footer left',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	)
);
register_sidebars( 1,
	array(
		'name' => 'footer center',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	)
);
register_sidebars( 1,
	array(
		'name' => 'footer right',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	)
);
register_sidebars( 15,
	array(
		'name' => 'shortcode %1$s',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	)
);

## This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'buddypress' ),
) );

### Add Post Thumbnails
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 222, 160, true );
	add_image_size( 'slider-top-large', 1006, 250, true  );
	add_image_size( 'slider-large', 990, 250, true  );
	add_image_size( 'slider-middle', 756, 250, true  );
	add_image_size( 'slider-thumbnail', 80, 50, true );
	add_image_size( 'post-thumbnails', 222, 160, true  );
	add_image_size( 'single-post-thumbnail', 598, 372, true );
}

### Define Content with
$content_width  = "670";
if($cap->sidebar_position == "left and right"){
	$content_width  = "432";
}

if($cap->bp_login_bar_top == "off") {
	define( 'BP_DISABLE_ADMIN_BAR', false );
}

### Define excerpt length
function new_excerpt_length() {
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
add_filter('excerpt_length', 'new_excerpt_length');


// custom login for theme
function custom_login() { 

	global $cap;?> 
<style>
login h1 {
<?php if($cap->bg_loginpage_img){ ?>
	background-image: url('<?php echo $cap->bg_loginpage_img; ?>');
<?php } ?>
	color:#777;
}
h1 a {
<?php if($cap->bg_loginpage_img){ ?>
	background-image: url('<?php echo $cap->bg_loginpage_img; ?>');
	height:<?php echo $cap->login_logo_height; ?>px;
<?php } ?>


	clear: both;
}
body {
	color:#777;
}
.login #nav a {
	color:#777 !important;
}
.login #nav a:hover {
	color:#777 !important;
}
.updated, .login #login_error, .login .message {
	background: none;
	color:#777;
	border-color:#888;
}
#lostpasswordform {
	border-color:#999;
}
</style>
	
<?php 
add_filter('login_headerurl', create_function(false,"return bloginfo(url);"));
add_filter('login_headertitle', create_function(false,"return bloginfo(name);"));
}
 
add_action('login_head', 'custom_login');

if($cap->buddydev_search == true){
	/* Add these code to your cunctions.php to allow Single Search page for all buddypress components*/
	//	Remove Buddypress search drowpdown for selecting members etc
	add_filter("bp_search_form_type_select", "bpmag_remove_search_dropdown"  );
	function bpmag_remove_search_dropdown($select_html){
	    return '';
	}
	
	remove_action( 'init', 'bp_core_action_search_site', 5 );//force buddypress to not process the search/redirect
	add_action( 'init', 'bp_buddydev_search', 10 );// custom handler for the search
	
	function bp_buddydev_search(){
	global $bp;
		if ( $bp->current_component == BP_SEARCH_SLUG )//if thids is search page
			bp_core_load_template( apply_filters( 'bp_core_template_search_template', 'search-single' ) );//load the single searh template
	}
	add_action("advance-search","bpmag_show_search_results",1);//highest priority
	
	/* we just need to filter the query and change search_term=The search text*/
	function bpmag_show_search_results(){
	    //filter the ajaxquerystring
	     add_filter("bp_ajax_querystring","bpmag_global_search_qs",100,2);
	}
	
	
	//show forums search
	function bpmag_show_forums_search(){
	    ?>
	 <div class="forums-search-result search-result">
	   <h2 class="content-title"><?php _e("Forums Search","bpmag");?></h2>
	  <?php locate_template( array( 'forums/forums-loop.php' ), true ) ;  ?>
	  <a href="<?php echo bp_get_root_domain().'/'.BP_FORUMS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched forum posts","bpmag");?></a>
	</div>
	  <?php
	  }
	
	//Hook Forums results to search page
	if(defined( 'BP_VERSION'  )){
	if ( bp_is_active( 'forums' ) && bp_is_active( 'groups' ) && ( function_exists( 'bp_forums_is_installed_correctly' ) && !(int) bp_get_option( 'bp-disable-forum-directory' ) ) && bp_forums_is_installed_correctly() )
	 add_action("advance-search","bpmag_show_forums_search",10);
	}
	
	//show the search results for member*/
	function bpmag_show_member_search(){
	    ?>
	   <div class="members-search-result search-result">
	   <h2 class="content-title"><?php _e("Members Results","bpmag");?></h2>
	  <?php locate_template( array( 'members/members-loop.php' ), true ) ;  ?>
	  <?php global $members_template;
		if($members_template->total_member_count>1):?>
			<a href="<?php echo bp_get_root_domain().'/'.BP_MEMBERS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e(sprintf("View all %d matched Members",$members_template->total_member_count),"bpmag");?></a>
		<?php 	endif; ?>
	</div>
	<?php	
	 }
	
	//Hook Member results to search page
	add_action("advance-search","bpmag_show_member_search",40); //the priority defines where in page this result will show up(the order of member search in other searchs)
	function bpmag_show_groups_search(){
	    ?>
	<div class="groups-search-result search-result">
	 	<h2 class="content-title"><?php _e("Group Search","bpmag");?></h2>
		<?php locate_template( array('groups/groups-loop.php' ), true ) ;  ?>
		
		<a href="<?php echo bp_get_root_domain().'/'.BP_GROUPS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched Groups","bpmag");?></a>
	</div>
		<?php
	 //endif;
	  }
	
	//Hook Groups results to search page
	if(defined( 'BP_VERSION'  )){
	 if(bp_is_active( 'groups' ))
	    add_action("advance-search","bpmag_show_groups_search",30);
	}
	/**
	 *
	 * Show blog posts in search
	 */
	function bpmag_show_site_blog_search(){
	    ?>
	 <div class="blog-search-result search-result">
	 
	  <h2 class="content-title"><?php _e("Blog Search","bpmag");?></h2>
	   
	   <?php locate_template( array( 'search-loop.php' ), true ) ;  ?>
	   <a href="<?php echo bp_get_root_domain().'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched Posts","bpmag");?></a>
	</div>
	   <?php
	  }
	
	//Hook Blog Post results to search page
	 add_action("advance-search","bpmag_show_site_blog_search",20);
	
	
	
	 //modify the query string with the search term
	function bpmag_global_search_qs(){
		return "search_terms=".$_REQUEST['search-terms'];
	}
	
	function bpmag_is_advance_search(){
	global $bp;
	if($bp->current_component == BP_SEARCH_SLUG)
		return true;
	return false;
	}
}	
?>
