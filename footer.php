
		</div> <!-- #container -->

		<?php do_action( 'bp_after_container' ) ?>
		<?php do_action( 'bp_before_footer' ) ?>

		<div id="footer">
		<?php global $cap; ?>
		<?php if($cap->disable_widgets_footer != false ){ ?>
			<div id="sidebar" class="cc-widget">
				<?php if( ! dynamic_sidebar( 'footer left' )) : ?>
		  		<?php endif ?> 
		  	</div>
	  		<div id="sidebar" class="cc-widget">
				<?php if( ! dynamic_sidebar( 'footer center' )) : ?>
		  		<?php endif ?> 
		  	</div>
	  		<div id="sidebar" class="cc-widget cc-widget-right">
				<?php if( ! dynamic_sidebar( 'footer right' )) : ?>
		  		<?php endif ?> 
		  	</div><div class="clear"></div>
		  	<br></br>
		<?php } ?>
		<br>
			<p>Kindly supported by <a href="http://themekraft.com" target="_blank" title="Themes and Plugins for Wordpress and Buddypress" alt="Themes and Plugins for Wordpress and Buddypress">Themekraft</a>. Build by <a href="http://sven-lehnert.de/en" target="_blank" title="Wordpress/Buddypress Theme Developer Sven Lehnert" alt="Wordpress/Buddypress Theme Developer Sven Lehnert">Wordpress Developer</a> Sven Lehnert and <a href="http://konradsroka.com" target="_blank" title="Wordpress/Buddypress Theme Designer Konrad Sroka" alt="Wordpress/Buddypress Theme Designer Konrad Sroka">Wordpress Designer</a> Konrad Sroka</p>
			<p><?php printf( __( '%s is proudly powered by <a href="http://wordpress.org">WordPress</a> and <a href="http://buddypress.org">BuddyPress</a>', 'buddypress' ), bloginfo('name') ); ?></p>
			<?php do_action( 'bp_footer' ) ?>
			<br>
		</div><!-- #footer -->

		<?php do_action( 'bp_after_footer' ) ?>


		</div>
	</div>
	<?php wp_footer(); ?>
	</body>
</html>