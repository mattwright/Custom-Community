<style>

/** ***   
sidebar amount and position  **/
div#content .padder {
<?php if($cap->sidebar_position == "right"){?>
	margin-left:0px;
<?php };?>
<?php if($cap->sidebar_position == "left"){?>
	margin-right:0px;
<?php };?>
} 


/** ***   
body background colour, image and repeat  **/

body {
<?php if($cap->bg_body_color){ ?>
	background-color: <?php if($cap->bg_body_color != 'transparent') { ?>#<?php } ?><?php echo $cap->bg_body_color?>;
<?php } ?>
<?php if($cap->bg_body_img){?>
	background-image:url('<?php echo $cap->bg_body_img?>');	
<?php } ?>
<?php 
		switch ($cap->bg_body_img_repeat)
        {
        case 'no repeat':
			?>background-repeat: no-repeat;<?php	
        	break;
        case 'x':
			?>background-repeat: repeat-x;<?php	
        	break;
        case 'y':
			?>background-repeat: repeat-y;<?php	
        	break;
        case 'x+y':
			?>background-repeat: repeat;<?php	
        	break;
        }
?>
} 


/** ***   
Adapting to body background colour  **/

div.item-list-tabs ul li.selected a, div.item-list-tabs ul li.current a, 
div.pagination, div#subnav.item-list-tabs, 
div#leftsidebar h3.widgettitle, div#sidebar h3.widgettitle, 
div#leftsidebar h3.widgettitle a, div#sidebar h3.widgettitle a, 
div#footer .cc-widget h3.widgettitle, div#footer .cc-widget h3.widgettitle a  { 
<?php if($cap->bg_body_color && $cap->bg_body_color != 'transparent'){?>
	background-color: #<?php echo $cap->bg_body_color?>;
<?php };?>
}

.boxgrid {
<?php if($cap->bg_body_color){?>
	border-color:<?php if($cap->bg_body_color != 'transparent') { ?>#<?php } ?><?php echo $cap->bg_body_color?>;
<?php };?>
}


/** ***   
container background colour, image, repeat, corner radius and line correction  **/

div#container, body.activity-permalink div#container {
<?php if($cap->bg_container_color ){?> 
	background-color: <?php if($cap->bg_container_color != 'transparent') { ?>#<?php } ?><?php echo $cap->bg_container_color;?>; 
<?php } ?>


background-image:url("<?php bloginfo('template_directory'); ?>/images/<?php color_scheme();?>/<?php  
	switch ($cap->sidebar_position) 
	{
	    case 'left': echo "zeile-left.png"; break;
	    case 'right': echo "zeile-right.png"; break;
	    case 'left and right': echo "zeile.png"; break;
	    default: echo "zeile.png"; break;
	} ?>"); 
}

/** ***   
adapting footer widgets to container background colour, image, repeat and corner radius **/


div#footer .cc-widget, #footer .cc-widget-right { 
<?php if($cap->bg_container_color && !$cap->bg_footer_color){ ?> 
	background-color: <?php if($cap->bg_container_color != 'transparent') { ?>#<?php } ?><?php echo $cap->bg_container_color;?> !important; 
<?php } ?>

}


/** ***   
footer - height, color, image and repeat  **/

#footer .cc-widget{
	<?php if($cap->bg_footer_color) { ?>
		background-color: <?php if($cap->bg_footer_color != 'transparent') { ?>#<?php } echo $cap->bg_footer_color;?> !important; 
	<?php } ?>
	<?php if($cap->footer_height) { ?>
		height:<?php echo $cap->footer_height; ?>px; 
	<?php } ?>
	}

/** ***   
Adapting buttons font color in the footer widgets. Either to footer background color or to container background colour  **/

#footer .cc-widget a.button { 
<?php if($cap->bg_footer_color != '' ||  $cap->bg_footer_color != 'transparent') { ?>
		color: #<?php echo $cap->bg_footer_color; ?> !important; 
	<?php } elseif ($cap->bg_container_color && $cap->bg_container_color != 'transparent') { ?>
		color: #<?php echo $cap->bg_container_color; ?> !important; 
	<?php } ?> 	
}


/** ***   
slideshow and other stuff that wants some BACKGROUND tweaking to container background colour  **/

#slider-top,  
div#subnav.item-list-tabs ul li.selected a, div#subnav.item-list-tabs ul li.current a {
<?php if($cap->bg_container_color ){ ?> 
	background-color: <?php if($cap->bg_container_color != 'transparent') { ?>#<?php } ?><?php echo $cap->bg_container_color;?>; 
<?php } ?> 
} 

/** ***   
buttons and widgets that want some FONT COLOR tweaking to the container background colour  **/ 

a.button, input[type="submit"], input[type="button"], ul.button-nav li a, div.generic-button a, 
.activity-list div.activity-meta a.acomment-reply, 
.activity-list div.activity-meta a, div.widget-title ul.item-list li.selected a, div.widget-title ul.item-list li.selected a:hover  {
<?php if($cap->bg_container_color && $cap->bg_container_color != 'transparent' ){?>
	color: #<?php echo $cap->bg_container_color?> !important;
<?php };?>
}

/** ***   
font colour  **/

body, p, em, div.post, div.post p.date, div.post p.postmetadata, div.comment-meta, div.comment-options, 
div#item-header div#item-meta, ul.item-list li div.item-title span, ul.item-list li div.item-desc, 
ul.item-list li div.meta, div.item-list-tabs ul li span, span.activity, div#message p, div.widget span.activity, 
div.pagination, div#message.updated p, #subnav a, div.widget-title ul.item-list li a, 
div.post h2.pagetitle a, div.post h2.posttitle a, div#item-header span.activity, div#item-header h2 span.highlight, 
form.standard-form input:focus, form.standard-form textarea:focus, form.standard-form select:focus, table tr td.label, 
table tr td.thread-info p.thread-excerpt, table.forum td p.topic-text, table.forum td.td-freshness, form#whats-new-form, 
form#whats-new-form h5, form#whats-new-form #whats-new-textarea, .activity-list li .activity-inreplyto, 
.activity-list .activity-content .activity-header, .activity-list .activity-content .comment-header, 
.activity-list .activity-content span.time-since, .activity-list .activity-content span.activity-header-meta a, 
.activity-list .activity-content .activity-inner, .activity-list .activity-content blockquote, 
.activity-list .activity-content .comment-header, .activity-header a:hover, div.activity-comments div.acomment-meta,  
div.activity-comments form .ac-textarea, div.activity-comments form textarea, div.activity-comments form div.ac-reply-content, 
li span.unread-count, tr.unread span.unread-count, div.item-list-tabs ul li a span.unread-count, ul#topic-post-list li div.poster-meta, 
div.admin-links, div.poster-name a, div.object-name a, div.post p.date a:hover, div.post p.postmetadata a:hover, div.comment-meta a:hover, div.comment-options a:hover, 
#comments h3, #trackbacks h3, #respond h3, #footer, div.widget ul li a, div.widget ul li.recentcomments a:hover, #footer a, 
div.widget_tag_cloud a, div#item-header span.activity, div#item-header h2 span.highlight, a:hover, a:active, .widget li.cat-item a, #item-nav a:hover {
<?php if($cap->font_color){?>
	color:#<?php echo $cap->font_color?>;
<?php };?>
} 
div#item-header h2 span.highlight, div.item-list-tabs ul li.selected a, div.item-list-tabs ul li.current a {
<?php if($cap->font_color){?>
	color:#<?php echo $cap->font_color?> !important;
<?php };?>
} 

/** ***   
buttons and widgets that want some adapting to the font colour  **/

a.button, input[type="submit"], input[type="button"], ul.button-nav li a, div.generic-button a, 
.activity-list div.activity-meta a  {
<?php if($cap->font_color){?>
	background:#<?php echo $cap->font_color?>;
<?php };?>
}  

div#leftsidebar h3.widgettitle, div#sidebar h3.widgettitle { 
<?php if($cap->font_color){?>
	color:#<?php echo $cap->font_color?>;
<?php };?>
}

/** ***   
title colour  **/

div.post h2.pagetitle a, div.post h2.posttitle a, 
h1, h2, div#item-header h2 a {
<?php if($cap->title_color){?>
	color:#<?php echo $cap->title_color?>;
<?php };?>

}

/** ***   
link colour  **/

a, div.post p.date a, div.post p.postmetadata a, div.comment-meta a, div.comment-options a,   
.activity-list .activity-header a:first-child, span.highlight, #item-nav a, div.widget ul li a:hover, 
#subnav a:hover, div.widget ul#blog-post-list li a, div.widget ul li.recentcomments a, div.widget_tag_cloud a:hover, 
.widget li.current-cat a, div.widget ul li.current_page_item a, 
#footer .widget li.current-cat a, #footer div.widget ul li.current_page_item a, #footer .widget ul li a:hover  {
<?php if($cap->link_color){?>
	color:#<?php echo $cap->link_color?>;
<?php };?>
}
div.widget-title ul.item-list li a:hover  {
	<?php if($cap->link_color){?>
		color:#<?php echo $cap->link_color?> !important;
	<?php };?>
}
<?php if($cap->link_color && !$cap->bg_container_color){?>
	div.widget-title ul.item-list li.selected a:hover {
		color:#<?php switch ($cap->style_css) {
		    	case 'dark': echo "181818"; break;
		    	case 'light': echo "cdcdcd"; break;
				}
?>  !important;
	}
<?php } ?> 


/** ***   
buttons and widgets that want some adapting to the link colour  **/

div.widget-title ul.item-list li.selected, 
a.button:focus, a.button:hover, input[type="submit"]:hover, input[type="button"]:hover, 
ul.button-nav li a:hover, div.generic-button a:hover, ul.button-nav li a:focus, div.generic-button a:focus, 
.activity-list div.activity-meta a.acomment-reply, 
div.activity-meta a.fav:hover, a.unfav:hover, div#item-header h2 span.highlight span {
<?php if($cap->link_color){?>
	background-color:#<?php echo $cap->link_color?> !important;
<?php };?> 
}


/** ***   
header height / navigation position **/

#access {
<?php if($cap->header_height){?>
	margin-top:<?php echo $cap->header_height; ?>px;
<?php };?>
}


/** ***   
header image, repeat  **/

#header {
		<?php if($cap->header_img){?>
			background-image:url('<?php echo $cap->header_img?>');	
		<?php } ?>
		<?php 
				switch ($cap->header_img_repeat)
		        {
		        case 'no repeat':
					?>background-repeat: no-repeat;<?php	
		        	break;
		        case 'x':
					?>background-repeat: repeat-x;<?php	
		        	break;
		        case 'y':
					?>background-repeat: repeat-y;<?php	
		        	break;
		        case 'x+y':
					?>background-repeat: repeat;<?php	
		        	break;
				default:
					?>background-repeat: no-repeat;<?php	
		        	break;
		        }
		?>
		<?php if($cap->header_img_x == 'center' ){?>
			background-position: center <?php if($cap->header_img_y){ echo $cap->header_img_y; } else { echo '0'; }?>px;
		<?php } elseif($cap->header_img_x == 'right' ){?>
			background-position: right <?php if($cap->header_img_y){ echo $cap->header_img_y; } else { echo '0'; }?>px;
		<?php }?>  
		<?php if((!$cap->header_img_x || $cap->header_img_x == 'left') && $cap->header_img_y){?>
			background-position: left <?php echo $cap->header_img_y ?>px;
		<?php } ?>
		}
			<?php if ( $cap->header_text == 'off' ) { ?>
				#header h1, #header #desc { 
					display: none; 
				}
			<?php } ?>
			<?php if ( $cap->header_text_color) { ?>
				#header h1 a, #desc { 
					color:#<?php echo $cap->header_text_color ?>; 
				}
			<?php } ?>
				


/** ***   
header search bar position  **/

#header #search-bar { 
<?php if($cap->searchbar_x == 'left'){?>
	left:0 !important; 
<?php };?>
<?php if($cap->searchbar_y){?>
	top:<?php echo $cap->searchbar_y; ?>px !important;
<?php };?>
}


/** ***   
menu x-position  **/

div.menu ul { 
<?php if($cap->menu_x == 'right'){?>
	float: right;
<?php };?>
}


/** ***   
menu font colour  **/

#access a, #access ul ul a, #access ul.children li.selected > a, 
#access li:hover > a, #access ul ul :hover > a, 
#access ul.children li:hover > a, #access ul.sub-menu li:hover > a, 
#access ul li.current_page_item > a, #access ul li.current-menu-ancestor > a, 
#access ul li.current-menu-item > a, #access li.selected > a, #access ul li.current-menu-parent > a  {
<?php if($cap->menue_link_color	){?>
	color: #<?php echo $cap->menue_link_color?>;
<?php };?>
}

/** ***   
menu font colour current and mouse over **/ 

#access li:hover > a, #access ul ul :hover > a, 
#access ul.children li:hover > a, #access ul.sub-menu li:hover > a, 
#access ul li.current_page_item > a, #access ul li.current-menu-ancestor > a, 
#access ul li.current_page_item > a:hover, #access ul li.current-menu-item > a:hover, 
#access ul li.current-menu-item > a, #access li.selected > a, #access ul li.current-menu-parent > a {
<?php if($cap->menue_link_color_current	){?>
	color: #<?php echo $cap->menue_link_color_current?>;
<?php };?>
} 

/** ***   
IE browser hack for menu font colour  **/ 

* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
<?php if($cap->menue_link_color_current	){?>
	color: #<?php echo $cap->menue_link_color_current?>;
<?php };?>
} 

/** ***   
menu background colour, border-bottom, image and repeat  **/ 

#access {
<?php if($cap->bg_menue_link_color	){?>
	background-color: #<?php echo $cap->bg_menue_link_color?>;
<?php };?>
} 

/** ***   
menu corner radius  **/ 

#access {
<?php if($cap->menu_corner_radius == 'just the bottom ones'){?>
	-moz-border-radius-topleft:0px;
	-moz-border-radius-topright:0px;
	-webkit-border-top-left-radius:0px;
	-webkit-border-top-right-radius:0px;
	border-top-left-radius:0px;
	border-top-right-radius:0px;
<?php };?> 
}


/** ***   
menu background colour, image and repeat of current  **/ 

#access ul li.current_page_item > a, #access ul li.current-menu-ancestor > a, 
#access ul li.current-menu-item > a, #access li.selected > a, #access ul li.current-menu-parent > a, 
#access ul li.current_page_item, #access ul li.current-menu-item, #access li.selected {
<?php if($cap->bg_menue_link_color_current	){?>
	background: #<?php echo $cap->bg_menue_link_color_current?>;
<?php };?>

} 

/** ***   
menu background colour hover and drop down list  **/ 

#access ul li.current_page_item a:hover, 
#access ul li.current-menu-item a:hover,  
#access li:hover > a, #access ul ul:hover > a, 
#access ul ul li, #access ul ul a {
<?php if($cap->bg_menue_link_color_hover){?>
	background: #<?php echo $cap->bg_menue_link_color_hover?> !important;
<?php };?>
} 

/** ***   
menu background colour drop down menu item hover  **/ 

#access ul.children li:hover > a,
#access ul.sub-menu li:hover > a {
<?php if($cap->bg_menue_link_color_dd_hover	){?>
	background: #<?php echo $cap->bg_menue_link_color_dd_hover?> !important;
<?php };?>
} 

/** ***   
Show/Hide Avatar  **/ 
<?php global $cc_post_options; ?>
div.post div.post-content {
<?php if($cc_post_options['cc_post_template_avatar'] == '1') { ?> 
  margin-left: 8px;
<?php } ?>
}

/** ***   
overwrite css area adding  **/ 

<?php if($cap->overwrite_css){
	echo $cap->overwrite_css;
}?>

</style> 