<?php
/**
 * Functions and definitions
 *
 * @package eVolt
 */

if(!defined('DEV_MODE')){
    define('DEV_MODE', true);
}

if ( ! function_exists( 'evolt_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function evolt_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'evolt', get_template_directory() . '/languages' );

		// Custom Header
		add_theme_support( 'custom-header' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'evolt' ),
			'secondary' => esc_html__( 'Secondary', 'evolt' ),
			'menu-left' => esc_html__( 'Menu Left', 'evolt' ),
			'menu-right' => esc_html__( 'Menu Right', 'evolt' ),
			'menu-topbar' => esc_html__( 'Menu Topbar Header Layout 2', 'evolt' ),
			'menu-topbar2' => esc_html__( 'Menu Topbar Header Layout 3', 'evolt' ),
			'menu-shop' => esc_html__( 'Menu Shop', 'evolt' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
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
		add_theme_support( 'custom-background', apply_filters( 'evolt_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'post-formats', array (
			'',
		) );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');
        add_image_size( 'evolt-thumbnail', 58, 68, true );
        add_image_size( 'evolt-post', 870, 315, true );

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		remove_theme_support('widgets-block-editor');
	}
endif;
add_action( 'after_setup_theme', 'evolt_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function evolt_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'evolt_content_width', 640 );
}

add_action( 'after_setup_theme', 'evolt_content_width', 0 );

/**
 * Register widget area.
 */
function evolt_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'evolt' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here.', 'evolt' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	if (class_exists('ReduxFramework')) {
		register_sidebar( array(
			'name'          => esc_html__( 'Page Sidebar', 'evolt' ),
			'id'            => 'sidebar-page',
			'description'   => esc_html__( 'Add widgets here.', 'evolt' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		) );
	}

	if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'evolt' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here.', 'evolt' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		) );
	}
}

add_action( 'widgets_init', 'evolt_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function evolt_scripts() {
	$theme = wp_get_theme( get_template() );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0' );
	wp_enqueue_style( 'caseicon', get_template_directory_uri() . '/assets/css/caseicon.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '1.0.0' );
	wp_enqueue_style( 'evolt-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'evolt-style', get_stylesheet_uri() );
	wp_enqueue_style( 'evolt-google-fonts', evolt_fonts_url() );

	/* Lib JS */
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );
    wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array( 'jquery' ), 'all', true );
    wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/match-height-min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'progressbar', get_template_directory_uri() . '/assets/js/progressbar.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), '1.0.0', true );
    wp_register_script( 'evolt-cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.js', array( 'jquery' ), '1.4.1', true );

    /* Theme JS */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'evolt-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	wp_enqueue_script( 'evolt-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.js', array( 'jquery' ), $theme->get( 'Version' ), true );

    /*
     * Elementor Widget JS
     */

    // Inline CSS
    wp_enqueue_script( 'evolt-inline-css-js', get_template_directory_uri() . '/elementor/js/evolt-inline-css.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Typing Out
    wp_register_script( 'evolt-typing-out-js', get_template_directory_uri() . '/elementor/js/evolt-typingout.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Counter Widget
    wp_register_script( 'evolt-counter-widget-js', get_template_directory_uri() . '/elementor/js/evolt-counter-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Progress Bar Widget
    wp_register_script( 'evolt-progressbar-widget-js', get_template_directory_uri() . '/elementor/js/evolt-progressbar-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Pie Charts Widget
    wp_register_script( 'evolt-piecharts-widget-js', get_template_directory_uri() . '/elementor/js/evolt-piecharts-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Line Charts Widget
    wp_register_script( 'chart-js', get_template_directory_uri() . '/elementor/js/chart.min.js', array( 'jquery' ), '2.9.4', true );
    wp_register_script( 'evolt-linecharts-widget-js', get_template_directory_uri() . '/elementor/js/evolt-linecharts-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // Countdown Widget
    wp_register_script('evolt-countdown', get_template_directory_uri() . '/elementor/js/evolt-countdown.js', [ 'jquery' ], $theme->get( 'Version' ) );
    // CMS Post Carousel Widget
    wp_register_script( 'evolt-post-carousel-widget-js', get_template_directory_uri() . '/elementor/js/evolt-post-carousel-widget.js', [ 'jquery' ], $theme->get( 'Version' ) );
	wp_register_script('evolt-post-masonry-widget-js', get_template_directory_uri() . '/elementor/js/evolt-post-masonry-widget.js', [ 'isotope', 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('evolt-post-grid-widget-js', get_template_directory_uri() . '/elementor/js/evolt-post-grid-widget.js', [ 'isotope', 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('evolt-toggle-widget-js', get_template_directory_uri() . '/elementor/js/evolt-toggle-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('evolt-accordion-widget-js', get_template_directory_uri() . '/elementor/js/evolt-accordion-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('evolt-alert-widget-js', get_template_directory_uri() . '/elementor/js/evolt-alert-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_register_script('evolt-tabs-widget-js', get_template_directory_uri() . '/elementor/js/evolt-tabs-widget.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    wp_localize_script( 'evolt-post-masonry-widget-js', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'evolt_scripts' );

/* add admin styles */
function evolt_admin_style() {
	$theme = wp_get_theme( get_template() );
	wp_enqueue_style( 'evolt-admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'font-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'evolt-main-admin', get_template_directory_uri() . '/assets/js/main-admin.js', array( 'jquery' ), $theme->get( 'Version' ), true );
}

add_action( 'admin_enqueue_scripts', 'evolt_admin_style' );

/**
 * Helper functions for this theme.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Theme options
 */
require_once get_template_directory() . '/inc/theme-options.php';

/**
 * Page options
 */
require_once get_template_directory() . '/inc/page-options.php';

/**
 * CSS Generator.
 */
if ( ! class_exists( 'CSS_Generator' ) ) {
	require_once get_template_directory() . '/inc/classes/class-css-generator.php';
}

/**
 * Breadcrumb.
 */
require_once get_template_directory() . '/inc/classes/class-breadcrumb.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/* Load list require plugins */
require_once get_template_directory() . '/inc/require-plugins.php';


/**
 * Additional widgets for the theme
 */
require_once get_template_directory() . '/widgets/widget-recent-posts.php';
require_once get_template_directory() . '/widgets/class.widget-extends.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/extends.php';


if ( ! function_exists( 'evolt_fonts_url' ) ) :
	/**
	 * Register Google fonts.
	 *
	 * Create your own evolt_fonts_url() function to override in a child theme.
	 *
	 * @since league 1.1
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function evolt_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'evolt' ) ) {
			$fonts[] = 'Poppins:400,500,600,700';
		}
		
		if ( 'off' !== _x( 'on', 'Lora font: on or off', 'evolt' ) ) {
			$fonts[] = 'Lora:400,500,600,700';
		}

		if ( 'off' !== _x( 'on', 'Barlow font: on or off', 'evolt' ) ) {
			$fonts[] = 'Barlow:300,400,400i,500,500i,600,600i,700,700i';
		}

		if ( 'off' !== _x( 'on', 'Architects Daughter font: on or off', 'evolt' ) ) {
			$fonts[] = 'Architects Daughter:400';
		}

		if ( 'off' !== _x( 'on', 'Fira Sans font: on or off', 'evolt' ) ) {
			$fonts[] = 'Fira Sans:400,500,700';
		}

		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'evolt' ) ) {
			$fonts[] = 'Roboto:400,500,600,700';
		}

		if ( 'off' !== _x( 'on', 'Lexend font: on or off', 'evolt' ) ) {
			$fonts[] = 'Lexend:400,500,600,700';
		}

		if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'evolt' ) )
        {
            $fonts[] = 'Playfair Display:400,400i,700,700i,800,900';
        }

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;