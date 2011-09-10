<?php
	
require_once('admin/cheezcap.php');
require_once('core/loader.php');
 
/** Tell WordPress to run cc_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'cc_setup' );
if ( ! function_exists( 'cc_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * To override cc_setup() in a child theme, add your own cc_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 * @uses $content_width To set a content width according to the sidebars.
 * @uses BP_DISABLE_ADMIN_BAR To disable the admin bar if set to disabled in the themesettings.
 *
 */
function cc_setup() {
global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 222, 160, true );
		add_image_size( 'slider-top-large', 1006, 250, true  );
		add_image_size( 'slider-large', 990, 250, true  );
		add_image_size( 'slider-middle', 756, 250, true  );
		add_image_size( 'slider-thumbnail', 80, 50, true );
		add_image_size( 'post-thumbnails', 222, 160, true  );
		add_image_size( 'single-post-thumbnail', 598, 372, true );
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'buddypress', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu_top' => __( 'Header top menu', 'cc' ),
		'primary' => __( 'Header bottom menu', 'cc' ),
	) );
	
	// This theme allows users to set a custom background
	if($cap->add_custom_background == true){
		add_custom_background();
	}
	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '888888' );
	
	// No CSS, just an IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/_inc/images/default_header.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to cc_header_image_width and cc_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'cc_header_image_width', 1000 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'cc_header_image_height', 233 ) );


	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See cc_admin_header_style(), below.
	if($cap->add_custom_image_header == true){
		add_custom_image_header( 'cc_header_style', 'cc_admin_header_style', 'cc_admin_header_image' );
	}
	
	// Define Content with
	$content_width  = "670";
	if($cap->sidebar_position == "left and right"){
		$content_width  = "432";
	}
	
	// Define disable the admin bar
	if($cap->bp_login_bar_top == 'off') {
	define( 'BP_DISABLE_ADMIN_BAR', false );
	}
	
}
endif;

if ( ! function_exists( 'cc_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 */
function cc_header_style() {
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#blog-description, #header div#logo h1 a, #header div#logo h4 a {
			position: absolute;
			left: -9000px;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#blog-description, #header div#logo h1 a, #header div#logo h4 a {
		    color: #555555;
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


if ( ! function_exists( 'cc_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in cc_setup().
 *
 */
function cc_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background: #<?php echo get_background_color(); ?>;
		border: none;
		text-align: center;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 36px;
		letter-spacing: -0.03em;
		line-height: 42px;
		text-decoration: none;
	}
	#desc {
		font-size: 18px;
		line-height: 31px;
		padding: 0 0 9px 0;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 990px;
		width: 100%;
	}
	</style>
<?php
}
endif;

if ( ! function_exists( 'cc_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in cc_setup().
 *
 */
function cc_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<img src="<?php esc_url ( header_image() ); ?>" alt="" />
	</div>
<?php }
endif;



add_filter('widget_text', 'do_shortcode');
add_action( 'widgets_init', 'cc_widgets_init' );
function cc_widgets_init(){
	### Add Sidebars
	register_sidebars( 1,
		array(
			'name' => 'header full width',
			'id' => 'headerfullwidth',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'header left',
			'id' => 'headerleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'header center',
			'id' => 'headercenter',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'header right',
			'id' => 'headerright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'Sidebar',
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'left sidebar',
			'id' => 'leftsidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'footer full width',
			'id' => 'footerfullwidth',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'footer left',
			'id' => 'footerleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'footer center',
			'id' => 'footercenter',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'footer right',
			'id' => 'footerright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member header',
			'id' => 'memberheader',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member header left',
			'id' => 'memberheaderleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member header center',
			'id' => 'memberheadercenter',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member header right',
			'id' => 'memberheaderright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member sidebar left',
			'id' => 'membersidebarleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'member sidebar right',
			'id' => 'membersidebarright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group header',
			'id' => 'groupheader',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group header left',
			'id' => 'groupheaderleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group header center',
			'id' => 'groupheadercenter',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group header right',
			'id' => 'groupheaderright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group sidebar left',
			'id' => 'groupsidebarleft',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 1,
		array(
			'name' => 'group sidebar right',
			'id' => 'groupsidebarright',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebars( 15,
		array(
			'name' => 'shortcode %1$s',
			'id' => 'shortcode',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);

}
?>