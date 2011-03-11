<?php
//
// CheezCap - Cheezburger Custom Administration Panel
// (c) 2008 - 2010 Cheezburger Network (Pet Holdings, Inc.)
// LOL: http://cheezburger.com
// Source: http://code.google.com/p/cheezcap/
// Authors: Kyall Barrows, Toby McKes, Stefan Rusek, Scott Porad
// License: GNU General Public License, version 2 (GPL), http://www.gnu.org/licenses/gpl-2.0.html
//

$themename = "Theme";	// used on the title of the custom admin page

function cap_get_options()
{
	$pages = get_pages();
	$option = Array();
	$option[0] = "All pages";
	$i = 1;
	foreach ($pages as $pagg) {
		$option[$i] = $pagg->post_title;
	$i++;
	}
	$option_pages = $option;

	$args = array('echo' => '0','hide_empty' => '0');
	$categories = get_categories($args);
    $option = Array();
	$option[0] = "All categories";
	$i = 1;
	foreach($categories as $category) { 
	$option[$i] = $category->name;
	$i++;
	}
    $option_categories = $option;
	return array(
		new Group ("General Appearance", "general",
			array(
				new DropdownOption("Colour scheme", "Select the colour scheme of your website", "style_css", array('grey', 'dark')),
				new DropdownOption("Sidebars", "Where do you like to have your sidebars? Define your default layout.", "sidebar_position", array('right', 'left', 'left and right')),
				new ColorOption("Background colour", "Change your background colour", "bg_body_color", ""),
				new FileOption("Background image", "Insert your own background image. Upload or insert url.", "bg_body_img"),
				new DropdownOption("Background repeat", "Repeat background image: x=horizontally, y=vertically", "bg_body_img_repeat", array('no repeat', 'x', 'y', 'x+y')),
				new ColorOption("Container colour", "Change background colour of the inner part of your website, write transparent for no color", "bg_container_color", ""),
				new ColorOption("Font colour", "Change font colour", "font_color", ""),
				new ColorOption("Title colour", "Change title colour", "title_color", ""),
				new ColorOption("Link colour", "Change link colour", "link_color", ""),
				new DropdownOption("Show excerpts", "Just for category and archive views: use excerpts or show full content of your posts", "excerpt_on", array('content', 'excerpt')),
				new TextOption("Excerpt length", "Change the excerpt length, default is 30 words", "excerpt_length", ""),
				)			
			)
			,
		new Group ("Header", "header",
			array(
				new DropdownOption("Show header text", "Show header text or not?", "header_text", array('on', 'off')),
				new ColorOption("Header text colour", "Change header font colour", "header_text_color", ""),
				new TextOption("Header height", "Your header height in px (and navigation position (y) at the same time), just enter a number. <br>
				This is not your header image height, you can specify your header image separately in the fields below. <br>
				Try 25px or 63px less than your header-image-height to fit perfectly...", "header_height", ""),
				new TextOption("Header image width", "Header image width in px, just enter a number.", "header_img_width", ""),
				new TextOption("Header image height", "Header image height in px, just enter a number.", "header_img_height", ""),
				new FileOption("Header image", "Insert your own header image. Upload or insert url.", "header_img"),
				new DropdownOption("Header image repeat", "Repeat header image: x=horizontally, y=vertically", "header_img_repeat", array('no repeat', 'x', 'y', 'x+y')),
				new DropdownOption("Header image x-position", "If header image is smaller, you can choose to align left, center or right", "header_img_x", array('left', 'center', 'right')),
				new TextOption("Header image y-position", "Distance from header image to top (in px), just enter a number", "header_img_y", "")
				)
			),
		new Group ("Menu", "menu",
			array(
				new BooleanOption("Show community navigation", "Enable Buddypress menu-items in the main navigation", "menue_enable_community", true),
				new DropdownOption("Menu x-position", "Align the menu left or right", "menu_x", array('left', 'right')),
				new ColorOption("Menu font colour", "Change menu font colour", "menue_link_color", ""),
				new ColorOption("Menu font colour &raquo; current and mouse over", "Change menu font colour from currently displayed menu item <br>
				or when mouse moves over", "menue_link_color_current", ""),
				new ColorOption("Menu background colour", "Change menu bar's general background colour", "bg_menue_link_color", ""),
				new ColorOption("Menu background colour &raquo; current", "Change background colour from currently displayed menu item", "bg_menue_link_color_current", ""),
				new ColorOption("Menu background colour &raquo; mouse over and drop down list", "Change a menu item's background colour when mouse moves over it, <br>
				and drop down background colour", "bg_menue_link_color_hover", ""),	
				new ColorOption("Menu background colour &raquo; drop down list mouse over effect", "Change background colour of drop down menu item when the mouse moves over it", "bg_menue_link_color_dd_hover", ""),
				new DropdownOption("Menu corner radius", "Do you want your menu corners to be rounded?", "menu_corner_radius", array('all rounded', 'just the bottom ones')),
				)
			),
		new Group ("Footer", "footer",
			array(			
				new BooleanOption("Show footer", "Show 3 widgetareas in the footer", "disable_widgets_footer", true),			
				new TextOption("Footer height", "Change the footer height, in px, just enter a number", "footer_height", ""),
				new ColorOption("Footer background", "Change background colour of the footer", "bg_footer_color", ""),	
				)
		),
		new Group ("Buddypress", "buddypress",
			array(
				new DropdownOption("BuddyPress admin bar", "Show/hide BuddyPress admin bar at the top of the header", "bp_login_bar_top", array('on', 'off' )),
				new BooleanOption("Use Buddypress default sub-navigation", " This sub-navigation is the secondary level navigation, <br>
				e.g. for profile it contains: [Public, Edit Profile, Change Avatar]<br>
				If you use the community navigation widget, you don't need this navigation. <br>
				If you want to use a horizontally sub-navigation - choose this one.", "bp_default_navigation", true),
				new BooleanOption("Show search bar", "enable BuddyPress search bar in header", "menue_enable_search", true),
				new BooleanOption("Use global Buddydev search instead of bp-search", "Replace the BuddyPress search (which comes with dropdown menu) with the Buddydev search. <br>
				The Buddydev search is an easy one-field global search with nice result-listing.", "buddydev_search", true),
				new DropdownOption("Search bar x-position", "If selected, you want the search bar left or right?", "searchbar_x", array('right', 'left')),
				new TextOption("Search bar y-position", "Distance from search bar to top (in px), just enter a number", "searchbar_y", ""),
  				new DropdownOption("Login sidebar", "Turn auto Buddypress login in the right sidebar on/off. <br>
				You can add this feature as a widget into every widgetarea you like.", "login_sidebar", array('on', 'off')), 
				new TextOption("Login sidebar text", "Define the text displayed in the login sidebar when you're logged out.", "bp_login_sidebar_text", ""), 
				)
			),
		new Group ("Slideshow", "slideshow",
			array(			
				new DropdownOption("Enable slideshow", "Enable slideshow", "enable_slideshow_home", array('home', 'off', 'all')),
				new DropdownOption("Slideshow post categories", "The slideshow takes images, titles and text-excerpts of the last 4 posts.<br>
				You can select the category the posts should be taken from.", "slideshow_cat", $option_categories),				
				new DropdownOption("Slideshow style", "Select a type of slideshow.", "slideshow_style", array('default','full width')),
				new DropdownOption("Caption", "Show just the images or also titles and excerpts?", "slideshow_caption", array('on', 'off')),
				)
		),
		new Group ("Overwrite CSS", "overwrite",
			array(			
				new TextOption("Overwrite CSS", "This is your place to overwrite existing CSS.<br>
				This way you are able to customize even the smallest CSS details. <br>
				If you know how to write, you can play around a bit!<br>
				<br> 
				Here's an example how to change your body background picture:<br>
				<br>
				body {<br>
				background-image:url(url-to-your-picture);<br>
				}<br>
				<br>
				<br><br><br><br><br><br><br><br><br><br>", "overwrite_css", "", true),
				)
			),		
		
	);
}


?>