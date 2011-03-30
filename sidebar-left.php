<?php do_action( 'bp_before_sidebar' ) ?>

<div id="leftsidebar">
  <div class="paddersidebar">
  <?php if(defined('BP_VERSION')){ ?>
  		<?php if( ! dynamic_sidebar( 'leftsidebar' )) : ?>    
			<?php widget_community_nav() ?>
		<?php endif; // end primary widget area ?>
	<?php } else {?>
  		<?php if( ! dynamic_sidebar( 'leftsidebar' )) : ?>
  		<?php endif ?>  
	<?php } ?>
  </div><!-- #padder -->	
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ) ?>
