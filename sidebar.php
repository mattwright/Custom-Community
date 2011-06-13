<?php do_action( 'bp_before_sidebar' ) ?>
<div class="v_line v_line_right"></div>
<div id="sidebar" class="widgetarea">
	<div class="right-sidebar-padder">

	<?php do_action( 'bp_before_after_sidebar' ) ?>
	<?php global $cap;?>
	<?php if( ! dynamic_sidebar( 'sidebar' )): ?>    
	<?php if(defined('BP_VERSION')) { if($cap->login_sidebar != 'off' || $cap->login_sidebar == false){ cc_login_widget();}} ?>
	<?php endif; // end primary widget area ?>
	
	
	<?php do_action( 'bp_inside_after_sidebar' ) ?>

	</div><!-- .padder -->
</div><!-- #sidebar -->


<?php do_action( 'bp_after_sidebar' ) ?>