<?php
if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_template_directory_uri());
} else {
	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
}
if(!isset($content_width))
	$content_width = 930;
load_theme_textdomain('ice', OF_FILEPATH.'/languages/');

require_once(OF_FILEPATH.'/inc/theme-defaults.php');
require_once(OF_FILEPATH.'/inc/dashboard-widget.php');

require_once(OF_FILEPATH.'/admin/admin-functions.php');
require_once(OF_FILEPATH.'/admin/admin-interface.php');

require_once(OF_FILEPATH.'/inc/custom-sidebars.php');
require_once(OF_FILEPATH.'/inc/custom-post-types.php');

if(is_admin())
	require_once (OF_FILEPATH.'/admin/theme-options.php');
require_once (OF_FILEPATH.'/admin/theme-functions.php');

require_once(OF_FILEPATH.'/inc/shortcodes.php');
require_once(OF_FILEPATH.'/inc/tools.php');
require_once(OF_FILEPATH.'/inc/widgets.php');

require_once(OF_FILEPATH.'/inc/theme-options.php');

require_once(OF_FILEPATH.'/inc/meta-boxes.php');

require_once(OF_FILEPATH.'/inc/shortcode-manager.php');

// theme settings
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');

// register sidebars
register_sidebar(array(	'id' => 'e404_blog_sidebar',
						'name' => 'Blog Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

register_sidebar(array(	'id' => 'e404_page_sidebar',
						'name' => 'Page Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

register_sidebar(array(	'id' => 'e404_portfolio_sidebar',
						'name' => 'Portfolio Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

register_sidebar(array(	'id' => 'e404_gallery_sidebar',
						'name' => 'Gallery Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

if($e404_all_options['e404_footer_columns'] == '1')
	$footer_class = 'full_page';
elseif($e404_all_options['e404_footer_columns'] == '2')
	$footer_class = 'one_half';
elseif($e404_all_options['e404_footer_columns'] == '3')
	$footer_class = 'one_third';
elseif($e404_all_options['e404_footer_columns'] == '4')
	$footer_class = 'one_fourth';
else
	$footer_class = 'one_fourth';

register_sidebar(array(	'id' => 'e404_footer_sidebar',
						'name' => 'Footer Sidebar',
						'before_widget' => '<div id="%1$s" class="'.$footer_class.' widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

// register menu
function e404_register_header_menu() {
	register_nav_menus(array('header-menu' => __('Header Menu', 'ice')));
}
add_action('init', 'e404_register_header_menu');

function e404_register_left_menu() {
	register_nav_menus(array('left-menu' => __('Left Menu', 'ice')));
}
add_action('init', 'e404_register_left_menu');

function e404_register_footer_menu() {
	register_nav_menus(array('footer-menu' => __('Footer Menu', 'ice')));
}
add_action('init', 'e404_register_footer_menu');

if(is_admin()) {
    wp_enqueue_script('fontawesome-iconpicker', OF_DIRECTORY.'/js/fontawesome-iconpicker.js');
    wp_enqueue_style('slider-admin', OF_DIRECTORY.'/css/admin.css');
    wp_enqueue_style('font-awesome', OF_DIRECTORY.'/css/font-awesome/css/font-awesome.css'); 
    wp_enqueue_style('fontawesome-iconpicker', OF_DIRECTORY.'/css/fontawesome-iconpicker.css'); 
}
if(!is_admin()) {
	add_action('wp_header', 'e404_custom_colors_css');
	
	require_once(OF_FILEPATH.'/inc/tweaks.php');

	wp_enqueue_script('jquery');
	wp_enqueue_script('preloader', OF_DIRECTORY.'/js/preloader.js');
	wp_enqueue_script('bootstrap', OF_DIRECTORY.'/js/bootstrap.min.js');
    wp_enqueue_script('bootstrap-slider', OF_DIRECTORY.'/js/jquery.touchSwipe.min.js');
    wp_enqueue_script('bootstrap-slider-main', OF_DIRECTORY.'/js/bootstrap-touch-slider.js');
	wp_enqueue_script('bpopup', OF_DIRECTORY.'/js/jquery.bpopup.min.js');

    wp_enqueue_script('carouFredSel', OF_DIRECTORY.'/js/jquery.carouFredSel-6.2.1.js');

	$disabled = get_option('e404_disable_galleria');
	if($disabled != 'true') {
		wp_enqueue_script('galleria', OF_DIRECTORY.'/js/galleria.min.js', '', '', true);
		wp_enqueue_script('galleria-classic', OF_DIRECTORY.'/js/galleria.classic.min.js', '', '', true);
		wp_enqueue_style('galleria', OF_DIRECTORY.'/css/galleria.classic.css');
	}

	$disabled = get_option('e404_disable_video_shortcode');
	if($disabled != 'true') {
		wp_enqueue_script('flowplayer', OF_DIRECTORY.'/js/flowplayer.min.js', '', '', true);
	}

	require_once(OF_FILEPATH.'/inc/sliders.php');
	
	// menu 
	wp_enqueue_script('hoverintent', OF_DIRECTORY.'/js/hoverIntent.js');
	wp_enqueue_script('superfish', OF_DIRECTORY.'/js/superfish.js');
	wp_enqueue_style('superfish', OF_DIRECTORY.'/css/menu.css');

	// tipsy 
	
	wp_enqueue_script('jquerytipsy', OF_DIRECTORY.'/js/jquery.tipsy.js', '', '', true);
	wp_enqueue_style('tipsy', OF_DIRECTORY.'/css/tipsy.css');
	wp_enqueue_style('bootstrap', OF_DIRECTORY.'/css/bootstrap.min.css');
	    wp_enqueue_style('bootstrap-touch-slider', OF_DIRECTORY.'/css/bootstrap-touch-slider.css');
	
	// sortable portfolio
	function e404_sortable_scripts() {
		$sortable_templates = array('portfolio-3columns-sortable.php', 'portfolio-4columns-sortable.php');
		if(in_array(e404_get_current_template(), $sortable_templates)) {
			wp_enqueue_script('quicksand', OF_DIRECTORY.'/js/jquery.quicksand.js', '', '', true);
			wp_enqueue_script('sortable', OF_DIRECTORY.'/js/sortable.js', '', '', true);
		}
	}
	add_action('get_header', 'e404_sortable_scripts');

	// scrollable
	$disabled = get_option('e404_disable_scrollable');
	if($disabled != 'true') {
		wp_enqueue_script('scrollable', OF_DIRECTORY.'/js/scrollable.min.js');
		wp_enqueue_style('scrollable', OF_DIRECTORY.'/css/scrollable.css');
	}

	// Nivo shortcode
	$disabled = get_option('e404_disable_nivo');
	if($disabled != 'true') {
		wp_enqueue_script('nivo', OF_DIRECTORY.'/js/jquery.nivo.slider.pack.js', '', '', true);
		wp_enqueue_style('nivo', OF_DIRECTORY.'/css/nivo-slider.css');
	}	

	wp_enqueue_script('prettyphotojs', OF_DIRECTORY.'/js/jquery.prettyphoto.js');
	wp_enqueue_script('prettyphoto-init', OF_DIRECTORY.'/js/prettyphoto_init.js');
	wp_enqueue_style('prettyphoto', OF_DIRECTORY.'/css/prettyphoto.css');
	
	wp_enqueue_style('owl-carousel', OF_DIRECTORY.'/css/owl.carousel.css');
	wp_enqueue_style('owl-theme', OF_DIRECTORY.'/css/owl.theme.css');

	// custom JS scripts


	wp_enqueue_script('jquerydataTables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', '', '', true);
	wp_enqueue_script('dataTables', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', '', '', true);

	wp_enqueue_script('owl-carousel', OF_DIRECTORY.'/js/owl.carousel.js', '', '', true);
	wp_enqueue_script('ice-custom', OF_DIRECTORY.'/js/ice_custom.js', '', '', true);
	
	$gwf = get_option('e404_google_web_fonts');
	if($gwf == 'true') {
		add_action('init', 'e404_google_web_fonts');
		add_action('wp_head', 'e404_google_web_fonts_css');
	}
}

// add Google Web Fonts scripts to page header
function e404_google_web_fonts() {
	$gwf_fonts[] = $gwf['body,.icon-box span,.icon-button span'] = get_option('e404_gwf_body');
	$gwf_fonts[] = $gwf['h1'] = get_option('e404_gwf_h1');
	$gwf_fonts[] = $gwf['h2'] = get_option('e404_gwf_h2');
	$gwf_fonts[] = $gwf['h3'] = get_option('e404_gwf_h3');
	$gwf_fonts[] = $gwf['h4'] = get_option('e404_gwf_h4');
	$gwf_fonts[] = $gwf['h5'] = get_option('e404_gwf_h5');
	$gwf_fonts[] = $gwf['h6'] = get_option('e404_gwf_h6');
	$gwf_fonts[] = $gwf['p'] = get_option('e404_gwf_p');
	$gwf_fonts[] = $gwf['blockquote'] = get_option('e404_gwf_blockquote');
	$gwf_fonts[] = $gwf['li'] = get_option('e404_gwf_li');
	$gwf_fonts[] = $gwf['.sf-menu li'] = get_option('e404_gwf_menu');
	$gwf_fonts[] = $gwf['.sf-menu li li'] = get_option('e404_gwf_submenu');
	
	$gwf_fonts = array_unique($gwf_fonts);
	wp_cache_add('e404_gwf', $gwf);
	foreach($gwf_fonts as $font) {
		if($font != '') {
			wp_enqueue_style(str_replace(array(':', '+'), '-', $font), 'http://fonts.googleapis.com/css?family='.$font);
		}
	}
}

// generate Google Web Fonts custom CSS
function e404_google_web_fonts_css() {
	$output = '<style type="text/css">';
	$gwf = wp_cache_get('e404_gwf');
	foreach($gwf as $tag => $font) {
		if($font != '') {
			$font = explode(':', $font);
			$output .= $tag." { font-family: '".str_replace('+', ' ', $font[0])."', arial, serif; }\n";
		}
	}
	$output .= '</style>';
	echo $output;
}

// generate custom colors CSS
function e404_custom_colors_css() {
	global $e404_all_options, $background_textures, $background_pictures;
	
	$css = '<style type="text/css">'."\n";

	if(!empty($e404_all_options['e404_custom_background_picture'])) {
		$css .= "body {\n";
		$css .= "    background-image: url('".$e404_all_options['e404_custom_background_picture']."');\n";
		$css .= "    background-repeat: no-repeat;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_background_picture'])) {
		$css .= "body {\n";
		$css .= "    background-image: url('".str_replace('/mini', '', $background_pictures[$e404_all_options['e404_background_picture']])."');\n";
		$css .= "    background-repeat: no-repeat;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_custom_background_texture'])) {
		$css .= "html {\n";
		$css .= "    background-image: url('".$e404_all_options['e404_custom_background_texture']."');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_background_texture'])) {
		$css .= "html  {\n";
		$css .= "    background-image: url('".str_replace('/mini', '', $background_textures[$e404_all_options['e404_background_texture']])."');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}

	if($e404_all_options['e404_background_effect'] == 'none') {
		$css .= "body  {\n";
		$css .= "    background-image: none;\n";
		$css .= "}\n";
	}
	elseif($e404_all_options['e404_background_effect'] == 'noise') {
		$css .= "body  {\n";
		$css .= "    background-image: url('".OF_DIRECTORY."/images/bg/bg30.png');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}
	elseif($e404_all_options['e404_background_effect'] == 'horizontal') {
		$css .= "body  {\n";
		$css .= "    background-image: url('".OF_DIRECTORY."/images/light-x.png');\n";
		$css .= "    background-repeat: repeat-x;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}
	elseif($e404_all_options['e404_background_effect'] == 'vertical') {
		$css .= "body  {\n";
		$css .= "    background-image: url('".OF_DIRECTORY."/images/light-y.png');\n";
		$css .= "    background-repeat: repeat-y;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}
	elseif($e404_all_options['e404_background_effect'] == 'center') {
		$css .= "body  {\n";
		$css .= "    background-image: url('".OF_DIRECTORY."/images/light-center.png');\n";
		$css .= "    background-repeat: no-repeat;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}

	if($e404_all_options['e404_menu_footer_background'] == 'dark') {
		$css .= "#main_wrapper {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/dark-bg-btm.png');\n";
		$css .= "}\n";
		$css .= "#content_wrapper,\n";
		$css .= "#navigation_wrapper,\n";
		$css .= "#copyright_wrapper {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/dark-bg-full.png');\n";
		$css .= "}\n";
		$css .= "#header {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/dark-nav-border.png');\n";
		$css .= "}\n";
		$css .= "#twitter-footer {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/dark-bg.png');\n";
		$css .= "}\n";
		$css .= "#twitter-footer p {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/twitter-header.png');\n";
		$css .= "}\n";
		$css .= "#footer h3 {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/hr2.png');\n";
		$css .= "}\n";
		$css .= "#copyright {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/hr5.png');\n";
		$css .= "}\n";
	}
	if($e404_all_options['e404_menu_footer_background'] == 'light') {
		$css .= "#main_wrapper {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/light-bg-btm.png');\n";
		$css .= "}\n";
		$css .= "#content_wrapper,\n";
		$css .= "#navigation_wrapper,\n";
		$css .= "#copyright_wrapper {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/light-bg-full.png');\n";
		$css .= "}\n";
		$css .= "#header {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/light-nav-border.png');\n";
		$css .= "}\n";
		$css .= "#twitter-footer {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/light-bg.png');\n";
		$css .= "}\n";
		$css .= "#twitter-footer p {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/twitter-header-dark.png');\n";
		$css .= "}\n";
		$css .= "#footer h3 {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/hr2-dark.png');\n";
		$css .= "}\n";
		$css .= "#copyright {\n";
		$css .= "	background-image: url('".OF_DIRECTORY."/images/hr5-dark.png');\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_showcase_thumbnails_background'])) {
		$css .= ".showcase-thumbnail-container {\n    background-color: ".$e404_all_options['e404_showcase_thumbnails_background'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_showcase_tooltips_text'])) {
		$css .= ".showcase-tooltip {\n    color: ".$e404_all_options['e404_showcase_tooltips_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_showcase_tooltips_background'])) {
		$css .= ".showcase-tooltip {\n    background-color: ".$e404_all_options['e404_showcase_tooltips_background'].";\n}\n";
	}

	if($e404_all_options['e404_custom_style'] != 'true') {
		$css .= "</style>\n";
		echo $css;
		return;
	}

	if(!empty($e404_all_options['e404_color_background'])) {
		$css .= "html, body {\n    background-color: ".$e404_all_options['e404_color_background'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_main'])) {
		$css .= "html, body, form {\n    color: ".$e404_all_options['e404_color_main'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_forms'])) {
		$css .= "input, textarea, button, select, option {\n    color: ".$e404_all_options['e404_color_forms'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_links'])) {
		$css .= "a, .icon-box span a, .icon-button span a {\n    color: ".$e404_all_options['e404_color_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_links_hover'])) {
		$css .= "a:hover, .icon-box span a:hover, .icon-button span a:hover {\n    color: ".$e404_all_options['e404_color_links_hover'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_headers'])) {
		$css .= "h1, h2, h3, h4, h5, h6 {\n    color: ".$e404_all_options['e404_color_headers'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_headers_links'])) {
		$css .= "h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\n    color: ".$e404_all_options['e404_color_headers_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_headers_links_hover'])) {
		$css .= "h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {\n    color: ".$e404_all_options['e404_color_headers_links_hover'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_intro'])) {
		$css .= "#intro, .slogan {\n    color: ".$e404_all_options['e404_color_intro'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_intro_strong'])) {
		$css .= "#intro strong, .slogan strong {\n    color: ".$e404_all_options['e404_color_intro_strong'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_intro_links'])) {
		$css .= "#intro a, .slogan a {\n    color: ".$e404_all_options['e404_color_intro_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_footer'])) {
		$css .= "#footer, #footer form {\n    color: ".$e404_all_options['e404_color_footer'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_footer_links'])) {
		$css .= "#footer a {\n    color: ".$e404_all_options['e404_color_footer_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_footer_headers'])) {
		$css .= "#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6 {\n    color: ".$e404_all_options['e404_color_footer_headers'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_copyright_text'])) {
		$css .= "#copyright {\n    color: ".$e404_all_options['e404_color_copyright_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_copyright_links'])) {
		$css .= "#copyright a {\n    color: ".$e404_all_options['e404_color_copyright_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_submit_background']) || !empty($e404_all_options['e404_submit_text'])) {
		$css .= "form input[type=\"submit\"] {\n";
		if(!empty($e404_all_options['e404_submit_background']))
			$css .= "    background-color: ".$e404_all_options['e404_submit_background'].";\n";
		if(!empty($e404_all_options['e404_submit_text']))
			$css .= "    color: ".$e404_all_options['e404_submit_text'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_submit_background_footer']) || !empty($e404_all_options['e404_submit_text_footer'])) {
		$css .= "#footer form input[type=\"submit\"] {\n";
		if(!empty($e404_all_options['e404_submit_background_footer']))
			$css .= "    background-color: ".$e404_all_options['e404_submit_background_footer'].";\n";
		if(!empty($e404_all_options['e404_submit_text_footer']))
			$css .= "    color: ".$e404_all_options['e404_submit_text_footer'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_menu_links'])) {
		$css .= ".sf-menu a {\n    color: ".$e404_all_options['e404_menu_links']."; }\n";
	}
	if(!empty($e404_all_options['e404_menu_links_background'])) {
		$css .= ".sf-menu a {\n    background-color: ".$e404_all_options['e404_menu_links_background']."; }\n";
	}
	if(!empty($e404_all_options['e404_menu_current_text']) || !empty($e404_all_options['e404_menu_current_background'])) {
		$css .= ".sf-menu li:hover a, .sf-menu li.current-menu-item a, .sf-menu li.current-page-parent a, .sf-menu li.current-page-ancestor a, .sf-menu li.current_page_parent a {\n";
		if(!empty($e404_all_options['e404_menu_current_text']))
			$css .= "    color: ".$e404_all_options['e404_menu_current_text'].";\n";
		if(!empty($e404_all_options['e404_menu_current_background']))
			$css .= "    background-color: ".$e404_all_options['e404_menu_current_background'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_menu_submenu_indicator'])) {
		$css .= ".sf-sub-indicator-inner { border-top-color: ".$e404_all_options['e404_menu_submenu_indicator']."; }\n";
	}
	if(!empty($e404_all_options['e404_menu_current_border_bottom'])) {
		$css .= ".sf-menu li:hover li a:hover, .sf-menu li li.current-menu-item a {\n    background: ".$e404_all_options['e404_menu_current_border_bottom'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_menu_submenu_background'])) {
		$css .= ".sf-menu li ul {\n";
		$css .= "    background: ".$e404_all_options['e404_menu_submenu_background'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_menu_submenu_links'])) {
		$css .= ".sf-menu li:hover li a, .sf-menu li li a, .sf-menu li.current-menu-item li a, .sf-menu li.current-page-parent li a, .sf-menu li.current-page-ancestor li a, .sf-menu li.current-menu-parent li a, .sf-menu li.current-menu-ancestor li a {\n    color: ".$e404_all_options['e404_menu_submenu_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_menu_submenu_hover']) || !empty($e404_all_options['e404_menu_submenu_hover_background'])) {
		$css .= ".sf-menu li:hover li a:hover, .sf-menu li li.current-menu-item a {\n";
		if(!empty($e404_all_options['e404_menu_submenu_hover']))
			$css .= "    color: ".$e404_all_options['e404_menu_submenu_hover'].";\n";
		if(!empty($e404_all_options['e404_menu_submenu_hover_background']))
			$css .= "    background: ".$e404_all_options['e404_menu_submenu_hover_background'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_featured_border'])) {
		$css .= ".featured-box {\n    border-color: ".$e404_all_options['e404_pricebox_featured_border']." !important;\n}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_featured_price'])) {
		$css .= ".featured-box strong {\n    color: ".$e404_all_options['e404_pricebox_featured_price']." !important;\n}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_featured_header_text']) || !empty($e404_all_options['e404_pricebox_featured_header_background'])) {
		$css .= ".featured-box h3 {\n";
		if(!empty($e404_all_options['e404_pricebox_featured_header_text']))
			$css .= "    color: ".$e404_all_options['e404_pricebox_featured_header_text']." !important;\n";
		if(!empty($e404_all_options['e404_pricebox_featured_header_background']))
			$css .= "    background: ".$e404_all_options['e404_pricebox_featured_header_background']." !important;\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_color_slider_title']) || !empty($e404_all_options['e404_color_slider_title_background'])) {
		$css .= ".nivo-caption, .kwicks.horizontal p.title {\n";
		if(!empty($e404_all_options['e404_color_slider_title']))
			$css .= "    color: ".$e404_all_options['e404_color_slider_title']." !important;\n";
		if(!empty($e404_all_options['e404_color_slider_title_background']))
			$css .= "    background: ".$e404_all_options['e404_color_slider_title_background']." !important;\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_breadcrumbs_text'])) {
		$css .= "#breadcrumb {\n    color: ".$e404_all_options['e404_breadcrumbs_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_breadcrumbs_links'])) {
		$css .= "#breadcrumb a {\n    color: ".$e404_all_options['e404_breadcrumbs_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_date_background'])) {
		$css .= ".meta-date {\n    background-color: ".$e404_all_options['e404_date_background'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_date_sticky_background'])) {
		$css .= ".sticky .meta-date {\n    background-color: ".$e404_all_options['e404_date_sticky_background'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_twitter_box_text'])) {
		$css .= "#twitter-footer {\n    color: ".$e404_all_options['e404_twitter_box_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_twitter_box_links'])) {
		$css .= "#twitter-footer a {\n    color: ".$e404_all_options['e404_twitter_box_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_header_contact_text'])) {
		$css .= "#header_info {\n    color: ".$e404_all_options['e404_header_contact_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_header_contact_text_strong'])) {
		$css .= "#header_info strong {\n    color: ".$e404_all_options['e404_header_contact_text_strong'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_header_contact_text_span'])) {
		$css .= "#header_info span {\n    color: ".$e404_all_options['e404_header_contact_text_span'].";\n}\n";
	}

	$css .= "</style>\n";
	
	echo $css;
}
add_action('wp_head', 'e404_custom_colors_css');

// display header social icons
function e404_show_header_social_icons() {
	global $e404_all_options;
	
	$sites = array('Contact', 'RSS', 'Twitter', 'Facebook', 'Flickr', 'Behance', 'Buzz', 'Google+', 'Delicious', 'Digg', 'Dribbble', 'DropBox', 'Foursquare', 'iChat', 'LastFM', 'LinkedIn', 'MobyPicture', 'MySpace', 'Skype', 'StumbleUpon', 'Tumblr', 'Vimeo', 'YouTube', 'Xing');
	
	$color = ($e404_all_options['e404_social_icons_variant'] == 'black') ? '-b' : '';
	$social_media = array();

	$i = 0;
	foreach($sites as $site) {
		$name = $site;
		$site = strtolower($site);
		if($site == 'google+')
			$site = 'plus';
		if(isset($e404_all_options['e404_'.$site]) && trim($e404_all_options['e404_'.$site]) != '') {
			$social_media[$i]['name'] = $name;
			if($site == 'twitter')
				$social_media[$i]['url'] = 'http://twitter.com/'.$e404_all_options['e404_twitter'];
			else
				$social_media[$i]['url'] = $e404_all_options['e404_'.$site];
			$social_media[$i]['icon'] = OF_DIRECTORY.'/images/socialmedia/'.$site.$color.'.png';
			$i++;
		}
	}
	$output = '';
	foreach($social_media as $site) {
		$output .= '<a href="'.$site['url'].'" title="'.$site['name'].'" class="tiptip"><img src="'.$site['icon'].'" alt="'.$site['name'].'" /></a>'."\n";
	}
	echo $output;
}

// template redirects for portfolio sections
function e404_portfolio_template($templates) {
	$page_id = get_option('e404_portfolio_page');
	$template_name = get_post_meta($page_id, '_wp_page_template', true);
	$template = OF_FILEPATH.'/'.$template_name;
	if(!is_file($template)) {
		echo 'Portfolio page not found. Please choose your portfolio page in Appearance -> Theme Options -> Portfolio Options.';
		exit();
	}
	return $template;
}
add_filter('taxonomy_template', 'e404_portfolio_template');

// excerpt customization
function e404_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'e404_excerpt_more');
function e404_excerpt_length($length) {
	return 9999;
}
add_filter('excerpt_length', 'e404_excerpt_length');

// current templates magic
function e404_template_include($template) {
    $GLOBALS['e404_current_template'] = basename($template);
    return $template;
}
add_filter('template_include', 'e404_template_include', 1000);

function e404_get_current_template() {
    if(!isset($GLOBALS['e404_current_template']))
        return false;
    else
        return $GLOBALS['e404_current_template'];
}

add_filter('gallery_style', 
	create_function(
		'$css',
		'return preg_replace("#<style type=\'text/css\'>(.*?)</style>#s", "", $css);'
		)
	);

// shortcodes in sidebars
add_filter('widget_text', 'do_shortcode');

// comment form
function e404_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li id="li-comment-<?php comment_ID(); ?>">
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-box">
			<div class="border-img leftside avatar-box"><?php echo get_avatar($comment, 40, OF_DIRECTORY.'/images/avatar.png'); ?></div>
			<div class="comment-text">
			<?php printf( __( sprintf('<cite class="comment-author">%s</cite>', get_comment_author_link() ), 'ice')); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e('Your comment is awaiting moderation.', 'ice'); ?></em>
				<br />
			<?php endif; ?>
				<span class="comment-date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __('%1$s at %2$s', 'ice'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(__('(Edit)', 'ice'), ' '); ?>
				</span>
				<p><?php comment_text(); ?></p>
				<div class="comment-reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'ice'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'ice'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

function check_is_https(){
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
		return 'https://';
	}else{
		return 'http://';}
}
function album_load_more_init(){
	$current_url_path = check_is_https().$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url_path = home_url('calendor_demo_set/'); 
	if($current_url_path == $url_path){
		require_once(get_template_directory().'/calendor_demo_set.php');die();
	}
}
if (!function_exists('ABdev_allowed_tags')) {
	function ABdev_allowed_tags(){
		return array(
			'a' => array(
		        'href' => array(),
		        'title' => array()
		    ),
		    'br' => array(),
		    'em' => array(),
		    'strong' => array(),
		    'i' => array(
		    	'class' => array()
		    ),
		);

	}
}

add_action( 'init', 'album_load_more_init' );

function filter_search($query) {
    if ($query->is_search) {
    $query->set('post_type', array('post', 'page'));
    };
    return $query;
};
add_filter('pre_get_posts', 'filter_search');


/*function jc_limit_search_posts() {
	if ( is_search())
		set_query_var('posts_per_page', 10);
}
add_filter('pre_get_posts', 'jc_limit_search_posts');*/



// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;
    
    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
        $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
    }
    
    // find the top level parent
    if ( ! isset( $args->direct_parent ) ) {
      $prev_root_id = $root_id;
      while ( $prev_root_id != 0 ) {
        foreach ( $sorted_menu_items as $menu_item ) {
          if ( $menu_item->ID == $prev_root_id ) {
            $prev_root_id = $menu_item->menu_item_parent;
            // don't set the root_id to 0 if we've reached the top of the menu
            if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
            break;
          } 
        }
      }
    }
    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }    
    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}
add_post_type_support( 'page', 'excerpt' );

// Add custom fields for page added by aatif
function add_page_slider_fields_meta_box() {
	add_meta_box(
		'page_slider_meta_box', // $id
		'Silder Details', // $title
		'page_slider_fields_meta_box', // $callback
		'page', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_page_slider_fields_meta_box' );

function page_slider_fields_meta_box() {
	global $post;  
	//$meta = get_post_meta( $post->ID, 'page_slider', true ); 
	$getpostmeta=get_post_meta( $post->ID ); 
	$meta=$getpostmeta['page_slider'][0];
	$meta = html_entity_decode($meta, ENT_QUOTES, 'UTF-8');
	$meta = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $meta );
	$meta = unserialize($meta);
	$positions = array(
					'top-left' => 'Top Left', 'top-center' => 'Top Center', 'top-right' => 'Top Right', 
					'middle-left' => 'Middle Left', 'middle-center' => 'Middle Center', 'middle-right' => 'Middle Right', 
					'bottom-left' => 'Bottom Left', 'bottom-center' => 'Bottom Center', 'bottom-right' => 'Bottom Right'
				); 
	$fonts = array('latoblack'=>'Lato Black', 'gothamultra' => 'Gotham Ultra');
	?>
  	<input type="hidden" name="page_slider_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
  	<p>
  		<input type="checkbox" name="page_slider[enabled]" value="yes" <?php if ( isset($meta['enabled']) && $meta['enabled'] === 'yes' ) echo 'checked'; ?>> Enabled
  	</p>
  	<div id="sliderDiv">
  		<?php if(isset($meta['slides'])){
  			end($meta['slides']);
  			$cnt_slide = key($meta['slides']); ?>
  			<input type="hidden" id="cnt_slide" value="<?php echo $cnt_slide; ?>">
  			<?php $j = 1;
  			foreach ($meta['slides'] as $key => $slides) { ?>
  				<div id="slide<?php echo $key; ?>" class="slideDiv">
                    <h2>Slide <?php echo $j; ?> <a href="javascript:void(0);" title="Remove Slide" class="button remove_slide" onclick="remove_slide(<?php echo $key?>);">X</a></h2>
                    <div class="inside">
                        <table>
                            <tr>
                                <th><label for="page_slider[slides][<?php echo $key; ?>][image]">Image Upload</label></th>
                                <td><input type="text" name="page_slider[slides][<?php echo $key; ?>][image]" class="meta-image<?php echo $key; ?> regular-text" value="<?php if(isset($slides['image'])){ echo $slides['image']; } ?>">
                                <input type="button" class="button image-upload<?php echo $key; ?>" value="Browse">
                                    <div class="image-preview image-preview<?php echo $key; ?>">
                                        <img src="<?php echo $slides['image']; ?>" style="max-width: 200px;">
                                    </div>
                                </td>                                
                            </tr>
                            <tr>
                                <th><label for="page_slider[slides][<?php echo $key; ?>][title]">Title</label></th>
                                <td>
                                    <textarea name="page_slider[slides][<?php echo $key; ?>][title]" rows="2" cols="56"><?php if(isset($slides['title'])){ echo $slides['title']; } ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="page_slider[slides][<?php echo $key; ?>][position]">Title Position</label></th>
                                <td>
                                    <select name="page_slider[slides][<?php echo $key; ?>][position]" class="regular-text">
                                        <option value="">Select Title Position</option>
                                        <?php foreach($positions as $id => $label){ 
                                            if ( isset($slides['position']) && $slides['position'] === $id )
                                                $selected = 'selected="selected"';
                                            else
                                                $selected = '';
                                            echo '<option value="'.$id.'" '.$selected.'>'.$label.'</option>';
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="page_slider[slides][<?php echo $key; ?>][font]">Fonts</label></th>
                                <td>
                                    <select name="page_slider[slides][<?php echo $key; ?>][font]" class="regular-text">
                                        <?php foreach($fonts as $id => $label){ 
                                            if ( isset($slides['font']) && $slides['font'] === $id )
                                                $selected = 'selected="selected"';
                                            else
                                                $selected = '';
                                            echo '<option value="'.$id.'" '.$selected.'>'.$label.'</option>';
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="page_slider[slides][<?php echo $key; ?>][order]">Order</label></th>
                                <td><input type="number" name="page_slider[slides][<?php echo $key; ?>][order]" value="<?php if(isset($slides['order'])){ echo $slides['order']; } ?>" min="0"></td>
                            </tr>
                            
                        </table>
                        <script>
                        jQuery(document).ready(function ($) {
                            // Instantiates the variable that holds the media library frame.
                            var meta_image_frame<?php echo $key; ?>;
                            // Runs when the image button is clicked.
                            $('.image-upload<?php echo $key; ?>').click(function (e) {
                                // Get preview pane
                                var meta_image_preview = $(this).parent().parent().children('.image-preview<?php echo $key; ?>');
                                // Prevents the default action from occuring.
                                e.preventDefault();
                                var meta_image = $(this).parent().children('.meta-image<?php echo $key; ?>');
                                // If the frame already exists, re-open it.
                                if (meta_image_frame<?php echo $key; ?>) {
                                    meta_image_frame<?php echo $key; ?>.open();
                                    return;
                                }
                                // Sets up the media library frame
                                meta_image_frame<?php echo $key; ?> = wp.media.frames.meta_image_frame<?php echo $key; ?> = wp.media({
                                    title: meta_image.title,
                                    button: {
                                        text: meta_image.button
                                    }
                                });
                                // Runs when an image is selected.
                                meta_image_frame<?php echo $key; ?>.on('select', function () {
                                    // Grabs the attachment selection and creates a JSON representation of the model.
                                    var media_attachment = meta_image_frame<?php echo $key; ?>.state().get('selection').first().toJSON();
                                    // Sends the attachment URL to our custom image input field.
                                    meta_image.val(media_attachment.url);
                                    meta_image_preview.children('img').attr('src', media_attachment.url);
                                });
                                // Opens the media library frame.
                                meta_image_frame<?php echo $key; ?>.open();
                            });
                        });
                        </script>
                    </div>
			  	</div>
  			<?php $j++;
  			}
  		}else{ ?>
  			<input type="hidden" id="cnt_slide" value="0">
  			<div id="slide0" class="slideDiv">
                <h2>Slide 1</h2>
                <div class="inside">
                    <table>
                        <tr>
                            <th><label for="page_slider[slides][0][image]">Image Upload</label></th>
                            <td>
                                <input type="text" name="page_slider[slides][0][image]" class="meta-image0 regular-text" value="">
			    	            <input type="button" class="button image-upload0" value="Browse">
                            </td>
                        </tr>
                        <tr>
                            <th><label for="page_slider[slides][0][title]">Title</label></th>
                            <td><textarea name="page_slider[slides][0][title]" rows="2" cols="56"></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="page_slider[slides][0][position]">Title Position</label></th>
                            <td>
                                <select name="page_slider[slides][0][position]" class="regular-text">
                                    <option value="">Select Title Position</option>
                                    <?php foreach($positions as $id => $label){ 
                                        echo '<option value="'.$id.'">'.$label.'</option>';
                                    } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="page_slider[slides][0][font]">Fonts</label></th>
                            <td>
                                <select name="page_slider[slides][0][font]" class="regular-text">
                                    <?php foreach($fonts as $id => $label){ 
                                        echo '<option value="'.$id.'">'.$label.'</option>';
                                    } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="page_slider[slides][0][order]">Order</label></th>
                            <td><input type="number" name="page_slider[slides][0][order]" value="0" min="0"></td>
                        </tr>
                        
                    </table>
                </div>
  			</div>
  			<script>
		    jQuery(document).ready(function ($) {
		      	// Instantiates the variable that holds the media library frame.
		      	var meta_image_frame0;
		      	// Runs when the image button is clicked.
		      	$('.image-upload0').click(function (e) {
		        	// Get preview pane
		        	var meta_image_preview = $(this).parent().parent().children('.image-preview0');
		        	// Prevents the default action from occuring.
		        	e.preventDefault();
		        	var meta_image = $(this).parent().children('.meta-image0');
		        	// If the frame already exists, re-open it.
		        	if (meta_image_frame0) {
		          		meta_image_frame0.open();
		          		return;
		        	}
		        	// Sets up the media library frame
		        	meta_image_frame0 = wp.media.frames.meta_image_frame0 = wp.media({
		          		title: meta_image.title,
		          		button: {
		            		text: meta_image.button
		          		}
		        	});
		        	// Runs when an image is selected.
		        	meta_image_frame0.on('select', function () {
			          	// Grabs the attachment selection and creates a JSON representation of the model.
			          	var media_attachment = meta_image_frame0.state().get('selection').first().toJSON();
			          	// Sends the attachment URL to our custom image input field.
			          	meta_image.val(media_attachment.url);
			          	meta_image_preview.children('img').attr('src', media_attachment.url);
			        });
		        	// Opens the media library frame.
		        	meta_image_frame0.open();
		      	});
		    });
		  	</script>
  		<?php } ?>
  	</div>
  	<p>
  		<a href="javascript:void(0);" class="button button-primary" id="addSlide">+ Add slide</a>
  	</p>
  	<script>
    jQuery(document).ready(function ($) {
	    $('#addSlide').click(function (e) {
	    	var cnt_slide = $('#cnt_slide').val();
	    	cnt_slide = parseInt(cnt_slide) + 1;
            var numItems = $('.slideDiv').length + 1;
	    	var clone = '<div id="slide'+cnt_slide+'" class="slideDiv">';
                clone += '<h2>Slide '+numItems+' <a href="javascript:void(0);" class="button remove_slide" onclick="remove_slide('+cnt_slide+');">X</a></h2>';
                clone += '<div class="inside">';
                    clone += '<table>';
                        clone += '<tr>';
                            clone += '<th>';
                                clone += '<label for="page_slider[slides]['+cnt_slide+'][image]">Image Upload</label>';
                            clone += '</th>';
                            clone += '<td>';
                                clone += '<input type="text" name="page_slider[slides]['+cnt_slide+'][image]" class="meta-image'+cnt_slide+' regular-text" value="">';
                                clone += ' <input type="button" class="button image-upload'+cnt_slide+'" value="Browse">';
                            clone += '</td>';
                        clone += '</tr>';
                        clone += '<tr>';
                            clone += '<th>';
                                clone += '<label for="page_slider[slides]['+cnt_slide+'][title]">Title</label>';
                            clone += '</th>';
                            clone += '<td>';
                                clone += '<textarea name="page_slider[slides]['+cnt_slide+'][title]" rows="2" cols="56""></textarea>';
                            clone += '</td>';
                        clone += '</tr>';
                        clone += '<tr>';
                            clone += '<th>';
                                clone += '<label for="page_slider[slides]['+cnt_slide+'][title]">Title Position</label>';
                            clone += '</th>';
                            clone += '<td>';
                                clone += '<select name="page_slider[slides]['+cnt_slide+'][position]" class="regular-text">';
                                    clone += '<option value="">Select Title Position</option>';
                                    <?php foreach($positions as $id=>$label){ ?>
                                        clone += '<option value="<?php echo $id; ?>"><?php echo $label; ?></option>';
                                    <?php } ?>
                                clone += '</select>';
                            clone += '</td>';
                        clone += '</tr>';
            
                        clone += '<tr>';
                            clone += '<th>';
                                clone += '<label for="page_slider[slides]['+cnt_slide+'][font]">Fonts</label>';
                            clone += '</th>';
                            clone += '<td>';
                                clone += '<select name="page_slider[slides]['+cnt_slide+'][font]" class="regular-text">';
                                    <?php foreach($fonts as $id=>$label){ ?>
                                        clone += '<option value="<?php echo $id; ?>"><?php echo $label; ?></option>';
                                    <?php } ?>
                                clone += '</select>';
                            clone += '</td>';
                        clone += '</tr>';            
                        clone += '<tr>';
                            clone += '<th>';
                                clone += '<label for="page_slider[slides]['+cnt_slide+'][order]">Order</label>';
                            clone += '</th>';
                            clone += '<td>';
                                clone += '<input type="number" name="page_slider[slides]['+cnt_slide+'][order]" value="0" min="0">';
                            clone += '</td>';
                        clone += '</tr>';
                        clone += '<tr>';
                            clone += '<th>';
                            clone += '</th>';
                            clone += '<td>';
                            clone += '</td>';
                        clone += '</tr>';
                    clone += '</table>';
                clone += '</div>';
	    	clone += '</div>';
	    	clone += '<script>';
	    		clone += 'jQuery(document).ready(function ($) {';
		      		clone += 'var meta_image_frame'+cnt_slide+';';
		      		clone += '$(".image-upload'+cnt_slide+'").click(function (e) {';
		        		clone += 'var meta_image_preview = $(this).parent().parent().children(".image-preview'+cnt_slide+'");';
		        		clone += 'e.preventDefault();';
		        		clone += 'var meta_image = $(this).parent().children(".meta-image'+cnt_slide+'");';
		        		clone += 'if (meta_image_frame'+cnt_slide+') {';
		          			clone += 'meta_image_frame'+cnt_slide+'.open();';
		          			clone += 'return;';
		        		clone += '}';
		        		clone += 'meta_image_frame'+cnt_slide+' = wp.media.frames.meta_image_frame0 = wp.media({';
		          			clone += 'title: meta_image.title,';
		          			clone += 'button: {';
		            			clone += 'text: meta_image.button';
		          			clone += '}';
		        		clone += '});';
		        		clone += 'meta_image_frame'+cnt_slide+'.on("select", function () {';
			          		clone += 'var media_attachment = meta_image_frame'+cnt_slide+'.state().get("selection").first().toJSON();';
			          		clone += 'meta_image.val(media_attachment.url);';
			          		clone += 'meta_image_preview.children("img").attr("src", media_attachment.url);';
			        	clone += '});';
		        		clone += 'meta_image_frame'+cnt_slide+'.open();';
		      		clone += '});';
		    	clone += '});';
		    clone += '<\/script>';
	    	$("#sliderDiv").append(clone);
	    	$('#cnt_slide').val(cnt_slide);
	    });
	});
	function remove_slide(id){
    	$( "#slide"+id ).remove();
    }
  	</script>
<?php }
function save_your_fields_meta( $post_id ) { 	
	//echo "<pre>";print_r($_POST);echo "</pre>";exit;  	
	$rhrv_stored_meta = get_post_meta( $post_id );	
	// verify nonce
	if ( !wp_verify_nonce( $_POST['page_slider_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}	
	$old = get_post_meta( $post_id, 'page_slider', true );
	$new = $_POST['page_slider'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'page_slider', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'page_slider', $old );
	}	
}
add_action( 'save_post', 'save_your_fields_meta' );

function get_our_georgia_map($atts) {
    $map ='';
        $map .= '<div class="GeorgiaMap">';
            $map .= '<div class="GeorgiaMapInner">';
                $map .= '<div><img src="'.OF_DIRECTORY.'/images/georgia_map.png" /></div>';
                $map .= '<div class="MapPin MapPin1 text_bottom">';
                    $map .= '<a href="http://nlasandbox.com/dev/g4hcontent/4-h-centers/wahsega-4-h-center/" >';
                        $map .= '<span class="pin_text">';
                            $map .= '<label>WAHSEGA</label><span>4-H Center</span><small>Dahlonega, GA</small>';
                        $map .= '</span>';
                    $map .= '</a>';
                $map .= '</div>';
                $map .= '<div class="MapPin MapPin2 text_bottom">';
                    $map .= '<a href="http://nlasandbox.com/dev/g4hcontent/4-h-centers/fortson-4-h-center/" >';
                        $map .= '<span class="pin_text">';
                            $map .= '<label>FORTSON</label><span>4-H Center</span><small>Hampton, GA</small>';
                        $map .= '</span>';
                    $map .= '</a>';
                $map .= '</div>';
                $map .= '<div class="MapPin MapPin3 text_bottom">';
                    $map .= '<a href="http://nlasandbox.com/dev/g4hcontent/4-h-centers/rock-eagle-4-h-centers/" >';
                        $map .= '<span class="pin_text">';
                            $map .= '<label>ROCK EAGLE</label><span>4-H Center</span><small>Eatonton, GA</small>';
                        $map .= '</span>';
                    $map .= '</a>';
                $map .= '</div>';
                $map .= '<div class="MapPin MapPin4 text_left">';
                    $map .= '<a href="http://nlasandbox.com/dev/g4hcontent/4-h-centers/burton-4-h-center/" >';
                        $map .= '<span class="pin_text">';
                            $map .= '<label>BURTON</label><span>4-H Center</span><small>Tybee Island, GA</small>';
                        $map .= '</span>';
                    $map .= '</a>';
                $map .= '</div>';
                $map .= '<div class="MapPin MapPin5 text_left">';
                    $map .= '<a href="http://nlasandbox.com/dev/g4hcontent/4-h-centers/georgia-4-h-at-camp-jekyll/" >';
                        $map .= '<span class="pin_text">';
                            $map .= '<span>Georgia 4-H at</span><label>CAMP JEKYLL</label><small>Jekyll Island, GA</small>';
                        $map .= '</span>';
                    $map .= '</a>';
                $map .= '</div>';
                $map .= '<div class="MapPin MapPin6 text_left">';
                    $map .= '<a href="'.home_url().'/4-h-centers/4-h-tidelands-nature-center/" >';
                        $map .= '<span class="pin_text">';
                            $map .= '<span>Nature Center</span><label>4-H TIDELANDS</label><small>Jekyll Island, GA</small>';
                        $map .= '</span>';
                    $map .= '</a>';
                $map .= '</div>';
            $map .= '</div>';
        $map .='</div>';
    return $map;
    //echo $map;
}
add_shortcode('GeorgiaMap', 'get_our_georgia_map');

// add blog shortcode start
function g4hNews($atts = null, $content = null){

	$str = '';	
	$args = array(
			'post_type' 	 => 'post',
			'post_status'	 => 'publish',
			'posts_per_page' => 9,
	);

	if(isset($atts['category_id']) && $atts['category_id']!=''){
		$args['cat'] = $atts['category_id'];
	}

	$news = new WP_Query( $args );		
	if( $news->have_posts() ) :
	
		$str = '<div class="news shadow">';
			$str .= '<h1 class="lg-title text-center p30 m0 bgblack white  aos-init" data-aos="zoom-in">in the news</h1>';
			$str .= '<div class="NewsSlider">';
				$str .= '<div id="blog-Slider" class="blinkvideo-slider owl-carousel owl-theme">';					
					while( $news->have_posts() ) : $news->the_post();	

						$title = get_the_title();						
						$excerpt = get_the_excerpt();
						$news_link = get_permalink();                        
						$image = get_the_post_thumbnail(); 
						$str .= '<div class="item">';
							$str .= '<div class="NewsBox">';
								$str .= '<div class="News-Image">';
									if($image==''){									
										$str .= '<img src="'.OF_DIRECTORY.'/lib/timthumb.php?src='. get_stylesheet_directory_uri() . '/images/placeholder.jpg'.'&w=482&h=391&zc=1" class="velocity-animating" width="100%">';
									}else{
										$str .= '<img src="'.OF_DIRECTORY.'/lib/timthumb.php?src='. get_the_post_thumbnail_url().'&w=482&h=391&zc=1" class="velocity-animating" width="100%">';
									}
									if(strlen($excerpt)>155){
										$excerptdesc = substr($excerpt, 0, 150).'...';
									}else{
										$excerptdesc = $excerpt;
									}
									if($excerptdesc!=""){
										$str .= '<div class="News-desc">';
											$str .= '<p>'. $excerptdesc .'</p>';
										$str .= '</div>';
									}else{
										$blogstr .='<div class="News-desc">';
										$blogstr .='<p></p>
										</div>';
									}
								$str .= '</div>';	
								$str .= '<div class="News-btn">';	
	                                $str .= '<a href="'.$news_link.'"> Learn More <i class="fa fa-angle-right"></i></a>';
								$str .= '</div>';
							$str .= '</div>';
						$str .= '</div>';				
					endwhile;
				$str .= '</div>';
			$str .= '</div>';
		$str .= '</div>';
	endif;
	wp_reset_postdata();
	return $str;
}
add_shortcode( 'g4h_news', 'g4hNews' );
// add blog shortcode end
?>