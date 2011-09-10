<?php 
class Theme_Generator{

var $detect;

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
		
		$this->detect = new TK_WP_Detect();
		
		if($cap->sidebar_position == ''){
			$cap->sidebar_position = 'right';
			$cap->menue_disable_home = true;
			$cap->enable_slideshow_home = 'home';
			$cap->header_text = 'off';
			$cap->preview = true;
		}	
		
		// Load predefined constants first thing
		add_action( 'bp_cc_init', array( $this, 'load_constants' ), 2 );
		
		// header.php
		add_action( 'bp_before_header', array( $this, 'innerrim_before_header' ), 2 );
		add_action( 'bp_after_header', array( $this, 'innerrim_after_header' ), 2 );
		add_action( 'bp_after_header_nav', array( $this, 'menue_enable_search' ), 2 );
		add_action( 'bp_before_access', array( $this, 'header_logo' ), 2 );
		add_action( 'bp_menu', array( $this, 'bp_menu' ), 2 );
		add_action( 'bp_after_header', array( $this, 'slideshow_home' ), 2 );
		add_action( 'favicon', array( $this, 'favicon' ), 2 );
		
		// footer.php
		add_action( 'bp_before_footer', array( $this, 'innerrim_before_footer' ), 2 );
		add_action( 'bp_after_footer', array( $this, 'innerrim_after_footer' ), 2 );
		add_action( 'bp_footer', array( $this, 'footer_content' ), 2 );
		
		// Sidebars
		add_action( 'sidebar_left', array( $this, 'sidebar_left' ), 2 );
		add_action( 'sidebar_right', array( $this, 'sidebar_right' ), 2 );
		add_action( 'bp_inside_after_sidebar', array( $this, 'login_sidebar_widget' ), 2 );
		
		// Home
		add_action( 'bp_before_blog_home', array( $this, 'default_homepage_last_posts' ), 2 );
		add_filter('body_class',array( $this, 'home_body_class'), 10 );
		
		// Helper Functions
		add_action( 'blog_post_entry', array( $this, 'excerpt_on' ), 2 );
		
		// Groups
		add_action( 'bp_before_group_home_content', array( $this, 'before_group_home_content' ), 2 );
		
		// Profil
		add_action( 'bp_before_member_home_content', array( $this, 'before_member_home_content' ), 2 );
		
		// Custom Login
		add_action('login_head', array( $this, 'custom_login'), 2 );
		
		
	}
	
	
	// HEADER FUNCTIONS START
	
	function innerrim_before_header(){
		global $cap;
		
		if ($cap->header_width != "full-width") {
			echo '<div id="innerrim">'; 
		}
	}
	
	function innerrim_after_header(){
		global $cap;
		
		if ($cap->header_width == "full-width") {
			echo '<div id="innerrim">';
		}
	}
	
	function menue_enable_search(){
		global $cap;

		if(defined('BP_VERSION')){
			if($cap->menue_enable_search){?>
			<div id="search-bar">
				<div class="padder">
				
				<form action="<?php echo bp_search_form_action() ?>" method="post" id="search-form">
					<input type="text" id="search-terms" name="search-terms" value="" />
					<?php echo bp_search_form_type_select() ?>
	
					<input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'buddypress' ) ?>" />
					<?php wp_nonce_field( 'bp_search_form' ) ?>
				</form><!-- #search-form -->
	
				<?php do_action( 'bp_search_login_bar' ) ?>
	
				</div><!-- .padder -->
			</div><!-- #search-bar -->
			<?php 
			}
		}
	}
	
	function header_logo(){
		global $cap;	
			if(is_home()): ?>
			<div id="logo">
			<h1><a href="<?php echo site_url() ?>" title="<?php _e( 'Home', 'buddypress' ) ?>"><?php if(defined('BP_VERSION')){ bp_site_name(); } else { bloginfo('name'); } ?></a></h1>
			<div id="blog-description"><?php bloginfo('description'); ?></div>
			
			<?php if($cap->logo){ ?>
			<a href="<?php echo site_url() ?>" title="<?php _e( 'Home', 'buddypress' ) ?>"><img src="<?php echo $cap->logo?>" alt="<?php if(defined('BP_VERSION')){ bp_site_name(); } else { bloginfo('name'); } ?>"></img></a>
			<?php } ?>
			</div>
		<?php else: ?>
			<div id="logo">
			<h4><a href="<?php echo site_url() ?>" title="<?php _e( 'Home', 'buddypress' ) ?>"><?php if(defined('BP_VERSION')){ bp_site_name(); } else { bloginfo('name'); } ?></a></h4>
			<div id="blog-description"><?php bloginfo('description'); ?></div>
			<?php if($cap->logo){ ?>
			<a href="<?php echo site_url() ?>" title="<?php _e( 'Home', 'buddypress' ) ?>"><img src="<?php echo $cap->logo?>" alt="<?php if(defined('BP_VERSION')){ bp_site_name(); } else { bloginfo('name'); } ?>"></img></a>
			<?php } ?>
			</div>
		<?php endif;
	}
	
	function bp_menu(){
		global $cap;	
	
		if(!defined('BP_VERSION')) :
			if($cap->menue_disable_home == true){ ?>
				<ul>
					<li id="nav-home"<?php if ( is_home() ) : ?> class="page_item current-menu-item"<?php endif; ?>>
						<a href="<?php echo site_url() ?>" title="<?php _e( 'Home', 'buddypress' ) ?>"><?php _e( 'Home', 'buddypress' ) ?></a>
					</li>
				</ul>
			<?php } ?>
		<?php else : ?>
			<ul>
			<?php if($cap->menue_disable_home == true){ ?>
				<li id="nav-home"<?php if ( bp_is_front_page() ) : ?> class="page_item current-menu-item"<?php endif; ?>>
					<a href="<?php echo site_url() ?>" title="<?php _e( 'Home', 'buddypress' ) ?>"><?php _e( 'Home', 'buddypress' ) ?></a>
				</li>
			<?php }?>
				<?php if($cap->menue_enable_community == true){ ?>
				<li id="nav-community"<?php if ( bp_is_page( BP_ACTIVITY_SLUG ) || (bp_is_page( BP_MEMBERS_SLUG ) || bp_is_member()) || (bp_is_page( BP_GROUPS_SLUG ) || bp_is_group()) || bp_is_page( BP_FORUMS_SLUG ) || bp_is_page( BP_BLOGS_SLUG ) )  : ?> class="page_item current-menu-item"<?php endif; ?>>
					<a href="<?php echo site_url() ?>/<?php echo BP_ACTIVITY_SLUG ?>/" title="<?php _e( 'Community', 'buddypress' ) ?>"><?php _e( 'Community', 'buddypress' ) ?></a>
					<ul class="children">
						<?php if ( 'activity' != bp_dtheme_page_on_front() && bp_is_active( 'activity' ) ) : ?>
							<li<?php if ( bp_is_page( BP_ACTIVITY_SLUG ) ) : ?> class="selected"<?php endif; ?>>
								<a href="<?php echo site_url() ?>/<?php echo BP_ACTIVITY_SLUG ?>/" title="<?php _e( 'Activity', 'buddypress' ) ?>"><?php _e( 'Activity', 'buddypress' ) ?></a>
							</li>
						<?php endif; ?>
		
						<li<?php if ( bp_is_page( BP_MEMBERS_SLUG ) || bp_is_member() ) : ?> class="selected"<?php endif; ?>>
							<a href="<?php echo site_url() ?>/<?php echo BP_MEMBERS_SLUG ?>/" title="<?php _e( 'Members', 'buddypress' ) ?>"><?php _e( 'Members', 'buddypress' ) ?></a>
						</li>
		
						<?php if ( bp_is_active( 'groups' ) ) : ?>
							<li<?php if ( bp_is_page( BP_GROUPS_SLUG ) || bp_is_group() ) : ?> class="selected"<?php endif; ?>>
								<a href="<?php echo site_url() ?>/<?php echo BP_GROUPS_SLUG ?>/" title="<?php _e( 'Groups', 'buddypress' ) ?>"><?php _e( 'Groups', 'buddypress' ) ?></a>
							</li>
							<?php if ( bp_is_active( 'forums' ) && ( function_exists( 'bp_forums_is_installed_correctly' ) && !(int) bp_get_option( 'bp-disable-forum-directory' ) ) && bp_forums_is_installed_correctly() ) : ?>
								<li<?php if ( bp_is_page( BP_FORUMS_SLUG ) ) : ?> class="selected"<?php endif; ?>>
									<a href="<?php echo site_url() ?>/<?php echo BP_FORUMS_SLUG ?>/" title="<?php _e( 'Forums', 'buddypress' ) ?>"><?php _e( 'Forums', 'buddypress' ) ?></a>
								</li>
							<?php endif; ?>
						<?php endif; ?>
		
						<?php if ( bp_is_active( 'blogs' ) && bp_core_is_multisite() ) : ?>
							<li<?php if ( bp_is_page( BP_BLOGS_SLUG ) ) : ?> class="selected"<?php endif; ?>>
								<a href="<?php echo site_url() ?>/<?php echo BP_BLOGS_SLUG ?>/" title="<?php _e( 'Blogs', 'buddypress' ) ?>"><?php _e( 'Blogs', 'buddypress' ) ?></a>
							</li>
						<?php endif; ?>
					</ul>
				</li>
        		<?php do_action( 'bp_nav_items' ); ?>
        		<?php } ?>
			</ul>
		<?php endif;
		}
		
	function slideshow_home(){
		global $cap;	
		$cc_page_options=cc_get_page_meta();
	
		if(defined('BP_VERSION')){ 
			if($cap->enable_slideshow_home == 'all' || $cap->enable_slideshow_home == 'home' && is_home() || $cap->enable_slideshow_home  == 'home' && is_front_page() || $cap->enable_slideshow_home == 'home' && bp_is_activity_front_page() || is_page() && isset($cc_page_options) && $cc_page_options['cc_page_slider_on'] == 1){
				echo slidertop();
			}
		} elseif($cap->enable_slideshow_home == 'all' || $cap->enable_slideshow_home == 'home' && is_home() || $cap->enable_slideshow_home == 'home' && is_front_page() || is_page() && isset($cc_page_options) && $cc_page_options['cc_page_slider_on'] == 1){
			echo slidertop();
		}
	}

	function favicon(){
		global $cap;	
		
		if($cap->favicon != '') {
			echo '<link rel="shortcut icon" href="'.$cap->favicon.'" />';
		}
	}
	

	// FOOTER FUNCTIONS START
	
	function innerrim_before_footer(){
		global $cap;
		
		if ($cap->footer_width == "full-width") {
			echo '</div><!-- #innerrim -->'; 
		}
	}
	
	function innerrim_after_footer(){
		global $cap;
		
		if ($cap->footer_width != "full-width") {
			echo '</div><!-- #innerrim -->';
		}
	}
	
	function footer_content(){ ?>
		<?php global $cap ?>
		<?php if( ! dynamic_sidebar( 'footerfullwidth' )) :?>
			<?php if($cap->preview == true){ ?>
				<div class="widget" style="margin-bottom: 0; padding: 12px; border: 1px solid #dddddd;">
						<h3 class="widgettitle" ><?php _e('20 widget areas all over the site', 'buddypress'); ?></h3>
						<div><p style="font-size: 16px; line-height:170%;">4 header + 4 footer widget areas (2 full width and 6 columns). <br>
						6 widget areas for members + 6 for groups. 
						</p></div>
				
				</div>
			<?php } ?>	
		<?php endif; ?>
	
		<?php  if (is_active_sidebar('footerleft') || $cap->preview == true ){ ?>
		<div class="widgetarea cc-widget">
			<?php if( ! dynamic_sidebar( 'footerleft' )){ ?>
				<div class="widget">
					<h3 class="widgettitle" ><?php _e('Links', 'buddypress'); ?></h3>
					<ul>
						<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
					</ul>
				</div>
			<?php } ?>
	  	</div>
		<?php  } ?>
  	
  		<?php if (is_active_sidebar('footercenter') || $cap->preview == true){ ?>
		<div <?php if(!is_active_sidebar('footerleft') && $cap->preview != true ) { echo 'style="margin-left: 34% !important;"'; } ?> class="widgetarea cc-widget">
			<?php if( ! dynamic_sidebar( 'footercenter' )){ ?>
				<div class="widget">
					<h3 class="widgettitle" ><?php _e('Archives', 'buddypress'); ?></h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</div>				
			<?php } ?>
	  	</div>
  		<?php } ?>
  	
  		<?php if (is_active_sidebar('footerright') || $cap->preview == true ){ ?>
		<div class="widgetarea cc-widget cc-widget-right">
			<?php if( ! dynamic_sidebar( 'footerright' )){ ?>
				<div class="widget">
					<h3 class="widgettitle" ><?php _e('Meta', 'buddypress'); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</div>
			<?php } ?>
	  	</div>
	  	<?php } ?>
  	
  		<div class="clear"></div>
	  	<br />
		<br />
		<div class="credits"><?php printf( __( '%s is proudly powered by <a class="credits" href="http://wordpress.org">WordPress</a> and <a class="credits" href="http://buddypress.org">BuddyPress</a>. ', 'buddypress' ), bloginfo('name') ); ?>
		Just another <a class="credits" href="http://themekraft.com/all-themes/" target="_blank" title="Wordpress Theme" alt="WordPress Theme">WordPress Theme</a> developed by Themekraft.</div>
	<?php 
	}
	

	// Sidebars
	
	function sidebar_left(){
		global $cap, $bp;
	
		$componet = explode('-',$this->detect->tk_get_page_type());
		$lw = get_leftsidebar_width();
		$rw = get_rightsidebar_width();
		
		if($componet[2] == 'groups' && !empty($componet[3])) {
				
				switch ($cap->bp_groups_sidebars) {
				    case 'left': echo '<style type="text/css"> div#content .padder{ margin-left: '.$lw.'; margin-right: 0; } </style>'; break;
				    case 'right': echo '<style type="text/css"> div#content .padder{ margin-right: '.$rw.'; margin-left: 0; } </style>'; break;
				    case 'left and right': echo '<style type="text/css"> div#content .padder{ margin-left: '.$lw.'; margin-right: '.$rw.'; } </style>'; break;
				}
			
				if($cap->bp_groups_sidebars == 'left' || $cap->bp_groups_sidebars == 'left and right' ):
					locate_template( array( 'groups/single/group-sidebar-left.php' ), true );
				endif;
				
				if($cap->bp_groups_sidebars == 'none'){  ?>

					<style type="text/css">
						
					<?php if ( $cap->bg_container_img == "" ) { 	// check if a custiom image is selected for the container else display no container image by default (the vertical lines) ?>	
					#container { background-image: none; background-image: none !important; }	
					<?php } ?>
					
					div#content .padder { margin-left: 0; margin-right: 0; }
					</style>
					
			<?php } ?>
		<?php 
		} elseif($componet[2] == 'profil' && !empty($componet[3])) {
		
			
			switch ($cap->bp_profile_sidebars) 
			{
			    case 'left': echo '<style type="text/css"> div#content .padder{ margin-left: '.$lw.'; margin-right: 0; } </style>'; break;
			    case 'right': echo '<style type="text/css"> div#content .padder{ margin-right: '.$rw.'; margin-left: 0; } </style>'; break;
			    case 'left and right': echo '<style type="text/css"> div#content .padder{ margin-left: '.$lw.'; margin-right: '.$rw.'; } </style>'; break;
			} 
			
			if($cap->bp_profile_sidebars == 'left' || $cap->bp_profile_sidebars == 'left and right' ):
				locate_template( array( 'members/single/member-sidebar-left.php' ), true );
			endif;
		
			if($cap->bp_profile_sidebars == 'none'){ ?>
				<style type="text/css">	
					div#content .padder { margin-left: 0; margin-right: 0; }
				</style>
	
			<?php } ?>
		<?php 
		} else {
			if($cap->sidebar_position == "left" || $cap->sidebar_position == "left and right"){
				locate_template( array( 'sidebar-left.php' ), true );
			}    
  		}
	}

	function sidebar_right(){
		global $cap, $bp;
	
		$componet = explode('-',$this->detect->tk_get_page_type());
		
		if($componet[2] == 'groups' && !empty($componet[3])) {
			
				if($cap->bp_groups_sidebars == 'right' || $cap->bp_groups_sidebars == 'left and right' ):
					locate_template( array( 'groups/single/group-sidebar-right.php' ), true );
				endif;
				
		} elseif($componet[2] == 'profil' && !empty($componet[3])) {
			
			if($cap->bp_profile_sidebars == 'right' || $cap->bp_profile_sidebars == 'left and right' ):
				locate_template( array( 'members/single/member-sidebar-right.php' ), true );
			endif;
		
		} else {
			if($cap->sidebar_position == "right" || $cap->sidebar_position == "left and right"){
				locate_template( array( 'sidebar-left.php' ), true );
			}    
  		}
	
	}
	
	function login_sidebar_widget(){
		global $cap;
	
		if(defined('BP_VERSION')) { if($cap->login_sidebar != 'off' || $cap->login_sidebar == false){ cc_login_widget();}}
	
	}
	

	// Default Homepage
	
	function default_homepage_last_posts(){
		global $cap;
	
		if( $cap->preview == true  || $cap->default_homepage_last_posts == 'show') {
			$args = array(
				'amount' => '3',
		 	);
				
			echo '<div style="margin-top:-44px;">'.cc_list_posts($args).'</div>'; 
		}
	}
	

	// Helper Functions
	
	function excerpt_on(){
		global $cap;
	
		if($cap->excerpt_on != 'content'){
			the_excerpt( __( 'Read the rest of this entry &rarr;', 'buddypress' ) );
		} else {
			the_content( __( 'Read the rest of this entry &rarr;', 'buddypress' ) ); 
		}
	}
	

	// GROUPS
	
	function before_group_home_content(){
		global $cap;
		if( $cap->bp_groups_header == false || $cap->bp_groups_header == 'on'):?>
			<div id="item-header">
				<?php locate_template( array( 'groups/single/group-header.php' ), true ) ?>
			</div>
		<?php else:?>
			<div id="item-header">
				<h2><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></h2>
			</div>
		<?php endif;?>
		<?php if($cap->bp_default_navigation == true){?>
			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_options_nav() ?>
			
						<?php do_action( 'bp_group_options_nav' ) ?>
					</ul>
				</div>
			</div><!-- #item-nav -->
		<?php }
	}	
	
	function before_member_home_content(){
		global $cap;

		if($cap->bp_profile_header == false || $cap->bp_profile_header == 'on'): ?>
			<div id="item-header">
				<?php locate_template( array( 'members/single/member-header.php' ), true ) ?>
			</div>
		<?php else:?>
			<div id="item-header">
				<h2 class="fn"><a href="<?php bp_user_link() ?>"><?php bp_displayed_user_fullname() ?></a> <span class="highlight">@<?php bp_displayed_user_username() ?> <span>?</span></span></h2>
			</div>
		<?php endif;?>
			
		<?php if($cap->bp_default_navigation == true){?>
		<div id="item-nav">
			<div class="item-list-tabs no-ajax" id="object-nav">
				<ul>
					<?php bp_get_displayed_user_nav() ?>
		
					<?php do_action( 'bp_member_options_nav' ) ?>
				</ul>
			</div>
		</div><!-- #item-nav -->
		<?php }
	}
	

	// custom login for theme
	
	function custom_login() { 
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
	
	function home_body_class($classes){
	
		if(defined('BP_VERSION')){
			if(!in_array('home',$classes)){
				if (bp_is_front_page() )
				$classes[] = 'home';
			}
		}
		
		if(is_home()){
			$classes[] = 'bubble';
		}
		
		return $classes;
	
	}
}?>	