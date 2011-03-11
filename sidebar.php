<?php do_action( 'bp_before_sidebar' ) ?>

<div id="sidebar">
	<div class="right-sidebar-padder">
	<?php 	global $cap; if($cap->login_sidebar != 'off'){ ?>
		<?php cc_login_widget();?>
	<?php } ?>
	<?php dynamic_sidebar( 'sidebar' ) ?>
	
	<?php do_action( 'bp_inside_after_sidebar' ) ?>

	</div><!-- .padder -->
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ) ?>