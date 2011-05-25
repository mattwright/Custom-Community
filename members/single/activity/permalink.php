<?php get_header() ?>
<?php global $cap; ?>
<?php if($cap->sidebar_position == ""){ $cap->sidebar_position = "left and right"; }?>
<?php if($cap->sidebar_position == "left" || $cap->sidebar_position == "left and right"){?>
	<?php locate_template( array( 'sidebar-left.php' ), true ) ?>
<?php };?>
  <div id="content">
  		<div class="padder">
          <div class="activity no-ajax">
          	<?php if ( bp_has_activities( 'display_comments=threaded&include=' . bp_current_action() ) ) : ?>
          		<ul id="activity-stream" class="activity-list item-list">
          		<?php while ( bp_activities() ) : bp_the_activity(); ?>
          			<?php locate_template( array( 'activity/entry.php' ), true ) ?>
          		<?php endwhile; ?>
          		</ul>
          	<?php endif; ?>
          </div>
    </div>
 </div>
<?php if($cap->sidebar_position == "right" || $cap->sidebar_position == "left and right"){?>
		<?php locate_template( array( 'sidebar.php' ), true ) ?>
<?php };?>
<?php get_footer() ?>