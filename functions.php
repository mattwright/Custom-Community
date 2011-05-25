<?php
require_once('admin/cheezcap.php');
require_once('core/core-loader.php');

global $content_width, $cap;

add_filter('widget_text', 'do_shortcode');

add_theme_support( 'automatic-feed-links' );

## load the text domain
//load_plugin_textdomain( 'cc-pro',get_template_directory(), get_template_directory() );


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

if($cap->bp_profiles_nav_order != ''){
	add_action( 'wp', 'cc_change_profile_tab_order', 999 );
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

if($cap->bp_groups_nav_order != ''){
	add_action('wp', 'cc_change_groups_tab_order');
}

function cc_widgets_init(){
	### Add Sidebars
	register_sidebars( 1,
		array(
			'name' => 'header full width',
			'id' => 'headerfullwidth',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'header left',
			'id' => 'headerleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'header center',
			'id' => 'headercenter',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'header right',
			'id' => 'headerright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'Sidebar',
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'left sidebar',
			'id' => 'leftsidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'footer full width',
			'id' => 'footerfullwidth',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'footer left',
			'id' => 'footerleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'footer center',
			'id' => 'footercenter',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'footer right',
			'id' => 'footerright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member header',
			'id' => 'memberheader',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member header left',
			'id' => 'memberheaderleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member header center',
			'id' => 'memberheadercenter',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member header right',
			'id' => 'memberheaderright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member sidebar left',
			'id' => 'membersidebarleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member sidebar right',
			'id' => 'membersidebarright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group header',
			'id' => 'groupheader',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group header left',
			'id' => 'groupheaderleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group header center',
			'id' => 'groupheadercenter',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group header right',
			'id' => 'groupheaderright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group sidebar left',
			'id' => 'groupsidebarleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group sidebar right',
			'id' => 'groupsidebarright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 15,
		array(
			'name' => 'shortcode %1$s',
			'id' => 'shortcode',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);

}
add_action( 'widgets_init', 'cc_widgets_init' );

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

if($cap->bp_login_bar_top == 'off') {
define( 'BP_DISABLE_ADMIN_BAR', false );
}

### Define excerpt length
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
add_filter('excerpt_length', 'cc_excerpt_length');


// custom login for theme
function cc_custom_login() { 

	global $cap;?> 
<style type="text/css">

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

<?php if($cap->bg_loginpage_body_img || $cap->bg_loginpage_body_color){ ?>
	html, .wp-dialog {
		<?php if($cap->bg_loginpage_body_img){ ?>
			background-image: url('<?php echo $cap->bg_loginpage_body_img; ?>');
		<?php } ?>
		<?php if($cap->bg_loginpage_body_color){ ?>
			background-color: #<?php echo $cap->bg_loginpage_body_color; ?>;
		<?php } ?>
	}
<?php } ?>

<?php if($cap->bg_loginpage_body_color){ ?>
body {
	color:#<?php echo $cap->bg_loginpage_body_color; ?>;
}
<?php } ?>
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
<?php if($cap->bg_loginpage_backtoblog_fade_1 && $cap->bg_loginpage_backtoblog_fade_2){ ?>
	#backtoblog {
		 background: -moz-linear-gradient(center bottom , #<?php echo $cap->bg_loginpage_backtoblog_fade_1; ?>, #<?php echo $cap->bg_loginpage_backtoblog_fade_2; ?>) repeat scroll 0 0 transparent;
	}
<?php } ?>
</style>
	
<?php 
}
 
add_action('login_head', 'cc_custom_login');

if($cap->buddydev_search == true){

if(defined('BP_VERSION')) {
/* Add these code to your cunctions.php to allow Single Search page for all buddypress components*/
//	Remove Buddypress search drowpdown for selecting members etc
add_filter("bp_search_form_type_select", "cc_remove_search_dropdown"  );
function cc_remove_search_dropdown($select_html){
    return '';
}

remove_action( 'init', 'bp_core_action_search_site', 5 );//force buddypress to not process the search/redirect
add_action( 'init', 'cc_bp_buddydev_search', 10 );// custom handler for the search

function cc_bp_buddydev_search(){
global $bp;
	if ( $bp->current_component == BP_SEARCH_SLUG )//if thids is search page
		bp_core_load_template( apply_filters( 'bp_core_template_search_template', 'search-single' ) );//load the single searh template
}
add_action("advance-search","cc_show_search_results",1);//highest priority

/* we just need to filter the query and change search_term=The search text*/
function cc_show_search_results(){
    //filter the ajaxquerystring
     add_filter("bp_ajax_querystring","cc_global_search_qs",100,2);
}

//show the search results for member*/
function cc_show_member_search(){
    ?>
   <div class="memberss-search-result search-result">
   <h2 class="content-title"><?php _e("Members Results","buddypress");?></h2>
  <?php locate_template( array( 'members/members-loop.php' ), true ) ;  ?>
  <?php global $members_template;
	if($members_template->total_member_count>1):?>
		<a href="<?php echo bp_get_root_domain().'/'.BP_MEMBERS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e(sprintf("View all %d matched Members",$members_template->total_member_count),"buddypress");?></a>
	<?php 	endif; ?>
</div>
<?php	
 }

//Hook Member results to search page
add_action("advance-search","cc_show_member_search",10); //the priority defines where in page this result will show up(the order of member search in other searchs)
function cc_show_groups_search(){
    ?>
<div class="groups-search-result search-result">
 	<h2 class="content-title"><?php _e("Group Search","buddypress");?></h2>
	<?php locate_template( array('groups/groups-loop.php' ), true ) ;  ?>
	
	<a href="<?php echo bp_get_root_domain().'/'.BP_GROUPS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched Groups","buddypress");?></a>
</div>
	<?php
 //endif;
  }

//Hook Groups results to search page
 if(bp_is_active( 'groups' ))
    add_action("advance-search","cc_show_groups_search",10);

/**
 *
 * Show blog posts in search
 */
function cc_show_site_blog_search(){
    ?>
 <div class="blog-search-result search-result">
 
  <h2 class="content-title"><?php _e("Blog Search","buddypress");?></h2>
   
   <?php locate_template( array( 'search-loop.php' ), true ) ;  ?>
   <a href="<?php echo bp_get_root_domain().'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched Posts","buddypress");?></a>
</div>
   <?php
  }

//Hook Blog Post results to search page
 add_action("advance-search","cc_show_site_blog_search",10);

//show forums search
function cc_show_forums_search(){
    ?>
 <div class="forums-search-result search-result">
   <h2 class="content-title"><?php _e("Forums Search","buddypress");?></h2>
  <?php locate_template( array( 'forums/forums-loop.php' ), true ) ;  ?>
  <a href="<?php echo bp_get_root_domain().'/'.BP_FORUMS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched forum posts","buddypress");?></a>
</div>
  <?php
  }

//Hook Forums results to search page
if ( bp_is_active( 'forums' ) && bp_is_active( 'groups' ) && ( function_exists( 'bp_forums_is_installed_correctly' ) && !(int) bp_get_option( 'bp-disable-forum-directory' ) ) && bp_forums_is_installed_correctly() )
 add_action("advance-search","cc_show_forums_search",20);


//show blogs search result

function cc_show_blogs_search(){

    ?>
  <div class="blogs-search-result search-result">
  <h2 class="content-title"><?php _e("Blogs Search","buddypress");?></h2>
  <?php locate_template( array( 'blogs/blogs-loop.php' ), true ) ;  ?>
  <a href="<?php echo bp_get_root_domain().'/'.BP_BLOGS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched Blogs","buddypress");?></a>
 </div>
  <?php
  }

//Hook Blogs results to search page if blogs comonent is active
 if(bp_is_active( 'blogs' ))
    add_action("advance-search","cc_show_blogs_search",10);


 //modify the query string with the search term
function cc_global_search_qs(){
	return "search_terms=".$_REQUEST['search-terms'];
}

function cc_is_advance_search(){
global $bp;
if($bp->current_component == BP_SEARCH_SLUG)
	return true;
return false;
}

}
}
?>
