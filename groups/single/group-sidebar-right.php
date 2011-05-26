<?php do_action( 'bp_before_sidebar' ) ?>
	<div id="sidebar" class="widgetarea">
	<div class="right-sidebar-padder">
	<?php if( ! dynamic_sidebar( 'groupsidebarright' )) : cc_groups_sidebar(); ?>
	
	<?php endif ?>
  </div><!-- #padder -->	
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ) ?>
