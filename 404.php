<?php get_header(); ?>
<?php global $cap; ?>
<?php if($cap->sidebar_position == ""){ $cap->sidebar_position = "left and right"; }?>
<?php if($cap->sidebar_position == "left" || $cap->sidebar_position == "left and right"){?>
	<?php locate_template( array( 'sidebar-left.php' ), true ) ?>
<?php };?>
	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_404' ) ?>

		<div class="error404 not-found page">

			<h2 class="pagetitle"><?php _e( 'Page Not Found', 'buddypress' ) ?></h2>

			<div id="message" class="info">

				<p><?php _e( 'The page you were looking for was not found.', 'buddypress' ) ?>

			</div>

			<?php do_action( 'bp_404' ) ?>

		</div>

		<?php do_action( 'bp_after_404' ) ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php global $cap; if($cap->sidebar_position == "right" || $cap->sidebar_position == "left and right"){?>
		<?php locate_template( array( 'sidebar.php' ), true ) ?>
<?php };?>

<?php get_footer(); ?>