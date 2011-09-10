<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		
		<?php do_action('favicon') ?>
		
		<title> <?php cc_wp_title(); ?> </title>
		
		<?php do_action( 'bp_head' ) ?>

		<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		
		<?php if ( function_exists( 'bp_sitewide_activity_feed_link' ) ) : ?>
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php _e('Site Wide Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_sitewide_activity_feed_link() ?>" />
		<?php endif; ?>

		<?php if ( function_exists( 'bp_member_activity_feed_link' ) && bp_is_member() ) : ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php bp_displayed_user_fullname() ?> | <?php _e( 'Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_member_activity_feed_link() ?>" />
		<?php endif; ?>

		<?php if ( function_exists( 'bp_group_activity_feed_link' ) && bp_is_group() ) : ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php bp_current_group_name() ?> | <?php _e( 'Group Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_group_activity_feed_link() ?>" />
		<?php endif; ?>

		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php wp_head(); ?>
	</head>

	<body <?php body_class() ?> id="bp-default">
 <div id="outerrim">
 
 	<?php do_action( 'bp_before_header' ) ?>
	
	<div id="header">	
	
    	<?php wp_nav_menu( array( 'container_class' => 'menu menu-top', 'theme_location' => 'menu_top','container' => 'div', 'fallback_cb' => false ) ); ?>
	
		<?php if( ! dynamic_sidebar( 'headerfullwidth' )) :?>
		<?php endif; ?>

		<?php if (is_active_sidebar('headerleft') ){ ?>
			<div class="widgetarea cc-widget">
				<?php dynamic_sidebar( 'headerleft' )?>
		  	</div>
		<?php } ?>

  		<?php if (is_active_sidebar('headercenter') ){ ?>
			<div <?php if(!is_active_sidebar('headerleft')) { echo 'style="margin-left:350px !important"'; } ?> class="widgetarea cc-widget">
				<?php dynamic_sidebar( 'headercenter' ) ?>
		  	</div>
  		<?php } ?>

  		<?php if (is_active_sidebar('headerright') ){ ?>
			<div class="widgetarea cc-widget cc-widget-right">
				<?php dynamic_sidebar( 'headerright' ) ?>
		  	</div>
	  	<?php } ?>
  		
		<?php do_action( 'bp_before_access')?>
				
		<div id="access">
    		<div class="menu">
	
				<?php do_action('bp_menu') ?>

				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary','container' => '' ) ); ?>
			</div>
		</div>
		
		<?php do_action( 'bp_after_header_nav' ) ?>
		
		<div class="clear"></div>
	
		</div><!-- #header -->

		<?php do_action( 'bp_after_header' ) ?>		
		
		<?php do_action( 'bp_before_container' ) ?>

		<div id="container">
		
		<?php do_action('sidebar_left');?>