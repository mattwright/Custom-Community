
		</div> <!-- #container -->		

		<?php do_action( 'bp_after_container' ) ?>
		
		<?php do_action( 'bp_before_footer' ) ?>
		
		<?php global $cap; ?>
		<?php $close_innerrim = '</div><!-- #innerrim -->'; ?>
    	<?php if ($cap->footer_width == "full-width") { echo $close_innerrim; }?>
		
		<div id="footer">
		<?php global $cap; ?>
		
			<?php if( ! dynamic_sidebar( 'footerfullwidth' )) :?>
			 
			<?php endif; ?>
		
			<?php if (is_active_sidebar('footerleft') ){ ?>
			<div class="widgetarea cc-widget">
				<?php dynamic_sidebar( 'footerleft' )?>
		  	</div>
			<?php } ?>
	  	
	  		<?php if (is_active_sidebar('footercenter') ){ ?>
			<div <?php if(!is_active_sidebar('footerleft')) { echo 'style="margin-left: 34% !important;"'; } ?> class="widgetarea cc-widget">
				<?php dynamic_sidebar( 'footercenter' ) ?>
		  	</div>
	  		<?php } ?>
	  	
	  		<?php if (is_active_sidebar('footerright') ){ ?>
			<div class="widgetarea cc-widget cc-widget-right">
				<?php dynamic_sidebar( 'footerright' ) ?>
		  	</div>
		  	<?php } ?>
	  	
	  		<div class="clear"></div>
		  	<br />
			<br />
			<p><?php printf( __( '%s is proudly powered by <a href="http://wordpress.org">WordPress</a> and <a href="http://buddypress.org">BuddyPress</a>. ', 'buddypress' ), bloginfo('name') ); ?>
			<a href="http://themekraft.com/all-themes/" target="_blank" title="Wordpress Theme" alt="WordPress Theme">WordPress Theme</a> developed by Themekraft.</p>
		
			<?php do_action( 'bp_footer' ) ?>
			<br />
		</div><!-- #footer -->

		<?php do_action( 'bp_after_footer' ) ?>


		<?php if ($cap->footer_width == "default") { echo $close_innerrim; }?>
	</div><!-- #outerrim -->
	<?php wp_footer(); ?>
	</body>
</html>