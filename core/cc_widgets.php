<?php 
 
### widget for the community navigation
function widget_community_nav() { ?>
  		<div id="community-nav" class="widget-title" >
  		<ul class="item-list">
         	<h3 class="widgettitle"><?php _e( 'Community', 'buddypress' ) ?></h3>
					
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
				
   <?php if( bp_is_single_item() || bp_is_member() ) { ?>
	   	<?php if(bp_is_group()){ ?>
		<div id="community-single-nav" class="widget-title" >
		  <ul class="item-list">
		  <h3 class="widgettitle"><?php _e( '@ Group', 'buddypress' ) ?></h3>
				<?php bp_get_options_nav() ?>
				<?php do_action( 'bp_group_options_nav' ) ?>
			</ul>
		
		</div>	
		<?php } ?>

		<?php if(bp_is_member()){ ?>
		<div id="community-single-nav" class="widget-title" >
		  <ul class="item-list">
		  <h3 class="widgettitle"><?php _e( '@ Member', 'buddypress' ) ?></h3>
		  <?php bp_get_displayed_user_nav() ?>
				<?php do_action( 'bp_group_options_nav' ) ?>
			</ul>
		
		</div>	
		<?php } ?>
  	<?php } ?>
  	</div>
<?php } ?>
<?php
if ( function_exists('widget_community_nav') )
    wp_register_sidebar_widget( 'widget_community_nav', 'Community Navigation', 'widget_community_nav', '' );


function cc_login_widget(){?>
	<?php global $cap;?>
		<?php do_action( 'bp_inside_before_sidebar' ) ?>
	
		<?php if ( is_user_logged_in() ) : ?>
	
			<?php do_action( 'bp_before_sidebar_me' ) ?>
			<div class="widget">
			<div id="sidebar-me">
				<a href="<?php echo bp_loggedin_user_domain() ?>">
					<?php bp_loggedin_user_avatar( 'type=thumb&width=40&height=40' ) ?>
				</a>
	
				<h4><?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?></h4>
				<a class="button logout" href="<?php echo wp_logout_url( bp_get_root_domain() ) ?>"><?php _e( 'Log Out', 'buddypress' ) ?></a>
	
				<?php do_action( 'bp_sidebar_me' ) ?>
			</div>
			</div>
			<?php do_action( 'bp_after_sidebar_me' ) ?>
	
			<?php if ( function_exists( 'bp_message_get_notices' ) ) : ?>
				<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
			<?php endif; ?>
	
		<?php else : ?>
	
			<?php do_action( 'bp_before_sidebar_login_form' ) ?>
			<div class="widget">
			<p id="login-text">
			<?php if(!$cap->bp_login_sidebar_text) { ?>
				<?php _e( 'To start connecting please log in first.', 'buddypress' ) ?>
			<?php } else { ?>
				<?php echo $cap->bp_login_sidebar_text; ?>
			<?php } ?>
				<?php if ( bp_get_signup_allowed() ) : ?>
					<?php printf( __( ' You can also <a href="%s" title="Create an account">create an account</a>.', 'buddypress' ), site_url( BP_REGISTER_SLUG . '/' ) ) ?>
				<?php endif; ?>
			</p>
	
			<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
				<label><?php _e( 'Username', 'buddypress' ) ?><br />
				<input type="text" name="log" id="sidebar-user-login" class="input" value="<?php echo esc_attr(stripslashes($user_login)); ?>" /></label>
	
				<label><?php _e( 'Password', 'buddypress' ) ?><br />
				<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" /></label>
	
				<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></p>
	
				<?php do_action( 'bp_sidebar_login_form' ) ?>
				<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e('Log In','buddypress'); ?>" tabindex="100" />
				<input type="hidden" name="testcookie" value="1" />
			</form>
			</div>
			<?php do_action( 'bp_after_sidebar_login_form' ) ?>
		<?php endif; ?>
<?php } ?>
<?php if(defined('BP_VERSION')){ 
	if ( function_exists('cc_login_widget') )
	    wp_register_sidebar_widget( 'cc_login_widget', 'BP Sidebar Login', 'cc_login_widget', '' );
}

function forum_tags_widget(){
 /* Show forum tags on the forums directory */
	if ( BP_FORUMS_SLUG == bp_current_component() && bp_is_directory() ) : ?>
		<div id="forum-directory-tags" class="widget tags">

			<h3 class="widgettitle"><?php _e( 'Forum Topic Tags', 'buddypress' ) ?></h3>
			<?php if ( function_exists('bp_forums_tag_heat_map') ) : ?>
				<div id="tag-text"><?php bp_forums_tag_heat_map(); ?></div>
			<?php endif; ?>
		</div>
<?php
	endif; 
}

function groups_header_widget($args) {
  extract($args);

  $options = get_option("groups_header_position");
  if (!is_array( $options )) {
    $options = array(
      'groups_header_position' => 'horizontal'
    );
  }

  if($options[groups_header_position] != 'horizontal') {
    cc_groups_sidebar();
  } else {
    if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group();
        cc_groups_header();
    endwhile; endif;
  }
}

function groups_header_control() {
  $options = get_option("groups_header_position");
  if (!is_array( $options )) {
    $options = array(
      'groups_header_position' => 'horizontal'
     );
  }

  if ($_POST['groups_header_submit']){
    $options['groups_header_position'] = htmlspecialchars($_POST['groups_header_position']);
    update_option("groups_header_position", $options);
  }?>
  <p>
    <label for="groups_header_position">Widget Position: </label><br />
    Horizontal: <input type="radio" name="groups_header_position" value="horizontal" <?php if($options['groups_header_position'] == 'horizontal'){ ?> checked="checked" <?php } ?> /><br />
    Vertical: <input type="radio" name="groups_header_position" value="vertical" <?php if($options['groups_header_position'] == 'vertical'){ ?> checked="checked" <?php } ?> /><br />
    <input type="hidden" id="groups_header_submit" name="groups_header_submit" value="1" />
  </p>
<?php
}

function profiles_header_widget($args) {
  extract($args);

  $options = get_option("profiles_header_position");
  if (!is_array( $options )) {
    $options = array(
      'profiles_header_position' => 'horizontal'
    );
  }

  if($options[profiles_header_position] != 'horizontal') {
    cc_profiles_sidebar();
  } else {
    if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group();
        cc_profiles_header();
    endwhile; endif;
  }
}

function profiles_header_control() {
  $options = get_option("profiles_header_position");
  if (!is_array( $options )) {
    $options = array(
      'profiles_header_position' => 'horizontal'
     );
  }

  if ($_POST['profiles_header_submit']){
    $options['profiles_header_position'] = htmlspecialchars($_POST['profiles_header_position']);
    update_option("profiles_header_position", $options);
  }?>
  <p>
    <label for="profiles_header_position">Widget Position: </label><br />
    Horizontal: <input type="radio" name="profiles_header_position" value="horizontal" <?php if($options['profiles_header_position'] == 'horizontal'){ ?> checked="checked" <?php } ?> /><br />
    Vertical: <input type="radio" name="profiles_header_position" value="vertical" <?php if($options['profiles_header_position'] == 'vertical'){ ?> checked="checked" <?php } ?> /><br />
    <input type="hidden" id="profiles_header_submit" name="profiles_header_submit" value="1" />
  </p>	
<?php
}

if(defined('BP_VERSION')){ 
    if ( function_exists('groups_header_widget') )
        wp_register_sidebar_widget( 'groups_header_widget', 'Groups Header Widget', 'groups_header_widget');
        wp_register_widget_control( 'groups_header_widget', 'Groups Header Control', 'groups_header_control', '' );
    
    if ( function_exists('profiles_header_widget') )
        wp_register_sidebar_widget( 'profiles_header_widget','Profiles Header Widget', 'profiles_header_widget');
        wp_register_widget_control( 'profiles_header_widget', 'Profiles Header Control', 'profiles_header_control', '' );
        

    if ( function_exists('forum_tags_widget') )
	    wp_register_sidebar_widget( 'forum_tags_widget', 'Forum Tags', 'forum_tags_widget', '' );
}
?>