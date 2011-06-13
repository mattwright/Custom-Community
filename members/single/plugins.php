<?php get_header() ?>
<?php global $cap; ?>

<?php if($cap->bp_profile_sidebars == ""){
	$cap->bp_profile_sidebars = 'default';
}?>
<?php if($cap->bp_profile_sidebars != 'none'){ ?>

	<?php if($cap->bp_profile_sidebars != "default"){ 
	// correct the margin of the content if the sidebars for profiles 
	// are set to something else than default 

		switch ($cap->bp_profile_sidebars) 
		{
		    case 'left': $cssmargin = "margin-left: 224px; margin-right: 0;"; break;
		    case 'right': $cssmargin = "margin-left: 0; margin-right: 225px;"; break;
		    case 'left and right': $cssmargin = "margin-left: 224px; margin-right: 225px;"; break;
		} ?>
		
		<style type="text/css">
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
<?php } else { // <!-- what means if bp_profile_sidebars is = "none" --> ?>

	<style type="text/css">
		
	<?php if ( $cap->bg_container_img == "" ) { 	// check if a custiom image is selected for the container else display no container image by default (the vertical lines) ?>	
	#container { background-image: none; background-image: none !important; }	
	<?php } ?>
	
	div#content .padder { margin-left: 0; margin-right: 0; }
	</style>

<?php } ?>



	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_member_plugin_template' ) ?>

		<?php if($cap->bp_profile_header == 'on'):?>
			<div id="item-header">
					<?php locate_template( array( 'members/single/member-header.php' ), true ) ?>
			</div>
		<?php else:?>
			<div id="item-header">
					<h2 class="fn"><a href="<?php bp_user_link() ?>"><?php bp_displayed_user_fullname() ?></a> <span class="highlight">@<?php bp_displayed_user_username() ?> <span>?</span></span></h2>
			</div>
		<?php endif;?>
		
			<?php if($cap->bp_default_navigation == true){  ?>
			
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

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul>
						<?php bp_get_options_nav() ?>

						<?php do_action( 'bp_member_plugin_options_nav' ) ?>
					</ul>
				</div>

				<?php do_action( 'bp_template_content' ) ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_plugin_template' ) ?>

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