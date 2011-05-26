<?php get_header() ?>
<?php global $cap; ?>

<?php if($cap->bp_groups_sidebars == ""){
	$cap->bp_groups_sidebars = 'default';
}?>
<?php if($cap->bp_groups_sidebars != 'none'){?>

	<?php if($cap->bg_container_img == "" && $cap->bp_groups_sidebars != "default"){ ?>
		<style type="text/css">
			div#container { 
				background-image:url(<?php echo get_template_directory_uri(); ?>/images/<?php 
					color_scheme();?>/<?php  
					switch ($cap->bp_groups_sidebars) 
					{
					    case 'left': echo "zeile-left.png"; $cssmargin = "margin-left: 224px; margin-right: 0;"; break;
					    case 'right': echo "zeile-right.png"; $cssmargin = "margin-left: 0; margin-right: 225px;"; break;
					    case 'left and right': echo "zeile.png"; $cssmargin = "margin-left: 224px; margin-right: 225px;"; break;
					}
					?>);
			}
			div#content .padder{
			<?php echo $cssmargin; ?>
			}
			
		</style>
	<?php } ?>
	<?php if($cap->bp_groups_sidebars == 'default'){?>
		<?php if($cap->sidebar_position == ""){ $cap->sidebar_position = "left and right"; }?>
		<?php if($cap->sidebar_position == "left" || $cap->sidebar_position == "left and right"){?>
			<?php locate_template( array( 'sidebar-left.php' ), true ) ?>
		<?php };?>
	<?php } else {?>
		<?php if($cap->bp_groups_sidebars == 'left' || $cap->bp_groups_sidebars == 'left and right' ):?>
			<?php locate_template( array( 'groups/single/group-sidebar-left.php' ), true );?>
		<?php endif;?>
	<?php }?>
<?php } else {?>
	<style type="text/css">
	#container { background-image:none !important; }
	div#content .padder { margin: 0; }
	</style>
<?php } ?>

<div id="content">
	<div class="padder">
		<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

		<?php do_action( 'bp_before_group_plugin_template' ) ?>
		<?php if( $cap->bp_groups_header == false || $cap->bp_groups_header == 'on'):?>
		<div id="item-header">
			<?php locate_template( array( 'groups/single/group-header.php' ), true ) ?>
		</div>
		<?php else:?>
		<div id="item-header">
			<h2><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></h2>
		</div>
		<?php endif;?>

		<?php if($cap->bp_default_navigation == true){?>
			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_options_nav() ?>
			
						<?php do_action( 'bp_group_plugin_options_nav' ) ?>
					</ul>
				</div>
			</div><!-- #item-nav -->
		<?php } ?>

		<div id="item-body">
			<?php do_action( 'bp_template_content' ) ?>
		</div><!-- #item-body -->

		<?php endwhile; endif; ?>

		<?php do_action( 'bp_after_group_plugin_template' ) ?>

	</div><!-- .padder -->
</div><!-- #content -->

<?php if($cap->bp_groups_sidebars != 'none'){?>
	<?php if($cap->bp_groups_sidebars == 'default'){?>
		<?php if($cap->sidebar_position == "right" || $cap->sidebar_position == "left and right"){?>
			<?php locate_template( array( 'sidebar.php' ), true ) ?>
		<?php };?>
	<?php } else {?>
		<?php if($cap->bp_groups_sidebars == 'right' || $cap->bp_groups_sidebars == 'left and right' ):?>	
			<?php locate_template( array( 'groups/single/group-sidebar-right.php' ), true );?>
		<?php endif;?>
	<?php } ?>
<?php } ?>
<?php get_footer() ?>