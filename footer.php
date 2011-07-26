
		</div> <!-- #container -->		

		<?php do_action( 'bp_after_container' ) ?>
		
		<?php do_action( 'bp_before_footer' ) ?>
		
		<?php global $cap; ?>
		<?php $close_innerrim = '</div><!-- #innerrim -->'; ?>
    	<?php if ($cap->footer_width == "full-width") { echo $close_innerrim; }?>
		
		<div id="footer">
		
			<?php if( ! dynamic_sidebar( 'footerfullwidth' )) :?>
				<?php if($cap->preview == true){ ?>
					<div class="widget" style="margin-bottom: 0; padding: 12px; border: 1px solid #dddddd;">
							<h3 class="widgettitle" ><?php _e('35 widget areas all over the site', 'buddypress'); ?></h3>
							<div><p style="font-size: 16px; line-height:170%;">4 header + 4 footer widget areas: 2 full width and 6 columns. <br>
							6 widget areas for members + 6 for groups. 15 shortcode widget areas to place anywhere on your site!
							</p></div>
					
					</div>
				<?php } ?>	
			<?php endif; ?>
		
			<?php  if (is_active_sidebar('footerleft') || $cap->preview == true ){ ?>
			<div class="widgetarea cc-widget">
				<?php if( ! dynamic_sidebar( 'footerleft' )){ ?>
					<div class="widget">
						<h3 class="widgettitle" ><?php _e('Links', 'buddypress'); ?></h3>
						<ul>
							<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
						</ul>
					</div>
				<?php } ?>
		  	</div>
			<?php  } ?>
	  	
	  		<?php if (is_active_sidebar('footercenter') || $cap->preview == true){ ?>
			<div <?php if(!is_active_sidebar('footerleft') && $cap->preview != true ) { echo 'style="margin-left: 34% !important;"'; } ?> class="widgetarea cc-widget">
				<?php if( ! dynamic_sidebar( 'footercenter' )){ ?>
					<div class="widget">
						<h3 class="widgettitle" ><?php _e('Archives', 'buddypress'); ?></h3>
						<ul>
							<?php wp_get_archives( 'type=monthly' ); ?>
						</ul>
					</div>				
				<?php } ?>
		  	</div>
	  		<?php } ?>
	  	
	  		<?php if (is_active_sidebar('footerright') || $cap->preview == true ){ ?>
			<div class="widgetarea cc-widget cc-widget-right">
				<?php if( ! dynamic_sidebar( 'footerright' )){ ?>
					<div class="widget">
						<h3 class="widgettitle" ><?php _e('Meta', 'buddypress'); ?></h3>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</div>
				<?php } ?>
		  	</div>
		  	<?php } ?>
	  	
	  		<div class="clear"></div>
		  	<br />
			<br />
			<div class="credits"><?php printf( __( '%s is proudly powered by <a class="credits" href="http://wordpress.org">WordPress</a> and <a class="credits" href="http://buddypress.org">BuddyPress</a>. ', 'buddypress' ), bloginfo('name') ); ?>
			Just another <a class="credits" href="http://themekraft.com/all-themes/" target="_blank" title="Wordpress Theme" alt="WordPress Theme">WordPress Theme</a> developed by Themekraft.</div>
		
			<?php do_action( 'bp_footer' ) ?>
			<br />
		</div><!-- #footer -->

		<?php do_action( 'bp_after_footer' ) ?>


		<?php if ($cap->footer_width == "default") { echo $close_innerrim; }?>
	</div><!-- #outerrim -->
	<?php wp_footer(); ?>
	</body>
</html>