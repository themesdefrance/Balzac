<?php
/**
 * Balzac functions and definitions
 *
 * @package Balzac
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define theme constants (relative to licensing)
define('BALZAC_STORE_URL', 'https://www.themesdefrance.fr');
define('BALZAC_THEME_NAME', 'Balzac');
define('BALZAC_THEME_VERSION', '1.0.2');
define('BALZAC_LICENSE_KEY', 'balzac_license_edd');

//Set the content width (in pixels) based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 720;
}

// Include theme updater (relative to licensing)
if(!class_exists('EDD_SL_Theme_Updater'))
	include(dirname( __FILE__ ).'/admin/EDD_SL_Theme_Updater.php');

// Define framework constant then load the Cocorico Framework
define('BALZAC_COCORICO_PREFIX', 'balzac_');
if(is_admin())
	require_once 'admin/Cocorico/Cocorico.php';

// Load the widgets
require 'admin/widgets/social.php';
require 'admin/widgets/calltoaction.php';
require 'admin/widgets/video.php';

// Load other theme functions
require 'admin/functions/balzac-functions.php';

//Refresh the permalink structure
add_action('after_switch_theme', 'flush_rewrite_rules');

//Remove accents in uploaded files
add_filter( 'sanitize_file_name', 'remove_accents' );

//Remove extra stuff from header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('balzac_setup')){
	function balzac_setup(){

		// Load translation
		load_theme_textdomain('balzac', get_template_directory().'/languages');

		// Register menus
		register_nav_menus( array(
			'primary'   => __('Main menu', 'balzac'),
			'footer' => __('Footer menu', 'balzac'),
		) );

		// Register sidebar
		register_sidebar(array(
			'name'          => __('Sidebar', 'balzac'),
			'id'            => 'hidden',
			'description'   => __('Add widgets in the hidden right sidebar.', 'balzac'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

		// Enable thumbnails
		add_theme_support('post-thumbnails');

		// Enable custom title tag for 4.1
		add_theme_support( 'title-tag' );

		// Enable Feed Links
		add_theme_support( 'automatic-feed-links' );

		// Enable HTML5 markup
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// Set images sizes
		set_post_thumbnail_size(1920, 454, true);
		add_image_size('balzac-post-thumbnail', 720, 445, true);

		// Add Meta boxes for post formats
		require 'admin/metaboxes/post-formats.php';

	}
}
add_action('after_setup_theme', 'balzac_setup');

/**
 * Add custom image sizes in the WordPress Media Library
 *
 * @since 1.0
 * @param array $sizes The current image sizes list
 * @return array
 */
if (!function_exists('balzac_image_size_names_choose')){
	function balzac_image_size_names_choose($sizes) {
		$added = array('balzac-post-thumbnail'=>__('Post width', 'balzac'));
		$newsizes = array_merge($sizes, $added);
		return $newsizes;
	}
}
add_filter('image_size_names_choose', 'balzac_image_size_names_choose');

/**
 * Register supported post formats
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_custom_format')){
	function balzac_custom_format() {
		$cpts = array('post' => array('video', 'link', 'quote'));
		$current_post_type = $GLOBALS['typenow'];
		if ($current_post_type == 'post') add_theme_support('post-formats', $cpts[$GLOBALS['typenow']]);
	}
}
add_action( 'load-post.php', 'balzac_custom_format' );
add_action( 'load-post-new.php', 'balzac_custom_format' );

/**
 * Enqueue styles & scripts
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('balzac_enqueue')){
	function balzac_enqueue(){

		wp_register_script('fitvids', get_template_directory_uri().'/js/min/jquery.fitvids.min.js', array('jquery'), false, true);

		wp_register_script('balzac', get_template_directory_uri().'/js/min/balzac.min.js', array('jquery'), false, true);

		wp_enqueue_style( 'balzac-fonts', '//fonts.googleapis.com/css?family=Open+Sans:600|PT+Serif:400,700&subset=latin,latin-ext');

		//main stylesheet
		wp_enqueue_style('stylesheet', get_stylesheet_directory_uri().'/style.css', array(), false);

		//icons
		wp_enqueue_style('icons', get_template_directory_uri().'/fonts/typicons.min.css', array(), false);

		wp_enqueue_script('fitvids');

		wp_enqueue_script('balzac');

		if ( is_singular() ){
			wp_enqueue_script( "comment-reply" );
		}
	}
}
add_action('wp_enqueue_scripts', 'balzac_enqueue');

/**
 * Register the theme options page in the administration
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('balzac_admin_menu')){
	function balzac_admin_menu(){
		add_theme_page(__('Balzac Settings', 'balzac'),__('Balzac Settings', 'balzac'), 'edit_theme_options', 'balzac_options', 'balzac_options');
	}
}
add_action('admin_menu', 'balzac_admin_menu');

/**
 * Loads the theme options page
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('balzac_options')){
	function balzac_options(){
		if (!current_user_can('edit_theme_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

       	include 'admin/index.php';
    }
}

/**
 * Custom CSS loading
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_custom_styles')){
	function balzac_custom_styles(){
		if (get_option("balzac_custom_css")){
			echo '<style type="text/css">';
			echo strip_tags(stripslashes(get_option("balzac_custom_css")));
			echo '</style>';
		}
	}
}
add_action('wp_head', 'balzac_custom_styles', 99);

/**
 * Applying the theme main color
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_user_styles')){
	function balzac_user_styles(){

		// Get the main color defined by the user
		if (get_option('balzac_color')){

			$color = apply_filters('balzac_color', get_option('balzac_color'));

			// Load color functions
			require_once 'admin/functions/color-functions.php';

			$hsl = balzac_RGBToHSL(balzac_HTMLToRGB($color));
			$custombg = balzac_HSLToHTML($hsl->hue, $hsl->saturation, $hsl->lightness, 0.35);
			
			if ($hsl->lightness > 180){
				$contrast = apply_filters('balzac_color_contrast', '#333');
			}
			else{
				$contrast = apply_filters('balzac_color_contrast', '#fff');
			}

			$hsl->lightness -= 30;
			$complement = apply_filters('balzac_color_complement', balzac_HSLToHTML($hsl->hue, $hsl->saturation, $hsl->lightness));
		}
		else{
			// If not, use the default colors
			$color = '#3ab2a0';
			$complement = '#2B8577';
			$contrast = '#fff';
			$custombg = 'rgba(58,178,160,0.35)';
		}
		?>
			<style type="text/css">

			.site-header a.logo-text:hover,
			#site-breadcrumbs a,
			.entry-meta a,
			.entry-content a,
			.entry-navigation a,
			.footer a,
			.footer-wrapper .footer-bar a:hover,
			.widget_balzacsocial ul li a,
			.entry-title a,
			.entry-meta a,
			.entry-content a,
			.entry-footer-meta a,
			.comment-navigation a,
			#respond a,
			.comment-author a,
			.comment-reply-link,
			.widget a,
			.comment-form .logged-in-as a,
			.sidebar .top-level-menu a,
			.footer-wrapper .site-footer a{
				color: <?php echo $color; ?>;
			}
			
			#toggle-sidebar-icon:hover,
			.content a:hover,
			.footer a:hover,
			.entry-meta a:hover,
			.entry-content a:hover,
			.entry-footer-meta a:hover,
			.comment-author a:hover,
			.comment-reply-link:hover,
			#sidebar-close:hover,
			.widget a:hover,
			.widget_balzacsocial ul li a:hover,
			.comment-form .logged-in-as a:hover,
			.footer-wrapper .site-footer a:hover{
				color: <?php echo $complement; ?>;
			}

			.entry-thumbnail a.entry-permalink:hover,
			.entry-thumbnail a.entry-permalink:hover:before,
			.entry-quote a,
			.entry-quote-author,
			.entry-quote a:hover,
			.entry-link a,
			.entry-link a:hover,
			.pagination a:hover{
				color:<?php echo $contrast; ?>;
			}

			.button,
			.readmore a,
			.site-header .main-menu li:hover > a,
			.comment-form input[type="submit"],
			html a.button,
			input[type='submit'],
			input[type='button'],
			.widget_tag_cloud a:hover,
			.widget_calendar #next a,
			.widget_calendar #prev a,
			.widget_balzaccalltoaction a.button,
			.widget_nav_menu a:hover,
			.sidebar .top-level-menu a:hover,
			.search-form .submit-btn,
			.entry-quote,
			.entry-link,
			.entry-thumbnail:hover,
			.entry-navigation a:hover,
			.pagination span,
			.pagination a.current,
			.pagination a:hover,
			.back-to-top{
				background-color: <?php echo $color; ?>;
				color: <?php echo $contrast; ?>;
			}
			.button:hover,
			.readmore a:hover,
			.comment-form input[type="submit"]:hover,
			html a.button:hover,
			input[type='submit']:hover,
			input[type='button']:hover,
			.widget_calendar #next a:hover,
			.widget_calendar #prev a:hover,
			.widget_balzaccalltoaction a.button:hover,
			.search-form .submit-btn:hover,
			.entry-quote:hover,
			.entry-link:hover,
			.entry-pagination:hover,
			.back-to-top:hover{
				background-color: <?php echo $complement; ?>;
				color: <?php echo $contrast; ?>;
			}
			
			.widget_balzacsocial a{
				background-color: <?php echo $contrast; ?>;
				color: <?php echo $color; ?>;
			}
			
			.widget_tag_cloud a:hover,
			input[type='text']:focus,
			input[type='email']:focus,
			input[type='url']:focus,
			input[type='tel']:focus,
			input[type='number']:focus,
			input[type='date']:focus,
			textarea:focus,
			select:focus{
				border-color:<?php echo $color; ?>;
				box-shadow: 0 0 5px <?php echo $color; ?>;
			}

			.entry-thumbnail a.entry-permalink:hover{
				background-color: <?php echo $custombg; ?>;
			}

			</style>
<?php }
}
add_action('wp_head','balzac_user_styles', 98);


/**
 * License activation stuff (from Easy Digital Downloads Software Licensing Addon)
 * This function will activate the theme licence on Themes de France
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_edd')){
	function balzac_edd(){
		$license = trim(get_option(BALZAC_LICENSE_KEY));
		$status = get_option('balzac_license_status');

		// No license is activated yet
		if (!$status){

			// Activate the license
			$api_params = array(
				'edd_action'=>'activate_license',
				'license'=>$license,
				'item_name'=>urlencode(BALZAC_THEME_NAME)
			);

			$response = wp_remote_get(add_query_arg($api_params, BALZAC_STORE_URL), array('timeout'=>15, 'sslverify'=>false));

			if (!is_wp_error($response)){
				$license_data = json_decode(wp_remote_retrieve_body($response));
				if ($license_data->license === 'valid') update_option('balzac_license_status', true);
			}
		}

		$edd_updater = new EDD_SL_Theme_Updater(array(
				'remote_api_url'=> BALZAC_STORE_URL,
				'version' 	=> BALZAC_THEME_VERSION,
				'license' 	=> $license,
				'item_name' => BALZAC_THEME_NAME,
				'author'	=> __('Themes de France','balzac')
			)
		);
	}
}
add_action('admin_init', 'balzac_edd');

/**
 * Display an admin notice if the licence isn't activated
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_admin_notice')){
	function balzac_admin_notice(){
		global $current_user;
        $user_id = $current_user->ID;

		if(current_user_can('edit_theme_options')){

			if(!get_option('balzac_license_status')){

				if ( ! get_user_meta($user_id, 'ignore_licensebalzac_notice') ) {
					echo '<div class="error"><p>';

						printf(__("To get Balzac updates, please enter the licence key that you received by email on the Balzac options page. | <a href='%s'>I'm not interested</a>", 'balzac'), '?ignore_notice=licensebalzac');

					echo '</p></div>';
				}
			}
		}
	}
}
add_action('admin_notices', 'balzac_admin_notice');

/**
 * Hide admin notice if the user isn't interested by Balzac updates
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('balzac_admin_ignore')){
	function balzac_admin_ignore() {
	
	    global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['ignore_notice']) && 'licensebalzac' == $_GET['ignore_notice'] ) {
             add_user_meta($user_id, 'ignore_licensebalzac_notice', 'true', true);
	    }
	}
}
add_action('admin_init', 'balzac_admin_ignore');