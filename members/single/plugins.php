<?php get_header() ?>

	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_member_plugin_template' ) ?>

			<div id="item-header">
				<?php locate_template( array( 'members/single/member-header.php' ), true ) ?>
			</div>
			<?php global $cap; if($cap->bp_default_navigation == true){  ?>
			
			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_displayed_user_nav() ?>
			
						<?php do_action( 'bp_member_options_nav' ) ?>
					</ul>
				</div>
			</div><!-- #item-nav -->
			<?php } ?>
			



			<div id="item-body">

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul>
						<?php bp_get_options_nav() ?>

						<?php do_action( 'bp_member_plugin_options_nav' ) ?>
					</ul>
				</div>

				<?php do_action( 'bp_template_content' ) ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_plugin_template' ) ?>

		</div><!-- .padder -->
	</div><!-- #content -->
<?php global $cap; if($cap->sidebar_position == "right" || $cap->sidebar_position == "left and right"){?>
		<?php locate_template( array( 'sidebar.php' ), true ) ?>
<?php };?>
	<?php do_action( 'bp_after_member_plugin_template' ) ?>

<?php get_footer() ?>