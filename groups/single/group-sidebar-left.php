<?php do_action( 'bp_before_sidebar' ) ?>

<div id="leftsidebar">
  <div class="paddersidebar">
  	<?php if( ! dynamic_sidebar( 'groupsidebarleft' )) : cc_groups_sidebar(); ?>
  
	<?php endif;?>
  </div><!-- #padder -->	
</div><!-- #sidebar -->
<div class="v_line v_line_left"></div>
<?php do_action( 'bp_after_sidebar' ) ?>
