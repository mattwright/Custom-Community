<?php do_action( 'bp_before_sidebar' ) ?>

<div id="sidebar" class="widgetarea">
	<div class="right-sidebar-padder">
	<?php if( ! dynamic_sidebar( 'membersidebarright' )) : ?>		
		<?php cc_profiles_sidebar(); ?>
	<?php endif ?>
  </div><!-- #padder -->	
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ) ?>
