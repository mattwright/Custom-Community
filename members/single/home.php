<?php get_header() ?>
<?php global $cap; ?>

<?php if($cap->bp_profile_sidebars == ""){
	$cap->bp_profile_sidebars = 'default';
}?>
<?php if($cap->bp_profile_sidebars != 'none'){?>

	<?php if($cap->bg_container_img == "" && $cap->bp_profile_sidebars != "default"){ ?>
		<style type="text/css">
			div#container { 
				background-image:url(<?php echo get_template_directory_uri(); ?>/images/<?php 
					color_scheme();?>/<?php  
					switch ($cap->bp_profile_sidebars) 
					{
					    case 'left': echo "zeile-left.png"; $cssmargin = "margin-left: 224px; margin-right: 0;"; break;
					    case 'right': echo "zeile-right.png"; $cssmargin = "margin-left: 0; margin-right: 225px;"; break;
					    case 'left and right': echo "zeile.png"; $cssmargin = "margin-left: 224px; margin-right: 225px;"; break;
					}
					?>);
			}
			div#content .padder{
			<?php echo $cssmargin; ?>
			}
			
		</style>
	<?php } ?>
	<?php if($cap->bp_profile_sidebars == 'default'){?>
		<?php if($cap->sidebar_position == ""){ $cap->sidebar_position = "left and right"; }?>
		<?php if($cap->sidebar_position == "left" || $cap->sidebar_position == "left and right"){?>
			<?php locate_template( array( 'sidebar-left.php' ), true ) ?>
		<?php };?>
	<?php } else {?>
		<?php if($cap->bp_profile_sidebars == 'left' || $cap->bp_profile_sidebars == 'left and right' ):?>
			<?php locate_template( array( 'members/single/member-sidebar-left.php' ), true );?>
		<?php endif;?>
	<?php }?>
<?php } else {?>
	<style type="text/css">
	#container { background-image:none !important; }
	div#content .padder { margin: 0; }
	</style>
<?php } ?>


	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_member_home_content' ) ?>
			
		<?php if($cap->bp_profile_header == false || $cap->bp_profile_header == 'on'):?>
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
			<?php } ?>
			
			<div id="item-body">
				<?php do_action( 'bp_before_member_body' ) ?>

				<?php if ( bp_is_user_activity() || !bp_current_component() ) : ?>
					<?php locate_template( array( 'members/single/activity.php' ), true ) ?>

				<?php elseif ( bp_is_user_blogs() ) : ?>
					<?php locate_template( array( 'members/single/blogs.php' ), true ) ?>

				<?php elseif ( bp_is_user_friends() ) : ?>
					<?php locate_template( array( 'members/single/friends.php' ), true ) ?>

				<?php elseif ( bp_is_user_groups() ) : ?>
					<?php locate_template( array( 'members/single/groups.php' ), true ) ?>

				<?php elseif ( bp_is_user_messages() ) : ?>
					<?php locate_template( array( 'members/single/messages.php' ), true ) ?>

				<?php elseif ( bp_is_user_profile() ) : ?>
					<?php locate_template( array( 'members/single/profile.php' ), true ) ?>

				<?php endif; ?>

				<?php do_action( 'bp_after_member_body' ) ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_home_content' ) ?>

		</div><!-- .padder -->
	</div><!-- #content -->
	
<?php if($cap->bp_profile_sidebars != 'none'){?>
	<?php if($cap->bp_profile_sidebars == 'default'){?>
		<?php if($cap->sidebar_position == "right" || $cap->sidebar_position == "left and right"){?>
			<?php locate_template( array( 'sidebar.php' ), true ) ?>
		<?php };?>
	<?php } else {?>
		<?php if($cap->bp_profile_sidebars == 'right' || $cap->bp_profile_sidebars == 'left and right' ):?>	
			<?php locate_template( array( 'members/single/member-sidebar-right.php' ), true );?>
		<?php endif;?>
	<?php } ?>
<?php } ?>
<?php get_footer() ?>