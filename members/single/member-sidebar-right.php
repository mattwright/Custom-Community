<?php do_action( 'bp_before_sidebar' ) ?>
<div class="v_line v_line_right"></div>
<div id="sidebar" class="widgetarea">
	<div class="right-sidebar-padder">
	<?php if( ! dynamic_sidebar( 'membersidebarright' )) : ?>		
		<?php cc_profiles_sidebar(); ?>
	<?php endif ?>
  </div><!-- #padder -->	
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ) ?>
