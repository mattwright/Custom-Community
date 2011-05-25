<?php
/*
Template Name: Links
*/
?>

<?php get_header() ?>
<?php global $cap; ?>
<?php if($cap->sidebar_position == ""){ $cap->sidebar_position = "left and right"; }?>
<?php if($cap->sidebar_position == "left" || $cap->sidebar_position == "left and right"){?>
	<?php locate_template( array( 'sidebar-left.php' ), true ) ?>
<?php };?>

	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_blog_links' ) ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<h2 class="pagetitle"><?php _e( 'Links', 'buddypress' ) ?></h2>

			<ul id="links-list">
				<?php wp_list_bookmarks(); ?>
			</ul>

		</div>

		<?php do_action( 'bp_after_blog_links' ) ?>

		</div>
	</div>
	
<?php if($cap->sidebar_position == "right" || $cap->sidebar_position == "left and right"){?>
		<?php locate_template( array( 'sidebar.php' ), true ) ?>
<?php };?>

<?php get_footer(); ?>
