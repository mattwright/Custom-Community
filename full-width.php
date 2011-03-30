<?php 
/*
 * Template Name: Full Width 
 */
?>
<?php get_header() ?>
<?php global $cap; ?>

	<style type="text/css">
	#container { background-image:none !important; }
	div#content .padder { margin: 0; }
	</style>

	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_blog_page' ) ?>

		<div class="page" id="blog-page">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h2 class="pagetitle"><?php the_title(); ?></h2>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry">

						<?php the_content( __( '<p class="serif">Read the rest of this page &rarr;</p>', 'buddypress' ) ); ?>

						<?php wp_link_pages( array( 'before' => __( '<p><strong>Pages:</strong> ', 'buddypress' ), 'after' => '</p>', 'next_or_number' => 'number')); ?>
						

					</div>

				</div>

			<?php endwhile; endif; ?>

		</div><!-- .page -->
		<?php cc_list_posts_on_page(); ?> 
			<div class="clear"></div>
		<?php do_action( 'bp_after_blog_page' ) ?>
		<?php edit_post_link( __( 'Edit this entry.', 'buddypress' ), '<p>', '</p>'); ?>
		<?php comments_template(); ?>
		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_footer(); ?>
