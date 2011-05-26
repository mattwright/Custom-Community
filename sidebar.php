<?php do_action( 'bp_before_sidebar' ) ?>

<div id="sidebar" class="widgetarea">
	<div class="right-sidebar-padder">

	<?php do_action( 'bp_before_after_sidebar' ) ?>
	<?php global $cap;?>
	<?php if(defined('BP_VERSION')) { if($cap->login_sidebar != 'off' || $cap->login_sidebar == false){ cc_login_widget();}} ?>
	<?php dynamic_sidebar( 'sidebar' ) ?>
	<?php do_action( 'bp_inside_after_sidebar' ) ?>

	</div><!-- .padder -->
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ) ?>