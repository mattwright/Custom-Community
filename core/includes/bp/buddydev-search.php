<?php
if($cap->buddydev_search == true){
	if(defined('BP_VERSION')) {
	
		/* Add these code to your cunctions.php to allow Single Search page for all buddypress components*/
		//	Remove Buddypress search drowpdown for selecting members etc
		add_filter("bp_search_form_type_select", "cc_remove_search_dropdown"  );
		function cc_remove_search_dropdown($select_html){
		    return '';
		}
		
		remove_action( 'init', 'bp_core_action_search_site', 5 );//force buddypress to not process the search/redirect
		add_action( 'init', 'cc_bp_buddydev_search', 10 );// custom handler for the search
		
		function cc_bp_buddydev_search(){
		global $bp;
			if ( $bp->current_component == BP_SEARCH_SLUG )//if thids is search page
				bp_core_load_template( apply_filters( 'bp_core_template_search_template', 'search-single' ) );//load the single searh template
		}
		add_action("advance-search","cc_show_search_results",1);//highest priority
		
		/* we just need to filter the query and change search_term=The search text*/
		function cc_show_search_results(){
		    //filter the ajaxquerystring
		     add_filter("bp_ajax_querystring","cc_global_search_qs",100,2);
		}
		
		//show the search results for member*/
		function cc_show_member_search(){
		    ?>
		   <div class="memberss-search-result search-result">
		   <h2 class="content-title"><?php _e("Members Results","buddypress");?></h2>
		  <?php locate_template( array( 'members/members-loop.php' ), true ) ;  ?>
		  <?php global $members_template;
			if($members_template->total_member_count>1):?>
				<a href="<?php echo bp_get_root_domain().'/'.BP_MEMBERS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e(sprintf("View all %d matched Members",$members_template->total_member_count),"buddypress");?></a>
			<?php 	endif; ?>
		</div>
		<?php	
		 }
		
		//Hook Member results to search page
		add_action("advance-search","cc_show_member_search",10); //the priority defines where in page this result will show up(the order of member search in other searchs)
		function cc_show_groups_search(){
		    ?>
		<div class="groups-search-result search-result">
		 	<h2 class="content-title"><?php _e("Group Search","buddypress");?></h2>
			<?php locate_template( array('groups/groups-loop.php' ), true ) ;  ?>
			
			<a href="<?php echo bp_get_root_domain().'/'.BP_GROUPS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched Groups","buddypress");?></a>
		</div>
			<?php
		 //endif;
		  }
		
		//Hook Groups results to search page
		 if(bp_is_active( 'groups' ))
		    add_action("advance-search","cc_show_groups_search",10);
		
		/**
		 *
		 * Show blog posts in search
		 */
		function cc_show_site_blog_search(){
		    ?>
		 <div class="blog-search-result search-result">
		 
		  <h2 class="content-title"><?php _e("Blog Search","buddypress");?></h2>
		   
		   <?php locate_template( array( 'search-loop.php' ), true ) ;  ?>
		   <a href="<?php echo bp_get_root_domain().'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched Posts","buddypress");?></a>
		</div>
		   <?php
		  }
		
		//Hook Blog Post results to search page
		 add_action("advance-search","cc_show_site_blog_search",10);
		
		//show forums search
		function cc_show_forums_search(){
		    ?>
		 <div class="forums-search-result search-result">
		   <h2 class="content-title"><?php _e("Forums Search","buddypress");?></h2>
		  <?php locate_template( array( 'forums/forums-loop.php' ), true ) ;  ?>
		  <a href="<?php echo bp_get_root_domain().'/'.BP_FORUMS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched forum posts","buddypress");?></a>
		</div>
		  <?php
		  }
		
		//Hook Forums results to search page
		if ( bp_is_active( 'forums' ) && bp_is_active( 'groups' ) && ( function_exists( 'bp_forums_is_installed_correctly' ) && !(int) bp_get_option( 'bp-disable-forum-directory' ) ) && bp_forums_is_installed_correctly() )
		 add_action("advance-search","cc_show_forums_search",20);
		
		
		//show blogs search result
		
		function cc_show_blogs_search(){
		
		    ?>
		  <div class="blogs-search-result search-result">
		  <h2 class="content-title"><?php _e("Blogs Search","buddypress");?></h2>
		  <?php locate_template( array( 'blogs/blogs-loop.php' ), true ) ;  ?>
		  <a href="<?php echo bp_get_root_domain().'/'.BP_BLOGS_SLUG.'/?s='.$_REQUEST['search-terms']?>" ><?php _e("View All matched Blogs","buddypress");?></a>
		 </div>
		  <?php
		  }
		
		//Hook Blogs results to search page if blogs comonent is active
		 if(bp_is_active( 'blogs' ))
		    add_action("advance-search","cc_show_blogs_search",10);
		
		
		 //modify the query string with the search term
		function cc_global_search_qs(){
			return "search_terms=".$_REQUEST['search-terms'];
		}
		
		function cc_is_advance_search(){
		global $bp;
		if($bp->current_component == BP_SEARCH_SLUG)
			return true;
		return false;
		}
		
	}
}
?>