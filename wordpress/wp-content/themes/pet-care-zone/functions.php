<?php
/**
 * Pet Care Zone functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pet Care Zone
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Pet_Care_Zone_Loader.php' );

$pet_care_zone_loader = new \WPTRT\Autoload\Pet_Care_Zone_Loader();

$pet_care_zone_loader->pet_care_zone_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$pet_care_zone_loader->pet_care_zone_register();

if ( ! function_exists( 'pet_care_zone_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pet_care_zone_setup() {

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        add_image_size('pet-care-zone-featured-header-image', 2000, 660, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','pet-care-zone' ),
	        'footer'=> esc_html__( 'Footer Menu','pet-care-zone' ),
        ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pet_care_zone_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_pet_care_zone_dismissable_notice', 'pet_care_zone_dismissable_notice');
	}
endif;
add_action( 'after_setup_theme', 'pet_care_zone_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pet_care_zone_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pet_care_zone_content_width', 1170 );
}
add_action( 'after_setup_theme', 'pet_care_zone_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pet_care_zone_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pet-care-zone' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'pet-care-zone' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Shop Page Sidebar', 'pet-care-zone' ),
		'id'            => 'woocommerce-shop-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Single Product Page Sidebar', 'pet-care-zone' ),
		'id'            => 'woocommerce-single-product-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'pet-care-zone' ),
		'id'            => 'pet-care-zone-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'pet-care-zone' ),
		'id'            => 'pet-care-zone-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'pet-care-zone' ),
		'id'            => 'pet-care-zone-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'pet_care_zone_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pet_care_zone_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'roboto',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'pacifico',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Pacifico&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'pet-care-zone-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()) . '/assets/css/bootstrap.css');

	wp_enqueue_style( 'pet-care-zone-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'pet-care-zone-style',$pet_care_zone_theme_css );

	wp_style_add_data('pet-care-zone-basic-style', 'rtl', 'replace');

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', esc_url(get_template_directory_uri()).'/assets/css/fontawesome/css/all.css' );

	wp_enqueue_style( 'owl.carousel-style', esc_url(get_template_directory_uri()).'/assets/css/owl.carousel.css' );

    wp_enqueue_script('owl.carousel-js', esc_url(get_template_directory_uri()) . '/assets/js/owl.carousel.js', array('jquery'), '', true );

    wp_enqueue_script('pet-care-zone-theme-js', esc_url(get_template_directory_uri()) . '/assets/js/theme-script.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pet_care_zone_scripts' );

/**
 * Enqueue S Header.
 */
function pet_care_zone_sticky_header() {

  $pet_care_zone_sticky_header = get_theme_mod('pet_care_zone_sticky_header');

  $pet_care_zone_custom_style= "";

  if($pet_care_zone_sticky_header != true){

    $pet_care_zone_custom_style .='.stick_header{';

      $pet_care_zone_custom_style .='position: static;';

    $pet_care_zone_custom_style .='}';
  }

  wp_add_inline_style( 'pet-care-zone-style',$pet_care_zone_custom_style );

}
add_action( 'wp_enqueue_scripts', 'pet_care_zone_sticky_header' );

/**
 * Enqueue Preloader.
 */
function pet_care_zone_preloader() {

  $pet_care_zone_theme_color_css = '';
  $pet_care_zone_preloader_bg_color = get_theme_mod('pet_care_zone_preloader_bg_color');
  $pet_care_zone_theme_color = get_theme_mod('pet_care_zone_theme_color');
  $pet_care_zone_theme_color_2 = get_theme_mod('pet_care_zone_theme_color_2');
  $pet_care_zone_preloader_dot_1_color = get_theme_mod('pet_care_zone_preloader_dot_1_color');
  $pet_care_zone_preloader_dot_2_color = get_theme_mod('pet_care_zone_preloader_dot_2_color');
  $pet_care_zone_logo_max_height = get_theme_mod('pet_care_zone_logo_max_height');

	if(get_theme_mod('pet_care_zone_logo_max_height') == '') {
		$pet_care_zone_logo_max_height = '24';
	}
	if(get_theme_mod('pet_care_zone_preloader_bg_color') == '') {
		$pet_care_zone_preloader_bg_color = '#000';
	}
	if(get_theme_mod('pet_care_zone_preloader_dot_1_color') == '') {
		$pet_care_zone_preloader_dot_1_color = '#fff';
	}
	if(get_theme_mod('pet_care_zone_preloader_dot_2_color') == '') {
		$pet_care_zone_preloader_dot_2_color = '#033e4f';
	}
	$pet_care_zone_theme_color_css = '
	.custom-logo-link img{
			max-height: '.esc_attr($pet_care_zone_logo_max_height).'px;
		 }
		 #button,.top-info,.sidebar input[type="submit"],.sidebar button[type="submit"],span.onsale,.pro-button a,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.pro-button a:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce .woocommerce-ordering select,.comment-respond input#submit,#colophon, .widget a:focus,.sidebar h5,.sidebar .tagcloud a:hover,.toggle-nav i,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.main-navigation .sub-menu > li > a,.woocommerce a.added_to_cart{
			background: '.esc_attr($pet_care_zone_theme_color).';
		 }
		 a:hover,h1,h2,h3,h4,h5,h6,.article-box a,p.price,.woocommerce ul.products li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce-message::before,.woocommerce-info::before,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.main-navigation .sub-menu,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,span.wp-calendar-nav-prev a{
			color: '.esc_attr($pet_care_zone_theme_color).';
		 }
		.addtocart a:hover,.woocommerce-message,.woocommerce-info,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.wp-block-quote, .wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-pullquote {
			border-color: '.esc_attr($pet_care_zone_theme_color).';
		 }
		 @media screen and (max-width:1000px){
		 	.sidenav {
			background: '.esc_attr($pet_care_zone_theme_color).';
		 	}
		}
		.pro-button a:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover,.main-navigation .sub-menu > li > a:hover,#button:hover,.topbtn,.woocommerce a.added_to_cart:hover,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale {
			background: '.esc_attr($pet_care_zone_theme_color_2).';
		 }
		  a.woocommerce ul.products li.product .star-rating, .woocommerce .star-rating{
			color: '.esc_attr($pet_care_zone_theme_color_2).';
		 }
		.loading{
			background-color: '.esc_attr($pet_care_zone_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($pet_care_zone_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($pet_care_zone_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'pet-care-zone-style',$pet_care_zone_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'pet_care_zone_preloader' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
	* Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*dropdown page sanitization*/
function pet_care_zone_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function pet_care_zone_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function pet_care_zone_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function pet_care_zone_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}
 //Float
function pet_care_zone_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function pet_care_zone_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

/*radio button sanitization*/
function pet_care_zone_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'pet_care_zone_loop_columns');
if (!function_exists('pet_care_zone_loop_columns')) {
	function pet_care_zone_loop_columns() {
		$columns = get_theme_mod( 'pet_care_zone_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'pet_care_zone_shop_per_page', 9 );
function pet_care_zone_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'pet_care_zone_product_per_page', 9 );
	return $cols;
}

/**
 * Get CSS
 */

function pet_care_zone_getpage_css($hook) {
	wp_enqueue_script( 'pet-care-zone-admin-script', get_template_directory_uri() . '/inc/admin/js/pet-care-zone-admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script( 'pet-care-zone-admin-script', 'pet_care_zone_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_pet-care-zone-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'pet-care-zone-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'pet_care_zone_getpage_css' );

if ( ! defined( 'PET_CARE_ZONE_CONTACT_SUPPORT' ) ) {
define('PET_CARE_ZONE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/pet-care-zone','pet-care-zone'));
}
if ( ! defined( 'PET_CARE_ZONE_REVIEW' ) ) {
define('PET_CARE_ZONE_REVIEW',__('https://wordpress.org/support/theme/pet-care-zone/reviews/#new-post','pet-care-zone'));
}
if ( ! defined( 'PET_CARE_ZONE_LIVE_DEMO' ) ) {
define('PET_CARE_ZONE_LIVE_DEMO',__('https://www.themagnifico.net/demo/pet-care-zone/','pet-care-zone'));
}
if ( ! defined( 'PET_CARE_ZONE_GET_PREMIUM_PRO' ) ) {
define('PET_CARE_ZONE_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/pet-wordpress-theme/','pet-care-zone'));
}
if ( ! defined( 'PET_CARE_ZONE_PRO_DOC' ) ) {
define('PET_CARE_ZONE_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/pet-care-zone-pro-doc/','pet-care-zone'));
}

add_action('admin_menu', 'pet_care_zone_themepage');
function pet_care_zone_themepage(){

	$pet_care_zone_theme_test = wp_get_theme();
	
	$theme_info = add_theme_page( __('Theme Options','pet-care-zone'), __('Theme Options','pet-care-zone'), 'manage_options', 'pet-care-zone-info.php', 'pet_care_zone_info_page' );
}

function pet_care_zone_info_page() {
	$user = wp_get_current_user();
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap pet-care-zone-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','pet-care-zone'); ?><?php echo esc_html( $theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "pet-care-zone"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Pet Care Zone , feel free to contact us for any support regarding our theme.", "pet-care-zone"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( PET_CARE_ZONE_CONTACT_SUPPORT ); ?>" class="button button-primary solo">
							<?php esc_html_e("Contact Support", "pet-care-zone"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "pet-care-zone"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "pet-care-zone"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( PET_CARE_ZONE_GET_PREMIUM_PRO ); ?>" class="button button-primary solo">
							<?php esc_html_e("Get Premium", "pet-care-zone"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "pet-care-zone"); ?></h3>
						<p><?php esc_html_e("If You love Pet Care Zone theme then we would appreciate your review about our theme.", "pet-care-zone"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( PET_CARE_ZONE_REVIEW ); ?>" class="button button-primary solo">
							<?php esc_html_e("Review", "pet-care-zone"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php esc_html_e("Free Vs Premium","pet-care-zone"); ?></h2>
		<div class="pet-care-zone-button-container">
			<a target="_blank" href="<?php echo esc_url( PET_CARE_ZONE_PRO_DOC ); ?>" class="button button-primary solo">
				<?php esc_html_e("Checkout Documentation", "pet-care-zone"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( PET_CARE_ZONE_LIVE_DEMO ); ?>" class="button button-primary solo">
				<?php esc_html_e("View Theme Demo", "pet-care-zone"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "pet-care-zone"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "pet-care-zone"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "pet-care-zone"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "pet-care-zone"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "pet-care-zone"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "pet-care-zone"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Premium Support", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "pet-care-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="pet-care-zone-button-container">
			<a target="_blank" href="<?php echo esc_url( PET_CARE_ZONE_GET_PREMIUM_PRO ); ?>" class="button button-primary solo">
				<?php esc_html_e("Go Premium", "pet-care-zone"); ?>
			</a>
		</div>
	</div>
	<?php
}

//Admin Notice For Getstart
function pet_care_zone_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function pet_care_zone_deprecated_hook_admin_notice() {

    $dismissed = get_user_meta(get_current_user_id(), 'pet_care_zone_dismissable_notice', true);
    if ( !$dismissed) { ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
	    	<div class="tm-admin-image">
	    		<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
	    	</div>
	    	<div class="tm-admin-content" style="padding-left: 30px; align-self: center">
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'pet-care-zone'); ?><?php echo wp_get_theme(); ?><h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'pet-care-zone'); ?><p>
	        	<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=pet-care-zone-info.php' )); ?>"><?php esc_html_e( 'Get started', 'pet-care-zone' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( PET_CARE_ZONE_PRO_DOC ); ?>"><?php esc_html_e( 'Documentation', 'pet-care-zone' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span class="dashicons dashicons-admin-links"></span>
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( PET_CARE_ZONE_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'pet-care-zone' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'pet_care_zone_deprecated_hook_admin_notice' );

function pet_care_zone_switch_theme() {
    delete_user_meta(get_current_user_id(), 'pet_care_zone_dismissable_notice');
}
add_action('after_switch_theme', 'pet_care_zone_switch_theme');
function pet_care_zone_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'pet_care_zone_dismissable_notice', true);
    die();
}