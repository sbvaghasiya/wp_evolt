<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) ) {
	return;
}

if(!function_exists('evolt_hex_to_rgba')){
    function evolt_hex_to_rgba($hex,$opacity = 1) {
        $hex = str_replace("#",null, $hex);
        $color = array();
        if(strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
            $color['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
            $color['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
            $color['a'] = $opacity;
        }
        else if(strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
            $color['a'] = $opacity;
        }
        $color = "rgba(".implode(', ', $color).")";
        return $color;
    }
}

class CSS_Generator {
	/**
     * scssc class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

	/**
	 * Constructor
	 */

	function __construct() {
		$this->opt_name = evolt_get_option_name();
		if ( empty( $this->opt_name ) ) {
			return;
		}
		$this->dev_mode = evolt_get_option( 'dev_mode', '0' ) === '1' ? true : false;
		add_filter( 'evolt_scssc_on', '__return_true' );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
	}

	/**
	 * init hook - 10
	 */
	function init() {
		if ( ! class_exists( 'scssc' ) ) {
			return;
		}

		$this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

		if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
			return;
		}
		add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
		add_action( "redux/options/{$this->opt_name}/saved", function () {
			$this->generate_file();
		} );
	}

	function generate_with_dev_mode() {
		if ( $this->dev_mode === true ) {
			$this->generate_file();
		}
	}

	/**
	 * Generate options and css files
	 */
	function generate_file() {
		$scss_dir = get_template_directory() . '/assets/scss/';
		$css_dir  = get_template_directory() . '/assets/css/';

		$this->scssc = new scssc();
		$this->scssc->setImportPaths( $scss_dir );

		$_options = $scss_dir . 'variables.scss';

		$this->redux->filesystem->execute( 'put_contents', $_options, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->options_output() )
		) );
		$css_file = $css_dir . 'theme.css';

		$this->scssc->setFormatter( 'scss_formatter' );
		$this->redux->filesystem->execute( 'put_contents', $css_file, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->scssc->compile( '@import "theme.scss"' ) )
		) );
	}

	/**
	 * Output options to _variables.scss
	 *
	 * @access protected
	 * @return string
	 */
	protected function options_output() {
		ob_start();

		$primary_color = evolt_get_option( 'primary_color', '#1f201c' );
		if ( ! evolt_is_valid_color( $primary_color ) ) {
			$primary_color = '#1f201c';
		}
		printf( '$primary_color: %s;', esc_attr( $primary_color ) );

		$secondary_color = evolt_get_option( 'secondary_color', '#000000' );
		if ( ! evolt_is_valid_color( $secondary_color ) ) {
			$secondary_color = '#000000';
		}
		printf( '$secondary_color: %s;', esc_attr( $secondary_color ) );

		$third_color = evolt_get_option( 'third_color', '#ff05ff' );
        if ( !evolt_is_valid_color( $third_color ) )
        {
            $third_color = '#ff05ff';
        }
        printf( '$third_color: %s;', esc_attr( $third_color ) );

        $dark_color = evolt_get_option( 'dark_color', '#082680' );
        if ( !evolt_is_valid_color( $dark_color ) )
        {
            $dark_color = '#082680';
        }
        printf( '$dark_color: %s;', esc_attr( $dark_color ) );

		$link_color = evolt_get_option( 'link_color', '#1f201c' );
		if ( ! empty( $link_color['regular'] ) && isset( $link_color['regular'] ) ) {
			printf( '$link_color: %s;', esc_attr( $link_color['regular'] ) );
		} else {
			echo '$link_color: #1f201c;';
		}

		$link_color_hover = evolt_get_option( 'link_color', '#1f201c' );
		if ( ! empty( $link_color['hover'] ) && isset( $link_color['hover'] ) ) {
			printf( '$link_color_hover: %s;', esc_attr( $link_color['hover'] ) );
		} else {
			echo '$link_color_hover: #1f201c;';
		}

		$link_color_active = evolt_get_option( 'link_color', '#1f201c' );
		if ( ! empty( $link_color['active'] ) && isset( $link_color['active'] ) ) {
			printf( '$link_color_active: %s;', esc_attr( $link_color['active'] ) );
		} else {
			echo '$link_color_active: #1f201c;';
		}

		/* Gradient Color Main */
        $gradient_color = evolt_get_option( 'gradient_color' );
        if ( !empty($gradient_color['from']) && isset($gradient_color['from']) )
        {
            printf( '$gradient_color_from: %s;', esc_attr( $gradient_color['from'] ) );
        } else {
            echo '$gradient_color_from: '.$primary_color.';';
        }
        if ( !empty($gradient_color['to']) && isset($gradient_color['to']) )
        {
            printf( '$gradient_color_to: %s;', esc_attr( $gradient_color['to'] ) );
        } else {
            echo '$gradient_color_to: '.$primary_color.';';
        }


		/* Font */
		$body_default_font = evolt_get_option( 'body_default_font', 'Roboto' );
		if ( isset( $body_default_font ) ) {
			echo '
                $body_default_font: ' . esc_attr( $body_default_font ) . ';
            ';
		}

		$heading_default_font = evolt_get_option( 'heading_default_font', 'Libre-Caslon-Text' );
		if ( isset( $heading_default_font ) ) {
			echo '
                $heading_default_font: ' . esc_attr( $heading_default_font ) . ';
            ';
		}

		return ob_get_clean();
	}

	/**
	 * Hooked wp_enqueue_scripts - 20
	 * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
	 */
	function enqueue() {
		$css = $this->inline_css();
		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'evolt-theme', $css );
		}
	}

	/**
	 * Generate inline css based on theme options
	 */
	protected function inline_css() {
		ob_start();

		/* Logo */
		$logo_maxh = evolt_get_option( 'logo_maxh' );
		$logo_maxh_sticky = evolt_get_option( 'logo_maxh_sticky' );

		if ( ! empty( $logo_maxh['height'] ) && $logo_maxh['height'] != 'px' ) {
			printf( '#evolt-header-wrap .evolt-header-branding a img { max-height: %s !important; }', esc_attr( $logo_maxh['height'] ) );
		} 
		if ( ! empty( $logo_maxh_sticky['height'] ) && $logo_maxh_sticky['height'] != 'px' ) {
			printf( '#evolt-header-wrap #evolt-header.h-fixed .evolt-header-branding a img { max-height: %s !important; }', esc_attr( $logo_maxh_sticky['height'] ) );
		}

		?>
        @media screen and (max-width: 1199px) {
		<?php
			$logo_maxh_sm = evolt_get_option( 'logo_maxh_sm' );
			if ( ! empty( $logo_maxh_sm['height'] ) && $logo_maxh_sm['height'] != 'px' ) {
				printf( '#evolt-header-wrap .evolt-header-branding a img { max-height: %s !important; }', esc_attr( $logo_maxh_sm['height'] ) );
			} ?>
        }
        <?php /* End Logo */

		/* Menu */ ?>
		@media screen and (min-width: 1200px) {
		<?php  
			$topbar_bg_color = evolt_get_option( 'topbar_bg_color' );
			$header_bg_color = evolt_get_option( 'header_bg_color' );
			if ( ! empty( $topbar_bg_color ) ) {
				printf( '#evolt-header-top { background-color: %s !important; }', esc_attr( $topbar_bg_color ) );
			}

			if ( ! empty( $header_bg_color ) ) {
				printf( '#evolt-header-wrap #evolt-header, #evolt-header-wrap #evolt-header .evolt-header-navigation-bg, #evolt-header-wrap.evolt-header-layout7 #evolt-header:not(.h-fixed) .evolt-header-navigation { background-color: %s !important; }', esc_attr( $header_bg_color ) );
				printf( '#evolt-header-wrap.evolt-header-layout3 #evolt-header { background-color: transparent !important; }', esc_attr( $header_bg_color ) );

				printf( '#evolt-header-wrap.evolt-header-layout3 #evolt-header.h-fixed { background-color: %s !important; }', esc_attr( $header_bg_color ) );
				printf( '#evolt-header-wrap.evolt-header-layout3 #evolt-header.h-fixed .evolt-header-navigation-bg { background-color: transparent !important; }', esc_attr( $header_bg_color ) );
			}

			$main_menu_color = evolt_get_option( 'main_menu_color' );
			if ( ! empty( $main_menu_color['regular'] ) ) {
				printf( '.evolt-main-menu > li > a { color: %s !important; }', esc_attr( $main_menu_color['regular'] ) );
			}
			if ( ! empty( $main_menu_color['hover'] ) ) {
				printf( '.evolt-main-menu > li > a:hover { color: %s !important; }', esc_attr( $main_menu_color['hover'] ) );
			}
			if ( ! empty( $main_menu_color['active'] ) ) {
				printf( '.evolt-main-menu > li.current_page_item > a, .evolt-main-menu > li.current-menu-item > a, .evolt-main-menu > li.current_page_ancestor > a, .evolt-main-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $main_menu_color['active'] ) );
			}
			$sticky_menu_color = evolt_get_option( 'sticky_menu_color' );
			if ( ! empty( $sticky_menu_color['regular'] ) ) {
				printf( '#evolt-header.h-fixed .evolt-main-menu > li > a { color: %s !important; }', esc_attr( $sticky_menu_color['regular'] ) );
			}
			if ( ! empty( $sticky_menu_color['hover'] ) ) {
				printf( '#evolt-header.h-fixed .evolt-main-menu > li > a:hover { color: %s !important; }', esc_attr( $sticky_menu_color['hover'] ) );
			}
			if ( ! empty( $sticky_menu_color['active'] ) ) {
				printf( '#evolt-header.h-fixed .evolt-main-menu > li.current_page_item > a, #evolt-header.h-fixed .evolt-main-menu > li.current-menu-item > a, #evolt-header.h-fixed .evolt-main-menu > li.current_page_ancestor > a, #evolt-header.h-fixed .evolt-main-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $sticky_menu_color['active'] ) );
			}
			$sub_menu_color = evolt_get_option( 'sub_menu_color' );
			if ( ! empty( $sub_menu_color['regular'] ) ) {
				printf( '#evolt-header .evolt-main-menu .sub-menu > li > a { color: %s !important; }', esc_attr( $sub_menu_color['regular'] ) );
			}
			if ( ! empty( $sub_menu_color['hover'] ) ) {
				printf( '#evolt-header .evolt-main-menu .sub-menu > li > a:hover { color: %s !important; }', esc_attr( $sub_menu_color['hover'] ) );
				printf( '#evolt-header .evolt-main-menu .sub-menu > li > a:before { background-color: %s !important; }', esc_attr( $sub_menu_color['hover'] ) );
			}
			if ( ! empty( $sub_menu_color['active'] ) ) {
				printf( '#evolt-header .evolt-main-menu .sub-menu > li.current_page_item > a, #evolt-header .evolt-main-menu .sub-menu > li.current-menu-item > a, #evolt-header .evolt-main-menu .sub-menu > li.current_page_ancestor > a, #evolt-header .evolt-main-menu .sub-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $sub_menu_color['active'] ) );
				printf( '#evolt-header .evolt-main-menu .sub-menu > li.current_page_item > a:before, #evolt-header .evolt-main-menu .sub-menu > li.current-menu-item > a:before, #evolt-header .evolt-main-menu .sub-menu > li.current_page_ancestor > a:before, #evolt-header .evolt-main-menu .sub-menu > li.current-menu-ancestor > a:before { background-color: %s !important; }', esc_attr( $sub_menu_color['active'] ) );
			}
			$menu_icon_color = evolt_get_option( 'menu_icon_color' );
			if ( ! empty( $menu_icon_color ) ) {
				printf( '.evolt-main-menu .link-icon { color: %s !important; }', esc_attr( $menu_icon_color ) );
			}
			?>
		}
		<?php /* End Menu */

		/* Page Title */
		$ptitle_bg = evolt_get_page_option( 'ptitle_bg' );
		$custom_pagetitle = evolt_get_page_option( 'custom_pagetitle', 'themeoption' );
		if ( $custom_pagetitle == 'show' && ! empty( $ptitle_bg['background-image'] ) ) {
			echo 'body .site #pagetitle.page-title {
                background-image: url(' . esc_attr( $ptitle_bg['background-image'] ) . ');
            }';
		}
		if ( $custom_pagetitle == 'show' && ! empty( $ptitle_bg['background-color'] ) ) {
			echo 'body .site #pagetitle.page-title {
                background-color: '. esc_attr( $ptitle_bg['background-color'] ) .';
            }';
		}

		/* Custom Css */
		$custom_css = evolt_get_option( 'site_css' );
		if ( ! empty( $custom_css ) ) {
			echo esc_attr( $custom_css );
		}

		return ob_get_clean();
	}
}

new CSS_Generator();