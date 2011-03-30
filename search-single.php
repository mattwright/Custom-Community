<?php get_header();?>
<?php global $cap; ?>
<?php if($cap->sidebar_position == ""){ $cap->sidebar_position = "left and right"; }?>
<?php if($cap->sidebar_position == "left" || $cap->sidebar_position == "left and right"){?>
	<?php locate_template( array( 'sidebar-left.php' ), true ) ?>
<?php };?>
	<div id="content">
		<div class="padder">
			<?php do_action("advance-search");//this is the only line you need?>
			<!-- let the search put the content here -->		                   
    </div> <!-- Contents ends here... --> 
 </div><!-- Container ends here... -->
<?php global $cap; if($cap->sidebar_position == "right" || $cap->sidebar_position == "left and right"){?>
		<?php locate_template( array( 'sidebar.php' ), true ) ?>
<?php };?>     
  <?php get_footer();?>