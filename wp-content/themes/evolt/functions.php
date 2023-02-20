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
		
		if ( 'off' !== _x( 'on', 'Jost font: on or off', 'evolt' ) ) {
			$fonts[] = 'Jost:400,500,600,700';
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

//Custom

// ---------------------------------------------
// Remove Cross Sells From Default Position 
 
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
 
 
// ---------------------------------------------
// Add them back UNDER the Cart Table
 
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

//-----------------------------------------Add Confirm Password Field-----------------------------------------------

// Add a second password field to the checkout page in WC 3.x.
add_filter( 'woocommerce_checkout_fields', 'wc_add_confirm_password_checkout', 10, 1 );
function wc_add_confirm_password_checkout( $checkout_fields ) {
    if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {
        $checkout_fields['account']['account_password2'] = array(
                'type'              => 'password',
                'label'             => __( 'Confirm password', 'woocommerce' ),
                'required'          => true,
                'placeholder'       => _x( 'Confirm Password', 'placeholder', 'woocommerce' )
        );
    }

    return $checkout_fields;
}

// Check the password and confirm password fields match before allow checkout to proceed.
add_action( 'woocommerce_after_checkout_validation', 'wc_check_confirm_password_matches_checkout', 10, 2 );
function wc_check_confirm_password_matches_checkout( $posted ) {
    $checkout = WC()->checkout;
    if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_password2'] ) !== 0 ) {
            wc_add_notice( __( 'Passwords do not match.', 'woocommerce' ), 'error' );
        }
    }
}

//---------------------------------------------------------------------------------------------------------------------

//---------------------------------------------Mini cart quantity update ajax------------------------------------------
function ajax_qty_cart() {
	$response = "";
    // Set item key as the hash found in input.qty's name
    $cart_item_key = $_POST['cart_item_key'];

    // Get the array of values owned by the product we're updating
    $threeball_product_values = WC()->cart->get_cart_item( $cart_item_key );

    // Get the quantity of the item in the cart
    $threeball_product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT)) ), $cart_item_key );

    // Update cart validation
    $passed_validation  = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity );

    // Update the quantity of the item in the cart
    if ( $passed_validation ) {
        WC()->cart->set_quantity( $cart_item_key, $threeball_product_quantity, true );
		$response = "success";
    }else{
		$response = "failed";
	}

    // Refresh the page
    echo $response;

    die();

}

add_action('wp_ajax_qty_cart', 'ajax_qty_cart');
add_action('wp_ajax_nopriv_qty_cart', 'ajax_qty_cart');

//---------------------------------------------------------------------------------------------------------------------

//---------------------------------------Admin ajax file url embed on front-end----------------------------------------

add_action("wp_head","admin_ajax_url");

function admin_ajax_url(){
	?>
	<script>
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>
	<?php
}

//---------------------------------------------------------------------------------------------------------------------

//-------------------------------------Reorder columns (My orders in my account)---------------------------------------
function woodmart_custom_account_orders_columns() {
	$columns = array(
		'order-number'  => __( 'Id', 'woocommerce' ),
		'order-total'   => __( 'Total price', 'woocommerce' ),
		'order-status'  => __( 'Payment status', 'woocommerce' ),
		'order-date'    => __( 'Date', 'woocommerce' ),
		'order-actions' => __( 'Details', 'woocommerce' ),
	);

	return $columns;
}

add_filter( 'woocommerce_account_orders_columns', 'woodmart_custom_account_orders_columns' );

//---------------------------------------------------------------------------------------------------------------------

//----------------------------------------------Empty Cart Image-------------------------------------------------------

remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
add_action( 'woocommerce_cart_is_empty', 'custom_empty_cart_message', 10 );

function custom_empty_cart_message() {
    $html  = '<div class="col-12 offset-md-1 col-md-10">
	<svg width="625" height="323" viewBox="0 0 625 323" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M378.35 16.301H343.597C341.614 16.301 340 14.6866 340 12.704C340 10.7214 341.614 9.10693 343.597 9.10693H378.35C380.332 9.10693 381.947 10.7214 381.947 12.704C381.947 14.6866 380.332 16.301 378.35 16.301ZM343.597 10.2682C342.238 10.2682 341.133 11.3728 341.133 12.7323C341.133 14.0918 342.238 15.1964 343.597 15.1964H378.35C379.709 15.1964 380.814 14.0918 380.814 12.7323C380.814 11.3728 379.709 10.2682 378.35 10.2682H343.597Z" fill="#E1DCDC"/>
	<path d="M416.01 171.008H381.257C379.275 171.008 377.66 169.394 377.66 167.411C377.66 165.428 379.275 163.814 381.257 163.814H416.01C417.992 163.814 419.607 165.428 419.607 167.411C419.607 169.394 417.992 171.008 416.01 171.008ZM381.257 164.975C379.898 164.975 378.793 166.08 378.793 167.439C378.793 168.799 379.898 169.903 381.257 169.903H416.01C417.369 169.903 418.474 168.799 418.474 167.439C418.474 166.08 417.369 164.975 416.01 164.975H381.257Z" fill="#E1DCDC"/>
	<path d="M568.955 214.059H534.203C532.22 214.059 530.605 212.444 530.605 210.462C530.605 208.479 532.22 206.865 534.203 206.865H568.955C570.938 206.865 572.552 208.479 572.552 210.462C572.552 212.444 570.938 214.059 568.955 214.059ZM534.203 208.026C532.843 208.026 531.738 209.131 531.738 210.49C531.738 211.85 532.843 212.954 534.203 212.954H568.955C570.315 212.954 571.419 211.85 571.419 210.49C571.419 209.131 570.315 208.026 568.955 208.026H534.203Z" fill="#E1DCDC"/>
	<path d="M94.256 201.597H59.5033C57.5207 201.597 55.9062 199.983 55.9062 198C55.9062 196.017 57.5207 194.403 59.5033 194.403H94.256C96.2386 194.403 97.853 196.017 97.853 198C97.853 199.983 96.2386 201.597 94.256 201.597ZM59.5033 195.564C58.1438 195.564 57.0392 196.669 57.0392 198.028C57.0392 199.388 58.1438 200.492 59.5033 200.492H94.256C95.6155 200.492 96.7201 199.388 96.7201 198.028C96.7201 196.669 95.6155 195.564 94.256 195.564H59.5033Z" fill="#E1DCDC"/>
	<path d="M187.897 77.7761H157.648C155.665 77.7761 154.051 76.1617 154.051 74.1791C154.051 72.1965 155.665 70.582 157.648 70.582H187.897C189.88 70.582 191.494 72.1965 191.494 74.1791C191.494 76.1617 189.88 77.7761 187.897 77.7761ZM157.648 71.715C156.288 71.715 155.184 72.8196 155.184 74.1791C155.184 75.5386 156.288 76.6432 157.648 76.6432H187.897C189.257 76.6432 190.361 75.5386 190.361 74.1791C190.361 72.8196 189.257 71.715 187.897 71.715H157.648Z" fill="#E1DCDC"/>
	<path d="M159.204 153.249C156.711 153.249 154.672 151.209 154.672 148.717C154.672 146.224 156.711 144.185 159.204 144.185C161.696 144.185 163.735 146.224 163.735 148.717C163.735 151.209 161.724 153.249 159.204 153.249ZM159.204 145.318C157.334 145.318 155.805 146.847 155.805 148.717C155.805 150.586 157.334 152.116 159.204 152.116C161.073 152.116 162.602 150.586 162.602 148.717C162.602 146.847 161.101 145.318 159.204 145.318Z" fill="#E1DCDC"/>
	<path d="M304.786 144.384C302.293 144.384 300.254 142.345 300.254 139.853C300.254 137.36 302.293 135.321 304.786 135.321C307.278 135.321 309.317 137.36 309.317 139.853C309.317 142.345 307.306 144.384 304.786 144.384ZM304.786 136.454C302.916 136.454 301.387 137.983 301.387 139.853C301.387 141.722 302.916 143.251 304.786 143.251C306.655 143.251 308.184 141.722 308.184 139.853C308.184 137.983 306.683 136.454 304.786 136.454Z" fill="#E1DCDC"/>
	<path d="M7.53172 67.5229C5.03927 67.5229 3 65.4836 3 62.9912C3 60.4987 5.03927 58.4595 7.53172 58.4595C10.0242 58.4595 12.0634 60.4987 12.0634 62.9912C12.0634 65.4836 10.0242 67.5229 7.53172 67.5229ZM7.53172 59.5924C5.66239 59.5924 4.13293 61.1219 4.13293 62.9912C4.13293 64.8605 5.66239 66.39 7.53172 66.39C9.40106 66.39 10.9305 64.8605 10.9305 62.9912C10.9305 61.1219 9.40106 59.5924 7.53172 59.5924Z" fill="#E1DCDC"/>
	<path d="M178.493 9.06344C176 9.06344 173.961 7.02417 173.961 4.53172C173.961 2.03927 176 0 178.493 0C180.985 0 183.024 2.03927 183.024 4.53172C183.024 7.02417 180.985 9.06344 178.493 9.06344ZM178.493 1.13293C176.623 1.13293 175.094 2.66239 175.094 4.53172C175.094 6.40106 176.623 7.93051 178.493 7.93051C180.362 7.93051 181.891 6.40106 181.891 4.53172C181.891 2.66239 180.362 1.13293 178.493 1.13293Z" fill="#E1DCDC"/>
	<path d="M617.188 161.492C614.696 161.492 612.656 159.452 612.656 156.96C612.656 154.467 614.696 152.428 617.188 152.428C619.68 152.428 621.72 154.467 621.72 156.96C621.72 159.452 619.68 161.492 617.188 161.492ZM617.188 153.561C615.319 153.561 613.789 155.091 613.789 156.96C613.789 158.829 615.319 160.359 617.188 160.359C619.057 160.359 620.587 158.829 620.587 156.96C620.587 155.091 619.057 153.561 617.188 153.561Z" fill="#E1DCDC"/>
	<path d="M486.25 139.286C483.758 139.286 481.719 137.246 481.719 134.754C481.719 132.261 483.758 130.222 486.25 130.222C488.743 130.222 490.782 132.261 490.782 134.754C490.782 137.246 488.743 139.286 486.25 139.286ZM486.25 131.355C484.381 131.355 482.852 132.885 482.852 134.754C482.852 136.623 484.381 138.153 486.25 138.153C488.12 138.153 489.649 136.623 489.649 134.754C489.649 132.885 488.12 131.355 486.25 131.355Z" fill="#E1DCDC"/>
	<path d="M619.766 81.5717C617.274 81.5717 615.234 79.5325 615.234 77.04C615.234 74.5476 617.274 72.5083 619.766 72.5083C622.259 72.5083 624.298 74.5476 624.298 77.04C624.298 79.5325 622.259 81.5717 619.766 81.5717ZM619.766 73.6412C617.897 73.6412 616.367 75.1707 616.367 77.04C616.367 78.9094 617.897 80.4388 619.766 80.4388C621.635 80.4388 623.165 78.9094 623.165 77.04C623.165 75.1707 621.635 73.6412 619.766 73.6412Z" fill="#E1DCDC"/>
	<path d="M444.731 72.5073C442.238 72.5073 440.199 70.468 440.199 67.9756C440.199 65.4831 442.238 63.4438 444.731 63.4438C447.223 63.4438 449.263 65.4831 449.263 67.9756C449.263 70.468 447.223 72.5073 444.731 72.5073ZM444.731 64.5768C442.862 64.5768 441.332 66.1062 441.332 67.9756C441.332 69.8449 442.862 71.3744 444.731 71.3744C446.6 71.3744 448.13 69.8449 448.13 67.9756C448.13 66.1062 446.6 64.5768 444.731 64.5768Z" fill="#E1DCDC"/>
	<path d="M4.53172 197.037C2.03927 197.037 0 194.998 0 192.505C0 190.013 2.03927 187.974 4.53172 187.974C7.02417 187.974 9.06344 190.013 9.06344 192.505C9.06344 194.998 7.05249 197.037 4.53172 197.037ZM4.53172 189.107C2.66239 189.107 1.13293 190.636 1.13293 192.505C1.13293 194.375 2.66239 195.904 4.53172 195.904C6.40106 195.904 7.93051 194.375 7.93051 192.505C7.93051 190.636 6.40106 189.107 4.53172 189.107Z" fill="#E1DCDC"/>
	<path d="M50.5634 299.635C55.8775 299.635 60.1854 294.401 60.1854 287.944C60.1854 281.487 55.8775 276.253 50.5634 276.253C45.2493 276.253 40.9414 281.487 40.9414 287.944C40.9414 294.401 45.2493 299.635 50.5634 299.635Z" fill="#DBC9C9"/>
	<path d="M50.5632 307.169C50.3544 307.169 50.1836 306.999 50.1836 306.79V292.499C50.1836 292.29 50.3544 292.12 50.5632 292.12C50.7719 292.12 50.9427 292.29 50.9427 292.499V306.79C50.9427 306.999 50.7719 307.169 50.5632 307.169Z" fill="#D0BBBB"/>
	<path d="M35.9273 300.014C30.4047 300.014 25.9258 294.606 25.9258 287.944C25.9258 281.283 30.4047 275.874 35.9273 275.874C41.45 275.874 45.9289 281.283 45.9289 287.944C45.9289 294.606 41.45 300.014 35.9273 300.014ZM35.9273 276.652C30.8222 276.652 26.6849 281.719 26.6849 287.963C26.6849 294.207 30.8412 299.274 35.9273 299.274C41.0135 299.274 45.1698 294.207 45.1698 287.963C45.1698 281.719 41.0325 276.652 35.9273 276.652Z" fill="#D0BBBB"/>
	<path d="M35.9264 307.169C35.7177 307.169 35.5469 306.999 35.5469 306.79V292.499C35.5469 292.29 35.7177 292.12 35.9264 292.12C36.1352 292.12 36.306 292.29 36.306 292.499V306.79C36.306 306.999 36.1352 307.169 35.9264 307.169Z" fill="#D0BBBB"/>
	<path d="M109.053 307.016H72.8991C72.6903 307.016 72.5195 306.846 72.5195 306.637V264.296C72.5195 264.088 72.6903 263.917 72.8991 263.917H81.9897V239.871C81.9897 239.663 82.1605 239.492 82.3693 239.492H99.6016C99.8103 239.492 99.9811 239.663 99.9811 239.871V263.917H109.072C109.28 263.917 109.451 264.088 109.451 264.296V306.637C109.432 306.846 109.262 307.016 109.053 307.016ZM73.2787 306.257H108.692V264.676H99.6016C99.3928 264.676 99.222 264.505 99.222 264.296V240.251H82.7488V264.296C82.7488 264.505 82.578 264.676 82.3693 264.676H73.2787V306.257Z" fill="#D0BBBB"/>
	<path d="M95.4283 246.855H86.5085C86.2997 246.855 86.1289 246.684 86.1289 246.475C86.1289 246.267 86.2997 246.096 86.5085 246.096H95.4283C95.637 246.096 95.8078 246.267 95.8078 246.475C95.8078 246.684 95.656 246.855 95.4283 246.855Z" fill="#D0BBBB"/>
	<path d="M95.4283 252.548H86.5085C86.2997 252.548 86.1289 252.377 86.1289 252.169C86.1289 251.96 86.2997 251.789 86.5085 251.789H95.4283C95.637 251.789 95.8078 251.96 95.8078 252.169C95.8078 252.377 95.656 252.548 95.4283 252.548Z" fill="#D0BBBB"/>
	<path d="M95.4283 258.243H86.5085C86.2997 258.243 86.1289 258.072 86.1289 257.863C86.1289 257.654 86.2997 257.483 86.5085 257.483H95.4283C95.637 257.483 95.8078 257.654 95.8078 257.863C95.8078 258.072 95.656 258.243 95.4283 258.243Z" fill="#D0BBBB"/>
	<path d="M99.5767 264.676H82.3444C82.1356 264.676 81.9648 264.505 81.9648 264.296C81.9648 264.087 82.1356 263.917 82.3444 263.917H99.5767C99.7855 263.917 99.9563 264.087 99.9563 264.296C99.9563 264.505 99.8044 264.676 99.5767 264.676Z" fill="#D0BBBB"/>
	<path d="M102.637 285.552H79.3132C79.1044 285.552 78.9336 285.381 78.9336 285.172C78.9336 284.963 79.1044 284.792 79.3132 284.792H102.637C102.846 284.792 103.017 284.963 103.017 285.172C103.017 285.381 102.846 285.552 102.637 285.552Z" fill="#D0BBBB"/>
	<path d="M102.637 291.643H79.3132C79.1044 291.643 78.9336 291.473 78.9336 291.264C78.9336 291.055 79.1044 290.884 79.3132 290.884H102.637C102.846 290.884 103.017 291.055 103.017 291.264C103.017 291.473 102.846 291.643 102.637 291.643Z" fill="#D0BBBB"/>
	<path d="M103.381 272.115H99.0352V276.461H103.381V272.115Z" fill="#DBC9C9"/>
	<path d="M93.1546 272.115H88.8086V276.461H93.1546V272.115Z" fill="#DBC9C9"/>
	<path d="M82.9202 272.115H78.5742V276.461H82.9202V272.115Z" fill="#DBC9C9"/>
	<path d="M164.62 307.131H130.497C130.288 307.131 130.117 306.96 130.117 306.751V212.505C130.117 212.296 130.288 212.125 130.497 212.125H142.358C142.567 212.125 142.738 212.296 142.738 212.505V247.311H164.62C164.828 247.311 164.999 247.482 164.999 247.691V306.751C164.999 306.96 164.828 307.131 164.62 307.131ZM130.876 306.372H164.24V248.07H142.358C142.149 248.07 141.979 247.9 141.979 247.691V212.885H130.876V306.372Z" fill="#D0BBBB"/>
	<path d="M158.049 266.973H149.13C148.921 266.973 148.75 266.802 148.75 266.593C148.75 266.384 148.921 266.213 149.13 266.213H158.049C158.258 266.213 158.429 266.384 158.429 266.593C158.429 266.802 158.277 266.973 158.049 266.973Z" fill="#D0BBBB"/>
	<path d="M158.049 272.666H149.13C148.921 272.666 148.75 272.495 148.75 272.286C148.75 272.077 148.921 271.907 149.13 271.907H158.049C158.258 271.907 158.429 272.077 158.429 272.286C158.429 272.495 158.277 272.666 158.049 272.666Z" fill="#D0BBBB"/>
	<path d="M158.049 278.36H149.13C148.921 278.36 148.75 278.189 148.75 277.981C148.75 277.772 148.921 277.601 149.13 277.601H158.049C158.258 277.601 158.429 277.772 158.429 277.981C158.429 278.189 158.277 278.36 158.049 278.36Z" fill="#D0BBBB"/>
	<path d="M136.133 306.998C135.925 306.998 135.754 306.828 135.754 306.619V212.486C135.754 212.278 135.925 212.107 136.133 212.107C136.342 212.107 136.513 212.278 136.513 212.486V306.619C136.513 306.828 136.342 306.998 136.133 306.998Z" fill="#D0BBBB"/>
	<path d="M142.352 307.131C142.143 307.131 141.973 306.96 141.973 306.751V247.691C141.973 247.482 142.143 247.311 142.352 247.311C142.561 247.311 142.732 247.482 142.732 247.691V306.751C142.732 306.96 142.561 307.131 142.352 307.131Z" fill="#D0BBBB"/>
	<path d="M217.385 307.169H186.071C185.862 307.169 185.691 306.998 185.691 306.789V229.567C185.691 229.358 185.862 229.187 186.071 229.187H217.385C217.594 229.187 217.765 229.358 217.765 229.567V306.789C217.765 306.998 217.613 307.169 217.385 307.169ZM186.451 306.41H217.006V229.946H186.451V306.41Z" fill="#D0BBBB"/>
	<path d="M209.026 233.59H204.68V237.936H209.026V233.59Z" fill="#DBC9C9"/>
	<path d="M198.791 233.59H194.445V237.936H198.791V233.59Z" fill="#DBC9C9"/>
	<path d="M217.174 242.87H186.239C186.03 242.87 185.859 242.699 185.859 242.49C185.859 242.282 186.03 242.111 186.239 242.111H217.174C217.382 242.111 217.553 242.282 217.553 242.49C217.553 242.699 217.382 242.87 217.174 242.87Z" fill="#D0BBBB"/>
	<path d="M205.467 253.84H198.027V284.49H205.467V253.84Z" fill="#DBC9C9"/>
	<path d="M206.282 307.169H197.173C196.964 307.169 196.793 306.998 196.793 306.789V298.685C196.793 295.971 199.013 293.751 201.727 293.751C204.441 293.751 206.662 295.971 206.662 298.685V306.789C206.662 306.998 206.491 307.169 206.282 307.169ZM197.552 306.41H205.903V298.685C205.903 296.389 204.024 294.51 201.727 294.51C199.431 294.51 197.552 296.389 197.552 298.685V306.41Z" fill="#D0BBBB"/>
	<path d="M272.644 307.168H238.825C238.616 307.168 238.445 306.997 238.445 306.788V250.689C238.445 250.48 238.616 250.309 238.825 250.309H272.644C272.853 250.309 273.024 250.48 273.024 250.689V306.788C273.024 306.997 272.872 307.168 272.644 307.168ZM239.223 306.409H272.284V251.068H239.223V306.409Z" fill="#D0BBBB"/>
	<path d="M267.046 264.372H244.462C244.253 264.372 244.082 264.201 244.082 263.993V259.628C244.082 259.419 244.253 259.248 244.462 259.248H267.046C267.255 259.248 267.425 259.419 267.425 259.628V263.993C267.425 264.201 267.255 264.372 267.046 264.372ZM244.841 263.613H266.666V260.007H244.841V263.613Z" fill="#D0BBBB"/>
	<path d="M250.731 307.168C250.522 307.168 250.352 306.997 250.352 306.789V272.628C250.352 272.419 250.522 272.248 250.731 272.248C250.94 272.248 251.111 272.419 251.111 272.628V306.789C251.111 306.997 250.94 307.168 250.731 307.168Z" fill="#D0BBBB"/>
	<path d="M260.786 307.168C260.577 307.168 260.406 306.997 260.406 306.789V272.628C260.406 272.419 260.577 272.248 260.786 272.248C260.995 272.248 261.165 272.419 261.165 272.628V306.789C261.165 306.997 260.995 307.168 260.786 307.168Z" fill="#D0BBBB"/>
	<path d="M267.041 270.578H244.457V274.943H267.041V270.578Z" fill="#DBC9C9"/>
	<path d="M323.864 307.055H294.087C293.878 307.055 293.707 306.884 293.707 306.676V269.156C293.707 268.947 293.878 268.776 294.087 268.776H298.584V263.31C298.584 263.101 298.755 262.931 298.964 262.931H318.967C319.176 262.931 319.347 263.101 319.347 263.31V268.776H323.845C324.053 268.776 324.224 268.947 324.224 269.156V306.676C324.243 306.903 324.072 307.055 323.864 307.055ZM294.485 306.296H323.503V269.535H319.005C318.796 269.535 318.626 269.364 318.626 269.156V263.69H299.382V269.156C299.382 269.364 299.211 269.535 299.002 269.535H294.504V306.296H294.485Z" fill="#D0BBBB"/>
	<path d="M313.44 277.032H304.52C304.311 277.032 304.141 276.861 304.141 276.653C304.141 276.444 304.311 276.273 304.52 276.273H313.44C313.649 276.273 313.82 276.444 313.82 276.653C313.82 276.861 313.649 277.032 313.44 277.032Z" fill="#D0BBBB"/>
	<path d="M313.44 282.725H304.52C304.311 282.725 304.141 282.555 304.141 282.346C304.141 282.137 304.311 281.966 304.52 281.966H313.44C313.649 281.966 313.82 282.137 313.82 282.346C313.82 282.555 313.649 282.725 313.44 282.725Z" fill="#D0BBBB"/>
	<path d="M313.44 288.419H304.52C304.311 288.419 304.141 288.248 304.141 288.04C304.141 287.831 304.311 287.66 304.52 287.66H313.44C313.649 287.66 313.82 287.831 313.82 288.04C313.82 288.248 313.649 288.419 313.44 288.419Z" fill="#D0BBBB"/>
	<path d="M318.985 306.448C318.776 306.448 318.605 306.277 318.605 306.068V269.174C318.605 268.966 318.776 268.795 318.985 268.795C319.194 268.795 319.365 268.966 319.365 269.174V306.068C319.365 306.277 319.194 306.448 318.985 306.448Z" fill="#D0BBBB"/>
	<path d="M298.981 306.96C298.772 306.96 298.602 306.789 298.602 306.581V269.174C298.602 268.966 298.772 268.795 298.981 268.795C299.19 268.795 299.361 268.966 299.361 269.174V306.581C299.361 306.789 299.19 306.96 298.981 306.96Z" fill="#D0BBBB"/>
	<path d="M306.758 254.447C306.758 253.138 307.669 252.189 308.997 252.189C310.307 252.189 311.18 253.138 311.199 254.447C311.199 255.738 310.326 256.706 308.997 256.706C307.65 256.706 306.758 255.738 306.758 254.447Z" fill="#DBC9C9"/>
	<path d="M310.406 250.064H307.578C307.369 250.064 307.217 249.912 307.198 249.703L306.629 238.468C306.629 238.373 306.667 238.259 306.724 238.183C306.8 238.107 306.895 238.069 306.99 238.069H310.937C311.032 238.069 311.146 238.107 311.203 238.183C311.279 238.259 311.317 238.354 311.298 238.468L310.747 249.703C310.785 249.912 310.614 250.064 310.406 250.064ZM307.938 249.304H310.045L310.557 238.828H307.407L307.938 249.304Z" fill="#D0BBBB"/>
	<path d="M154.358 241.049C154.225 241.049 154.092 241.03 153.978 240.973L150.486 239.36C150.031 239.151 149.822 238.601 150.031 238.146L150.733 236.627C150.619 236.457 150.505 236.267 150.391 236.096C150.297 235.906 150.202 235.716 150.107 235.527L148.456 235.318C147.943 235.261 147.602 234.786 147.659 234.293L148.133 230.478C148.171 230.232 148.285 230.023 148.475 229.871C148.664 229.719 148.911 229.662 149.158 229.681L150.809 229.89C151.056 229.567 151.34 229.264 151.663 228.979L151.359 227.347C151.321 227.1 151.359 226.853 151.511 226.664C151.644 226.455 151.853 226.322 152.099 226.284L155.876 225.582C156.37 225.487 156.863 225.81 156.958 226.322L157.262 227.954C157.641 228.087 157.983 228.258 158.324 228.448L159.786 227.632C159.994 227.518 160.241 227.48 160.488 227.556C160.716 227.632 160.924 227.783 161.038 227.992L162.898 231.351C163.145 231.788 162.993 232.357 162.538 232.604L161.076 233.42C161.076 233.819 161.019 234.198 160.943 234.578L162.177 235.697C162.556 236.039 162.575 236.627 162.234 236.988L159.634 239.816C159.463 240.005 159.235 240.1 158.989 240.119C158.742 240.138 158.514 240.043 158.324 239.873L157.091 238.753C156.692 238.886 156.294 238.962 155.876 239L155.174 240.518C155.022 240.84 154.699 241.049 154.358 241.049ZM149.044 230.421C149.006 230.421 148.968 230.44 148.949 230.459C148.93 230.478 148.892 230.516 148.892 230.573L148.418 234.388C148.399 234.483 148.475 234.559 148.551 234.559L150.429 234.786C150.562 234.805 150.695 234.9 150.733 235.033C150.828 235.261 150.923 235.489 151.056 235.716C151.17 235.925 151.321 236.134 151.473 236.343C151.568 236.457 151.568 236.608 151.511 236.741L150.714 238.468C150.676 238.544 150.714 238.639 150.79 238.677L154.282 240.29C154.358 240.328 154.453 240.29 154.491 240.214L155.288 238.506C155.345 238.373 155.478 238.297 155.61 238.278C156.104 238.259 156.597 238.165 157.053 237.994C157.186 237.937 157.337 237.975 157.432 238.07L158.818 239.341C158.875 239.398 158.989 239.379 159.046 239.322L161.646 236.494C161.702 236.438 161.702 236.324 161.627 236.267L160.222 234.976C160.108 234.881 160.07 234.729 160.108 234.597C160.241 234.141 160.279 233.667 160.279 233.192C160.279 233.059 160.355 232.927 160.469 232.851L162.12 231.94C162.196 231.902 162.234 231.807 162.177 231.731L160.317 228.372C160.298 228.315 160.241 228.296 160.222 228.296C160.203 228.296 160.146 228.277 160.108 228.315L158.457 229.226C158.324 229.302 158.191 229.283 158.059 229.207C157.66 228.941 157.224 228.751 156.768 228.6C156.635 228.562 156.54 228.448 156.502 228.315L156.161 226.455C156.142 226.36 156.066 226.303 155.971 226.322L152.194 227.024C152.118 227.043 152.043 227.138 152.062 227.214L152.403 229.074C152.422 229.207 152.384 229.359 152.27 229.435C151.891 229.738 151.549 230.099 151.264 230.516C151.188 230.63 151.056 230.706 150.904 230.668L149.025 230.44C149.063 230.421 149.044 230.421 149.044 230.421Z" fill="#D0BBBB"/>
	<path d="M155.358 236.456C155.074 236.456 154.77 236.418 154.485 236.343C153.669 236.115 153.005 235.583 152.606 234.843C152.208 234.103 152.094 233.268 152.341 232.452C152.568 231.655 153.1 230.972 153.84 230.573C154.58 230.175 155.415 230.061 156.231 230.288C157.047 230.516 157.712 231.048 158.11 231.788C158.509 232.528 158.623 233.363 158.376 234.179C158.148 234.976 157.617 235.659 156.877 236.058C156.421 236.324 155.89 236.456 155.358 236.456ZM155.377 230.934C154.979 230.934 154.58 231.029 154.22 231.237C153.669 231.541 153.252 232.053 153.081 232.661C152.91 233.268 152.986 233.913 153.29 234.464C153.593 235.014 154.106 235.413 154.713 235.602C155.32 235.773 155.966 235.697 156.535 235.394C157.085 235.09 157.503 234.578 157.674 233.97C157.844 233.363 157.769 232.718 157.465 232.167C157.161 231.617 156.649 231.218 156.042 231.029C155.814 230.953 155.586 230.934 155.377 230.934Z" fill="#D0BBBB"/>
	<path d="M360.325 307.17C360.116 307.17 359.945 306.999 359.945 306.79V292.5C359.945 292.291 360.116 292.12 360.325 292.12C360.534 292.12 360.704 292.291 360.704 292.5V306.79C360.704 306.999 360.534 307.17 360.325 307.17Z" fill="#D0BBBB"/>
	<path d="M377.386 307.169H19.3796C19.1708 307.169 19 306.998 19 306.79C19 306.581 19.1708 306.41 19.3796 306.41H377.386C377.595 306.41 377.766 306.581 377.766 306.79C377.766 306.998 377.595 307.169 377.386 307.169Z" fill="#D0BBBB"/>
	<path d="M567.202 299.635C561.888 299.635 557.58 294.401 557.58 287.944C557.58 281.487 561.888 276.253 567.202 276.253C572.516 276.253 576.824 281.487 576.824 287.944C576.824 294.401 572.516 299.635 567.202 299.635Z" fill="#DBC9C9"/>
	<path d="M567.202 307.169C567.411 307.169 567.582 306.999 567.582 306.79V292.499C567.582 292.29 567.411 292.12 567.202 292.12C566.994 292.12 566.823 292.29 566.823 292.499V306.79C566.823 306.999 566.994 307.169 567.202 307.169Z" fill="#D0BBBB"/>
	<path d="M581.838 300.014C587.361 300.014 591.84 294.606 591.84 287.944C591.84 281.283 587.361 275.874 581.838 275.874C576.316 275.874 571.837 281.283 571.837 287.944C571.837 294.606 576.316 300.014 581.838 300.014ZM581.838 276.652C586.943 276.652 591.081 281.719 591.081 287.963C591.081 294.207 586.924 299.274 581.838 299.274C576.752 299.274 572.596 294.207 572.596 287.963C572.596 281.719 576.733 276.652 581.838 276.652Z" fill="#D0BBBB"/>
	<path d="M581.839 307.169C582.048 307.169 582.219 306.999 582.219 306.79V292.499C582.219 292.29 582.048 292.12 581.839 292.12C581.63 292.12 581.46 292.29 581.46 292.499V306.79C581.46 306.999 581.63 307.169 581.839 307.169Z" fill="#D0BBBB"/>
	<path d="M508.713 307.016H544.867C545.075 307.016 545.246 306.846 545.246 306.637V264.296C545.246 264.088 545.075 263.917 544.867 263.917H535.776V239.871C535.776 239.663 535.605 239.492 535.396 239.492H518.164C517.955 239.492 517.785 239.663 517.785 239.871V263.917H508.694C508.485 263.917 508.314 264.088 508.314 264.296V306.637C508.333 306.846 508.504 307.016 508.713 307.016ZM544.487 306.257H509.073V264.676H518.164C518.373 264.676 518.544 264.505 518.544 264.296V240.251H535.017V264.296C535.017 264.505 535.188 264.676 535.396 264.676H544.487V306.257Z" fill="#D0BBBB"/>
	<path d="M522.337 246.855H531.257C531.466 246.855 531.637 246.684 531.637 246.475C531.637 246.267 531.466 246.096 531.257 246.096H522.337C522.129 246.096 521.958 246.267 521.958 246.475C521.958 246.684 522.11 246.855 522.337 246.855Z" fill="#D0BBBB"/>
	<path d="M522.337 252.548H531.257C531.466 252.548 531.637 252.377 531.637 252.169C531.637 251.96 531.466 251.789 531.257 251.789H522.337C522.129 251.789 521.958 251.96 521.958 252.169C521.958 252.377 522.11 252.548 522.337 252.548Z" fill="#D0BBBB"/>
	<path d="M522.337 258.243H531.257C531.466 258.243 531.637 258.072 531.637 257.863C531.637 257.654 531.466 257.483 531.257 257.483H522.337C522.129 257.483 521.958 257.654 521.958 257.863C521.958 258.072 522.11 258.243 522.337 258.243Z" fill="#D0BBBB"/>
	<path d="M518.189 264.676H535.421C535.63 264.676 535.801 264.505 535.801 264.296C535.801 264.087 535.63 263.917 535.421 263.917H518.189C517.98 263.917 517.809 264.087 517.809 264.296C517.809 264.505 517.961 264.676 518.189 264.676Z" fill="#D0BBBB"/>
	<path d="M515.128 285.552H538.452C538.661 285.552 538.832 285.381 538.832 285.172C538.832 284.963 538.661 284.792 538.452 284.792H515.128C514.919 284.792 514.749 284.963 514.749 285.172C514.749 285.381 514.919 285.552 515.128 285.552Z" fill="#D0BBBB"/>
	<path d="M515.128 291.643H538.452C538.661 291.643 538.832 291.473 538.832 291.264C538.832 291.055 538.661 290.884 538.452 290.884H515.128C514.919 290.884 514.749 291.055 514.749 291.264C514.749 291.473 514.919 291.643 515.128 291.643Z" fill="#D0BBBB"/>
	<path d="M514.384 272.115H518.73V276.461H514.384V272.115Z" fill="#DBC9C9"/>
	<path d="M524.611 272.115H528.957V276.461H524.611V272.115Z" fill="#DBC9C9"/>
	<path d="M534.845 272.115H539.191V276.461H534.845V272.115Z" fill="#DBC9C9"/>
	<path d="M453.146 307.131H487.269C487.478 307.131 487.648 306.96 487.648 306.751V212.505C487.648 212.296 487.478 212.125 487.269 212.125H475.407C475.199 212.125 475.028 212.296 475.028 212.505V247.311H453.146C452.937 247.311 452.766 247.482 452.766 247.691V306.751C452.766 306.96 452.937 307.131 453.146 307.131ZM486.889 306.372H453.525V248.07H475.407C475.616 248.07 475.787 247.9 475.787 247.691V212.885H486.889V306.372Z" fill="#D0BBBB"/>
	<path d="M459.716 266.973H468.636C468.845 266.973 469.016 266.802 469.016 266.593C469.016 266.384 468.845 266.213 468.636 266.213H459.716C459.508 266.213 459.337 266.384 459.337 266.593C459.337 266.802 459.489 266.973 459.716 266.973Z" fill="#D0BBBB"/>
	<path d="M459.716 272.666H468.636C468.845 272.666 469.016 272.495 469.016 272.286C469.016 272.077 468.845 271.907 468.636 271.907H459.716C459.508 271.907 459.337 272.077 459.337 272.286C459.337 272.495 459.489 272.666 459.716 272.666Z" fill="#D0BBBB"/>
	<path d="M459.716 278.36H468.636C468.845 278.36 469.016 278.189 469.016 277.981C469.016 277.772 468.845 277.601 468.636 277.601H459.716C459.508 277.601 459.337 277.772 459.337 277.981C459.337 278.189 459.489 278.36 459.716 278.36Z" fill="#D0BBBB"/>
	<path d="M481.632 306.998C481.841 306.998 482.012 306.828 482.012 306.619V212.486C482.012 212.278 481.841 212.107 481.632 212.107C481.423 212.107 481.253 212.278 481.253 212.486V306.619C481.253 306.828 481.423 306.998 481.632 306.998Z" fill="#D0BBBB"/>
	<path d="M475.413 307.131C475.622 307.131 475.793 306.96 475.793 306.751V247.691C475.793 247.482 475.622 247.311 475.413 247.311C475.205 247.311 475.034 247.482 475.034 247.691V306.751C475.034 306.96 475.205 307.131 475.413 307.131Z" fill="#D0BBBB"/>
	<path d="M400.38 307.169H431.695C431.903 307.169 432.074 306.998 432.074 306.789V229.567C432.074 229.358 431.903 229.187 431.695 229.187H400.38C400.172 229.187 400.001 229.358 400.001 229.567V306.789C400.001 306.998 400.153 307.169 400.38 307.169ZM431.315 306.41H400.76V229.946H431.315V306.41Z" fill="#D0BBBB"/>
	<path d="M408.74 233.59H413.086V237.936H408.74V233.59Z" fill="#DBC9C9"/>
	<path d="M418.974 233.59H423.32V237.936H418.974V233.59Z" fill="#DBC9C9"/>
	<path d="M400.592 242.87H431.527C431.735 242.87 431.906 242.699 431.906 242.49C431.906 242.282 431.735 242.111 431.527 242.111H400.592C400.383 242.111 400.213 242.282 400.213 242.49C400.213 242.699 400.383 242.87 400.592 242.87Z" fill="#D0BBBB"/>
	<path d="M412.299 253.84H419.738V284.49H412.299V253.84Z" fill="#DBC9C9"/>
	<path d="M411.484 307.169H420.593C420.802 307.169 420.973 306.998 420.973 306.789V298.685C420.973 295.971 418.752 293.751 416.038 293.751C413.324 293.751 411.104 295.971 411.104 298.685V306.789C411.104 306.998 411.275 307.169 411.484 307.169ZM420.214 306.41H411.863V298.685C411.863 296.389 413.742 294.51 416.038 294.51C418.335 294.51 420.214 296.389 420.214 298.685V306.41Z" fill="#D0BBBB"/>
	<path d="M345.121 307.168H378.941C379.15 307.168 379.32 306.997 379.32 306.788V250.689C379.32 250.48 379.15 250.309 378.941 250.309H345.121C344.913 250.309 344.742 250.48 344.742 250.689V306.788C344.742 306.997 344.894 307.168 345.121 307.168ZM378.542 306.409H345.482V251.068H378.542V306.409Z" fill="#D0BBBB"/>
	<path d="M350.72 264.372H373.304C373.513 264.372 373.684 264.201 373.684 263.993V259.628C373.684 259.419 373.513 259.248 373.304 259.248H350.72C350.511 259.248 350.34 259.419 350.34 259.628V263.993C350.34 264.201 350.511 264.372 350.72 264.372ZM372.924 263.613H351.099V260.007H372.924V263.613Z" fill="#D0BBBB"/>
	<path d="M367.034 307.168C367.243 307.168 367.414 306.997 367.414 306.789V272.628C367.414 272.419 367.243 272.248 367.034 272.248C366.826 272.248 366.655 272.419 366.655 272.628V306.789C366.655 306.997 366.826 307.168 367.034 307.168Z" fill="#D0BBBB"/>
	<path d="M356.98 307.168C357.189 307.168 357.359 306.997 357.359 306.789V272.628C357.359 272.419 357.189 272.248 356.98 272.248C356.771 272.248 356.6 272.419 356.6 272.628V306.789C356.6 306.997 356.771 307.168 356.98 307.168Z" fill="#D0BBBB"/>
	<path d="M350.724 270.578H373.309V274.943H350.724V270.578Z" fill="#DBC9C9"/>
	<path d="M293.902 307.055H323.679C323.888 307.055 324.059 306.884 324.059 306.676V269.156C324.059 268.947 323.888 268.776 323.679 268.776H319.181V263.31C319.181 263.101 319.01 262.931 318.802 262.931H298.799C298.59 262.931 298.419 263.101 298.419 263.31V268.776H293.921C293.712 268.776 293.541 268.947 293.541 269.156V306.676C293.523 306.903 293.693 307.055 293.902 307.055ZM323.28 306.296H294.263V269.535H298.761C298.969 269.535 299.14 269.364 299.14 269.156V263.69H318.384V269.156C318.384 269.364 318.555 269.535 318.764 269.535H323.262V306.296H323.28Z" fill="#D0BBBB"/>
	<path d="M304.326 277.032H313.245C313.454 277.032 313.625 276.861 313.625 276.653C313.625 276.444 313.454 276.273 313.245 276.273H304.326C304.117 276.273 303.946 276.444 303.946 276.653C303.946 276.861 304.117 277.032 304.326 277.032Z" fill="#D0BBBB"/>
	<path d="M304.326 282.725H313.245C313.454 282.725 313.625 282.555 313.625 282.346C313.625 282.137 313.454 281.966 313.245 281.966H304.326C304.117 281.966 303.946 282.137 303.946 282.346C303.946 282.555 304.117 282.725 304.326 282.725Z" fill="#D0BBBB"/>
	<path d="M304.326 288.419H313.245C313.454 288.419 313.625 288.248 313.625 288.04C313.625 287.831 313.454 287.66 313.245 287.66H304.326C304.117 287.66 303.946 287.831 303.946 288.04C303.946 288.248 304.117 288.419 304.326 288.419Z" fill="#D0BBBB"/>
	<path d="M298.781 306.448C298.989 306.448 299.16 306.277 299.16 306.068V269.174C299.16 268.966 298.989 268.795 298.781 268.795C298.572 268.795 298.401 268.966 298.401 269.174V306.068C298.401 306.277 298.572 306.448 298.781 306.448Z" fill="#D0BBBB"/>
	<path d="M318.784 306.96C318.993 306.96 319.164 306.789 319.164 306.581V269.174C319.164 268.966 318.993 268.795 318.784 268.795C318.576 268.795 318.405 268.966 318.405 269.174V306.581C318.405 306.789 318.576 306.96 318.784 306.96Z" fill="#D0BBBB"/>
	<path d="M311.008 254.447C311.008 253.138 310.097 252.189 308.768 252.189C307.459 252.189 306.586 253.138 306.567 254.447C306.567 255.738 307.44 256.706 308.768 256.706C310.116 256.706 311.008 255.738 311.008 254.447Z" fill="#DBC9C9"/>
	<path d="M307.36 250.064H310.188C310.397 250.064 310.548 249.912 310.567 249.703L311.137 238.468C311.137 238.373 311.099 238.259 311.042 238.183C310.966 238.107 310.871 238.069 310.776 238.069H306.829C306.734 238.069 306.62 238.107 306.563 238.183C306.487 238.259 306.449 238.354 306.468 238.468L307.018 249.703C306.98 249.912 307.151 250.064 307.36 250.064ZM309.827 249.304H307.721L307.208 238.828H310.359L309.827 249.304Z" fill="#D0BBBB"/>
	<path d="M463.408 241.049C463.541 241.049 463.673 241.03 463.787 240.973L467.279 239.36C467.735 239.151 467.944 238.601 467.735 238.146L467.033 236.627C467.146 236.457 467.26 236.267 467.374 236.096C467.469 235.906 467.564 235.716 467.659 235.527L469.31 235.318C469.822 235.261 470.164 234.786 470.107 234.293L469.633 230.478C469.595 230.232 469.481 230.023 469.291 229.871C469.101 229.719 468.855 229.662 468.608 229.681L466.957 229.89C466.71 229.567 466.425 229.264 466.103 228.979L466.406 227.347C466.444 227.1 466.406 226.853 466.254 226.664C466.122 226.455 465.913 226.322 465.666 226.284L461.889 225.582C461.396 225.487 460.903 225.81 460.808 226.322L460.504 227.954C460.124 228.087 459.783 228.258 459.441 228.448L457.98 227.632C457.771 227.518 457.524 227.48 457.278 227.556C457.05 227.632 456.841 227.783 456.727 227.992L454.868 231.351C454.621 231.788 454.773 232.357 455.228 232.604L456.689 233.42C456.689 233.819 456.746 234.198 456.822 234.578L455.589 235.697C455.209 236.039 455.19 236.627 455.532 236.988L458.132 239.816C458.303 240.005 458.53 240.1 458.777 240.119C459.024 240.138 459.252 240.043 459.441 239.873L460.675 238.753C461.073 238.886 461.472 238.962 461.889 239L462.592 240.518C462.744 240.84 463.066 241.049 463.408 241.049ZM468.722 230.421C468.76 230.421 468.798 230.44 468.817 230.459C468.836 230.478 468.874 230.516 468.874 230.573L469.348 234.388C469.367 234.483 469.291 234.559 469.215 234.559L467.336 234.786C467.203 234.805 467.071 234.9 467.033 235.033C466.938 235.261 466.843 235.489 466.71 235.716C466.596 235.925 466.444 236.134 466.292 236.343C466.198 236.457 466.198 236.608 466.254 236.741L467.052 238.468C467.09 238.544 467.052 238.639 466.976 238.677L463.484 240.29C463.408 240.328 463.313 240.29 463.275 240.214L462.478 238.506C462.421 238.373 462.288 238.297 462.155 238.278C461.662 238.259 461.168 238.165 460.713 237.994C460.58 237.937 460.428 237.975 460.333 238.07L458.948 239.341C458.891 239.398 458.777 239.379 458.72 239.322L456.12 236.494C456.063 236.438 456.063 236.324 456.139 236.267L457.543 234.976C457.657 234.881 457.695 234.729 457.657 234.597C457.524 234.141 457.487 233.667 457.487 233.192C457.487 233.059 457.411 232.927 457.297 232.851L455.646 231.94C455.57 231.902 455.532 231.807 455.589 231.731L457.449 228.372C457.468 228.315 457.524 228.296 457.543 228.296C457.562 228.296 457.619 228.277 457.657 228.315L459.308 229.226C459.441 229.302 459.574 229.283 459.707 229.207C460.106 228.941 460.542 228.751 460.998 228.6C461.13 228.562 461.225 228.448 461.263 228.315L461.605 226.455C461.624 226.36 461.7 226.303 461.795 226.322L465.571 227.024C465.647 227.043 465.723 227.138 465.704 227.214L465.363 229.074C465.344 229.207 465.381 229.359 465.495 229.435C465.875 229.738 466.217 230.099 466.501 230.516C466.577 230.63 466.71 230.706 466.862 230.668L468.741 230.44C468.703 230.421 468.722 230.421 468.722 230.421Z" fill="#D0BBBB"/>
	<path d="M462.407 236.456C462.692 236.456 462.996 236.418 463.28 236.343C464.096 236.115 464.761 235.583 465.159 234.843C465.558 234.103 465.672 233.268 465.425 232.452C465.197 231.655 464.666 230.972 463.926 230.573C463.185 230.175 462.35 230.061 461.534 230.288C460.718 230.516 460.054 231.048 459.655 231.788C459.257 232.528 459.143 233.363 459.39 234.179C459.618 234.976 460.149 235.659 460.889 236.058C461.345 236.324 461.876 236.456 462.407 236.456ZM462.388 230.934C462.787 230.934 463.185 231.029 463.546 231.237C464.096 231.541 464.514 232.053 464.685 232.661C464.856 233.268 464.78 233.913 464.476 234.464C464.172 235.014 463.66 235.413 463.053 235.602C462.445 235.773 461.8 235.697 461.231 235.394C460.68 235.09 460.263 234.578 460.092 233.97C459.921 233.363 459.997 232.718 460.301 232.167C460.604 231.617 461.117 231.218 461.724 231.029C461.952 230.953 462.18 230.934 462.388 230.934Z" fill="#D0BBBB"/>
	<path d="M240.38 307.169H598.386C598.595 307.169 598.766 306.998 598.766 306.79C598.766 306.581 598.595 306.41 598.386 306.41H240.38C240.171 306.41 240 306.581 240 306.79C240 306.998 240.171 307.169 240.38 307.169Z" fill="#D0BBBB"/>
	<path d="M244.06 192.644L238.799 172.46C238.361 170.759 237.367 169.252 235.974 168.176C234.581 167.1 232.869 166.516 231.107 166.517H205.999C203.452 166.517 201.387 168.575 201.387 171.113C201.387 173.652 203.452 175.709 205.999 175.709H230.112L234.483 192.643L236.682 194.478H242.885L244.06 192.644ZM352.861 277.662H246.816C242.351 277.662 238.719 274.042 238.719 269.593C238.719 265.144 242.351 261.524 246.816 261.524H258.375L261.665 260.186L259.936 253.554L249.887 252.343L246.534 252.338C237.113 252.49 229.494 260.169 229.494 269.593C229.494 279.111 237.264 286.854 246.815 286.854H352.86C355.408 286.854 357.472 284.796 357.472 282.258C357.473 279.719 355.408 277.662 352.861 277.662Z" fill="#9A7B7B"/>
	<path d="M215.468 177.804H193.742C191.675 177.804 190 176.135 190 174.075V168.152C190 166.093 191.675 164.423 193.742 164.423H215.468C217.535 164.423 219.21 166.093 219.21 168.152V174.075C219.21 176.135 217.535 177.804 215.468 177.804Z" fill="#A78787"/>
	<path d="M257.411 306.791C263.161 306.791 267.823 302.146 267.823 296.415C267.823 290.685 263.161 286.04 257.411 286.04C251.661 286.04 247 290.685 247 296.415C247 302.146 251.661 306.791 257.411 306.791Z" fill="#8B6B6B"/>
	<path d="M335.388 306.791C341.138 306.791 345.799 302.146 345.799 296.415C345.799 290.685 341.138 286.04 335.388 286.04C329.638 286.04 324.977 290.685 324.977 296.415C324.977 302.146 329.638 306.791 335.388 306.791Z" fill="#8B6B6B"/>
	<path d="M331.285 255.623C333.183 255.623 335.028 254.993 336.527 253.832C338.027 252.671 339.096 251.046 339.565 249.212L353.504 194.769L350.803 192.644H234.484L249.889 252.344L252.896 255.622L331.285 255.623Z" fill="#E0CBCB"/>
	<path d="M329.391 252.332H249.888L249.887 252.333L250.736 255.622C251.172 257.311 252.159 258.807 253.541 259.876C254.924 260.944 256.624 261.524 258.374 261.524H341.341C343.094 261.524 344.796 260.943 346.18 259.871C347.564 258.8 348.55 257.3 348.984 255.607L363.429 199.187C364.278 195.87 361.764 192.644 358.328 192.644H350.801L337.033 246.415C336.6 248.108 335.614 249.608 334.23 250.679C332.846 251.75 331.143 252.332 329.391 252.332Z" fill="#BFA4A4"/>
	<path d="M352.862 277.662H343.293V286.855H352.862C355.409 286.855 357.474 284.797 357.474 282.259C357.474 279.72 355.409 277.662 352.862 277.662Z" fill="#9A7B7B"/>
	<path d="M205.031 177.804H215.471C217.537 177.804 219.213 176.135 219.213 174.075V168.152C219.213 166.093 217.537 164.423 215.471 164.423H205.031V177.804Z" fill="#756161"/>
	<path d="M272.034 226.113C275.043 226.113 277.482 223.682 277.482 220.683C277.482 217.685 275.043 215.254 272.034 215.254C269.025 215.254 266.586 217.685 266.586 220.683C266.586 223.682 269.025 226.113 272.034 226.113Z" fill="#9A7B7B"/>
	<path d="M315.061 226.113C318.07 226.113 320.509 223.682 320.509 220.683C320.509 217.685 318.07 215.254 315.061 215.254C312.052 215.254 309.613 217.685 309.613 220.683C309.613 223.682 312.052 226.113 315.061 226.113Z" fill="#9A7B7B"/>
	<path d="M301.86 231.795C301.591 231.939 301.257 231.839 301.113 231.571C301.087 231.524 301.06 231.477 301.032 231.431C300.662 230.816 297.88 226.284 292.581 226.284C287.433 226.284 286.146 231.158 286.103 231.371L286.098 231.391C286.005 231.737 285.654 231.946 285.306 231.862L285.264 231.852C284.942 231.775 284.739 231.457 284.804 231.132C284.812 231.092 284.819 231.055 284.83 231.016C284.994 230.403 286.69 225.002 292.538 225.002C298.972 225.002 302.061 230.687 302.189 230.901C302.355 231.208 302.24 231.591 301.933 231.756L301.86 231.795Z" fill="#9A7B7B"/>
	<path d="M367.639 281.321C367.639 281.321 364.166 288.684 364.391 291.674C364.584 294.664 364.809 298.136 364.809 298.136C364.809 298.136 358.25 298.619 354.488 293.249C350.727 287.88 353.974 286.401 353.974 286.401L361.626 276.787L367.639 281.321Z" fill="#DFAF9A"/>
	<path d="M354.042 286.047C354.042 286.047 350.666 286.305 348.415 288.62C346.165 290.935 345.264 292.414 346.679 294.118C348.126 295.854 352.241 297.719 353.27 299.294C354.299 300.87 356.518 303.12 360.151 306.111C363.784 309.101 373.848 308.522 375.005 306.721C375.552 305.885 371.211 303.731 368.671 301.32C365.778 298.587 364.62 295.597 364.62 295.597C364.62 295.597 359.443 294.471 356.968 291.578C354.556 288.684 354.042 286.047 354.042 286.047Z" fill="#111214"/>
	<path d="M391.659 286.08C391.659 286.08 393.106 294.15 395.196 296.304C397.286 298.458 399.665 300.966 399.665 300.966C399.665 300.966 394.971 305.564 388.637 303.86C382.303 302.156 383.814 298.941 383.814 298.941L384.168 286.465L391.659 286.08Z" fill="#DFAF9A"/>
	<path d="M383.617 298.619C383.617 298.619 381.205 300.998 380.98 304.213C380.755 307.428 381.012 309.133 383.199 309.518C385.417 309.904 389.758 308.682 391.558 309.229C393.359 309.776 396.51 310.065 401.236 310.001C405.963 309.968 413.004 308.264 412.715 306.142C412.425 304.02 397.892 299.069 397.892 299.069C397.892 299.069 393.23 301.545 389.469 300.934C385.707 300.323 383.617 298.619 383.617 298.619Z" fill="#111214"/>
	<path d="M391.053 187.854C391.053 187.854 401.663 207.531 403.753 230.392C405.457 248.911 366.778 285.147 366.778 285.147L358 279.746L378.674 234.25L375.973 209.814L377.131 186.471L391.053 187.854Z" fill="url(#paint0_linear_1626_1232)"/>
	<path d="M361.017 186.664C361.017 186.664 358.895 194.284 359.281 206.406C359.667 218.527 383.074 293.539 383.074 293.539L394.327 293.378C394.327 293.378 392.495 254.699 391.209 236.404C390.598 227.755 388.154 211.325 388.701 206.631C389.247 201.904 391.048 187.918 391.048 187.918L361.017 186.664Z" fill="url(#paint1_linear_1626_1232)"/>
	<path d="M375.62 125.606C367.646 127.085 382.565 156.441 388.095 162.871C393.626 169.302 415.618 158.241 415.618 158.241L413.431 150.782L397.741 151.136C397.741 151.136 392.468 141.168 389.607 134.448C386.713 127.696 381.118 124.578 375.62 125.606Z" fill="url(#paint2_linear_1626_1232)"/>
	<path d="M375.519 123.42C387.383 126.86 389.666 132.23 391.981 141.457C394.296 150.685 395.035 180.426 393.524 187.95C392.013 195.474 363.622 193.512 360.922 192.033C358.221 190.586 359.796 180.619 359.185 168.755C358.575 156.858 355.809 148.563 358.221 137.856C360.6 127.182 366.066 120.655 375.519 123.42Z" fill="url(#paint3_linear_1626_1232)"/>
	<path d="M421.176 154.286C422.462 154.704 423.877 154.029 424.327 152.711L433.876 124.192C434.294 122.906 433.619 121.491 432.301 121.041C431.015 120.623 429.6 121.298 429.15 122.616L419.601 151.135C419.183 152.422 419.89 153.836 421.176 154.286Z" fill="#9DA1CC"/>
	<path d="M427.604 143.033C426.061 142.004 421.077 143.74 416.48 147.277C411.882 150.814 411.978 153.74 411.978 153.74L406.352 155.894L409.181 163.289L416.415 160.524C416.415 160.524 420.37 160.46 424.518 157.437C428.665 154.415 425.836 147.856 425.836 147.856C425.836 147.856 429.18 144.062 427.604 143.033Z" fill="#DFAF9A"/>
	<path d="M362.267 130.847C354.294 132.326 366.222 167.855 371.752 174.285C377.283 180.716 411.107 163.192 411.107 163.192L406.863 155.283L378.955 162.614C378.955 162.614 377.636 147.888 374.743 141.136C371.849 134.416 367.765 129.818 362.267 130.847Z" fill="url(#paint4_linear_1626_1232)"/>
	<path d="M381.406 115.125L378.995 123.581L382.564 126.539C382.564 126.539 384.621 130.365 375.94 129.786C367.259 129.208 366.52 123.967 366.52 123.967L369.06 122.295L370.603 112.07L381.406 115.125Z" fill="#E2A990"/>
	<path d="M368.351 102.939C366.904 113.774 374.492 121.652 381.212 123.356C387.932 125.092 393.462 114.867 394.684 105.125C395.198 100.881 395.649 96.3475 394.202 93.5181C392.305 89.8849 388.961 87.5699 384.588 87.0233C376.839 86.0909 369.669 93.2287 368.351 102.939Z" fill="#DFAF9A"/>
	<path d="M370.633 101.363C370.633 101.363 368.704 95.9297 366.067 96.7978C363.431 97.6659 364.556 102.232 365.842 104.321C367.128 106.411 369.732 106.508 369.732 106.508L370.633 101.363Z" fill="#DFAF9A"/>
	<path d="M370.212 101.942C370.726 101.942 371.209 101.974 371.691 102.039C372.109 100.045 372.688 97.6658 373.363 96.2832C374.681 93.6789 377.896 90.11 377.896 90.11C377.896 90.11 385.034 92.4571 388.475 92.6822C391.915 92.8751 395.998 92.2642 397.606 90.4637C399.214 88.6953 402.011 82.6184 402.011 82.6184L394.744 82.0397L396.545 79.0174L388.7 79.6283L388.475 77.5062L384.97 78.2779L384.23 75.9629C384.23 75.9629 370.148 80.7214 368.186 87.2484C366.225 93.7754 366 96.7977 366 96.7977C366 96.7977 367.543 97.1835 369.472 99.2091C370.083 99.8522 370.276 100.849 370.212 101.942Z" fill="#111214"/>
	<defs>
	<linearGradient id="paint0_linear_1626_1232" x1="380.322" y1="233.235" x2="336.17" y2="246.901" gradientUnits="userSpaceOnUse">
	<stop stop-color="#494B50"/>
	<stop offset="1" stop-color="#686B74"/>
	</linearGradient>
	<linearGradient id="paint1_linear_1626_1232" x1="375.248" y1="198.344" x2="381.556" y2="283.494" gradientUnits="userSpaceOnUse">
	<stop stop-color="#515459"/>
	<stop offset="1" stop-color="#737680"/>
	</linearGradient>
	<linearGradient id="paint2_linear_1626_1232" x1="379.993" y1="144.377" x2="444.398" y2="169.97" gradientUnits="userSpaceOnUse">
	<stop stop-color="#9CA2B6"/>
	<stop offset="1" stop-color="#4D536A"/>
	</linearGradient>
	<linearGradient id="paint3_linear_1626_1232" x1="361.914" y1="142.2" x2="383.417" y2="186.574" gradientUnits="userSpaceOnUse">
	<stop stop-color="#848896"/>
	<stop offset="1" stop-color="#636673"/>
	</linearGradient>
	<linearGradient id="paint4_linear_1626_1232" x1="367.723" y1="152.325" x2="444.679" y2="184.986" gradientUnits="userSpaceOnUse">
	<stop stop-color="#9CA2B6"/>
	<stop offset="1" stop-color="#6B7289"/>
	</linearGradient>
	</defs>
	</svg>
	<p class="cart-empty">';
    $html .= wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your <span>cart</span> is currently <span>empty</span>.', 'woocommerce' ) ) );
    echo $html . '</p></div>';
}

//---------------------------------------------------------------------------------------------------------------------