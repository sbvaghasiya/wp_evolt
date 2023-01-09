<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param  EVOLT_Post_Metabox $metabox
 */

/**
 * Get list menu.
 * @return array
 */
function evolt_get_nav_menu(){

    $menus = array(
        '' => esc_html__('Default', 'evolt')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->term_id] = $obj_menu->name;
    }

    return $menus;
}

add_action( 'evolt_post_metabox_register', 'evolt_page_options_register' );

function evolt_page_options_register( $metabox ) {

	if ( ! $metabox->isset_args( 'post' ) ) {
		$metabox->set_args( 'post', array(
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'evolt' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'product' ) ) {
		$metabox->set_args( 'product', array(
			'opt_name'            => 'product_option',
			'display_name'        => esc_html__( 'Product Settings', 'evolt' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'page' ) ) {
		$metabox->set_args( 'page', array(
			'opt_name'            => evolt_get_page_option_name(),
			'display_name'        => esc_html__( 'Page Settings', 'evolt' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'evolt_pf_audio' ) ) {
		$metabox->set_args( 'evolt_pf_audio', array(
			'opt_name'     => 'post_format_audio',
			'display_name' => esc_html__( 'Audio', 'evolt' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'evolt_pf_link' ) ) {
		$metabox->set_args( 'evolt_pf_link', array(
			'opt_name'     => 'post_format_link',
			'display_name' => esc_html__( 'Link', 'evolt' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'evolt_pf_quote' ) ) {
		$metabox->set_args( 'evolt_pf_quote', array(
			'opt_name'     => 'post_format_quote',
			'display_name' => esc_html__( 'Quote', 'evolt' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'evolt_pf_video' ) ) {
		$metabox->set_args( 'evolt_pf_video', array(
			'opt_name'     => 'post_format_video',
			'display_name' => esc_html__( 'Video', 'evolt' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'evolt_pf_gallery' ) ) {
		$metabox->set_args( 'evolt_pf_gallery', array(
			'opt_name'     => 'post_format_gallery',
			'display_name' => esc_html__( 'Gallery', 'evolt' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/* Extra Post Type */

	if ( ! $metabox->isset_args( 'service' ) ) {
		$metabox->set_args( 'service', array(
			'opt_name'            => 'service_option',
			'display_name'        => esc_html__( 'Service Settings', 'evolt' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'portfolio' ) ) {
		$metabox->set_args( 'portfolio', array(
			'opt_name'            => 'portfolio_option',
			'display_name'        => esc_html__( 'Portfolio Settings', 'evolt' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/**
	 * Config post meta options
	 *
	 */
	$metabox->add_section( 'post', array(
		'title'  => esc_html__( 'Post Settings', 'evolt' ),
		'icon'   => 'el el-refresh',
		'fields' => array(
			array(
				'id'             => 'post_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-post #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'evolt' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'evolt' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'evolt' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
			array(
				'id'      => 'show_sidebar_post',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Sidebar', 'evolt' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_post_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'evolt' ),
				'options'      => array(
					'left'  => esc_html__('Left', 'evolt'),
	                'right' => esc_html__('Right', 'evolt'),
	                'none'  => esc_html__('Disabled', 'evolt')
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_post', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );

	/**
	 * Config page meta options
	 *
	 */
	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Header', 'evolt' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'evolt' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_main_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Layout', 'evolt' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'evolt' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'evolt' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
					'4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
					'5' => get_template_directory_uri() . '/assets/images/header-layout/h5.jpg',
					'6' => get_template_directory_uri() . '/assets/images/header-layout/h6.jpg',
					'7' => get_template_directory_uri() . '/assets/images/header-layout/h7.jpg',
					'8' => get_template_directory_uri() . '/assets/images/header-layout/h8.jpg',
					'9' => get_template_directory_uri() . '/assets/images/header-layout/h9.jpg',
					'10' => get_template_directory_uri() . '/assets/images/header-layout/h10.jpg',
				),
				'default'      => evolt_get_optionion_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_main_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
			array(
	            'id'       => 'sticky_header_type_page',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Sticky Header Type', 'evolt'),
	            'options'  => array(
	                'themeoption'  => esc_html__('Theme Option', 'evolt'),
	                'scroll-to-bottom'  => esc_html__('Scroll To Bottom', 'evolt'),
	                'scroll-to-top'  => esc_html__('Scroll To Top', 'evolt'),
	            ),
	            'default'  => 'themeoption',
	        ),
	        array(
	            'id'       => 'icon_has_children',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Icon Has Children', 'evolt'),
	            'options'  => array(
	            	'themeoption'  => esc_html__('Theme Option', 'evolt'),
	                'plus'  => esc_html__('Plus', 'evolt'),
	                'arrow'  => esc_html__('Arrow', 'evolt')
	            ),
	            'default'  => 'themeoption',
	        ),
	        array(
	            'id' => 'btn_custom_text',
	            'type' => 'text',
	            'title' => esc_html__('Button Custom Text', 'evolt'),
	            'default' => '',
	            'desc' => esc_html__('Applicable to a few header layouts.', 'evolt'),
	            'required'     => array( 0 => 'custom_main_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
	        ),
			array(
	            'title' => esc_html__('Logo', 'evolt'),
	            'type'  => 'section',
	            'id' => 'logo_page',
	            'indent' => true,
	            'required'     => array( 0 => 'custom_main_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
	        ),
			array(
	            'id'       => 'page_dark_logo',
	            'type'     => 'media',
	            'title'    => esc_html__('Custom Logo Dark', 'evolt'),
	            'default' => '',
	            'required'     => array( 0 => 'custom_main_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
	        ),
	        array(
	            'id'       => 'page_light_logo',
	            'type'     => 'media',
	            'title'    => esc_html__('Custom Logo Light', 'evolt'),
	            'default' => '',
	            'required'     => array( 0 => 'custom_main_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
	        ),
	        array(
	            'id'       => 'page_mobile_logo',
	            'type'     => 'media',
	            'title'    => esc_html__('Custom Logo Tablet & Mobile', 'evolt'),
	            'default' => '',
	            'required'     => array( 0 => 'custom_main_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
	        ),
	        array(
	            'title' => esc_html__('Main Menu', 'evolt'),
	            'type'  => 'section',
	            'id' => 'main_menu_page',
	            'indent' => true
	        ),
	        array(
                'id'       => 'h_custom_menu',
                'type'     => 'select',
                'title'    => esc_html__( 'Custom Menu', 'evolt' ),
                'subtitle' => esc_html__( 'Custom menu for current page.', 'evolt' ),
                'options'  => evolt_get_nav_menu(),
                'default' => '',
            ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Page Title', 'evolt' ),
		'icon'   => 'el el-indent-left',
		'fields' => array(
			array(
				'id'           => 'custom_pagetitle',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Page Title', 'evolt' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'evolt' ),
					'show'  => esc_html__( 'Custom', 'evolt' ),
					'hide'  => esc_html__( 'Hide', 'evolt' ),
				),
				'default'      => 'themeoption',
			),
			array(
				'id'           => 'custom_title',
				'type'         => 'textarea',
				'title'        => esc_html__( 'Title', 'evolt' ),
				'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'evolt' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
			array(
	            'id'       => 'ptitle_bg',
	            'type'     => 'background',
	            'background-color'     => true,
	            'background-repeat'     => false,
	            'background-size'     => false,
	            'background-attachment'     => false,
	            'background-position'     => false,
	            'transparent'     => false,
	            'title'    => esc_html__('Background', 'evolt'),
	            'subtitle' => esc_html__('Page title background image.', 'evolt'),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
	        array(
				'id'       => 'ptitle_bg_overlay',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color Overlay', 'evolt' ),
				'subtitle' => esc_html__( 'Page title background color overlay.', 'evolt' ),
				'output'   => array( 'background-color' => 'body #pagetitle:before' ),
				'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
			),
	        array(
	            'id'             => 'ptitle_padding',
	            'type'           => 'spacing',
	            'output'         => array('.site #pagetitle.page-title'),
	            'right'   => false,
	            'left'    => false,
	            'mode'           => 'padding',
	            'units'          => array('px'),
	            'units_extended' => 'false',
	            'title'          => esc_html__('Page Title Padding', 'evolt'),
	            'default'            => array(
	                'padding-top'   => '',
	                'padding-bottom'   => '',
	                'units'          => 'px',
	            ),
	            'required'     => array( 0 => 'custom_pagetitle', 1 => '=', 2 => 'show' ),
				'force_output' => true
	        ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Content', 'evolt' ),
		'desc'   => esc_html__( 'Settings for content area.', 'evolt' ),
		'icon'   => 'el-icon-pencil',
		'fields' => array(
	        array(
				'id'           => 'loading_page',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Loading', 'evolt' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'evolt' ),
					'custom' => esc_html__( 'Cuttom', 'evolt' ),
				),
				'default'      => 'themeoption',
			),
			array(
	            'id'       => 'loading_type',
	            'type'     => 'select',
	            'title'    => esc_html__('Loading Type', 'evolt'),
	            'options'  => array(
	                'style1'  => esc_html__('Style 1', 'evolt'),
	                'style2'  => esc_html__('Style 2', 'evolt'),
	                'style3'  => esc_html__('Style 3', 'evolt'),
	                'style4'  => esc_html__('Style 4', 'evolt'),
	                'style5'  => esc_html__('Style 5', 'evolt'),
	                'style6'  => esc_html__('Style 6', 'evolt'),
	                'style7'  => esc_html__('Style 7', 'evolt'),
	                'style8'  => esc_html__('Style 8', 'evolt'),
	                'style9'  => esc_html__('Style 9', 'evolt'),
	                'style10'  => esc_html__('Style 10', 'evolt'),
	                'style11'  => esc_html__('Style 11', 'evolt'),
	                'style12'  => esc_html__('Style 12', 'evolt'),
	            ),
	            'default'  => 'style1',
	            'required'     => array( 0 => 'loading_page', 1 => '=', 2 => 'custom' ),
				'force_output' => true
	        ),
			array(
				'id'       => 'content_bg_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'evolt' ),
				'subtitle' => esc_html__( 'Content background color.', 'evolt' ),
				'output'   => array( 'background-color' => 'body .site-content' )
			),
			array(
				'id'             => 'content_padding',
				'type'           => 'spacing',
				'output'         => array( '#content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'evolt' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'evolt' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
			array(
				'id'      => 'show_sidebar_page',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Sidebar', 'evolt' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_page_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'evolt' ),
				'options'      => array(
					'left'  => esc_html__( 'Left', 'evolt' ),
					'right' => esc_html__( 'Right', 'evolt' ),
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_page', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Footer', 'evolt' ),
		'desc'   => esc_html__( 'Settings for footer area.', 'evolt' ),
		'icon'   => 'el el-website',
		'fields' => array(
			array(
				'id'      => 'custom_footer',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Layout', 'evolt' ),
				'default' => false,
				'indent'  => true
			),
	        array(
	            'id'          => 'footer_custom_custom',
	            'type'        => 'select',
	            'title'       => esc_html__('Layout', 'evolt'),
	            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','evolt'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
	            'options'     =>evolt_list_post('footer'),
	            'default'     => '',
	            'required' => array( 0 => 'custom_footer', 1 => 'equals', 2 => '1' ),
	            'force_output' => true
	        ),
	        array(
	            'id'       => 'footer_bg_color',
	            'type'     => 'color_rgba',
	            'title'    => esc_html__( 'Background Color', 'evolt' ),
	            'subtitle' => esc_html__( 'Page title background color overlay.', 'evolt' ),
	            'output'   => array( 'background-color' => '.site-footer-custom' ),
	            'force_output' => true,
	        ),
	    )
	) );

	/**
	 * Config post format meta options
	 *
	 */

	$metabox->add_section( 'evolt_pf_video', array(
		'title'  => esc_html__( 'Video', 'evolt' ),
		'fields' => array(
			array(
				'id'    => 'post-video-url',
				'type'  => 'text',
				'title' => esc_html__( 'Video URL', 'evolt' ),
				'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'evolt' )
			),

			array(
				'id'    => 'post-video-file',
				'type'  => 'editor',
				'title' => esc_html__( 'Video Upload', 'evolt' ),
				'desc'  => esc_html__( 'Upload video file', 'evolt' )
			),

			array(
				'id'    => 'post-video-html',
				'type'  => 'textarea',
				'title' => esc_html__( 'Embadded video', 'evolt' ),
				'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'evolt' )
			)
		)
	) );

	$metabox->add_section( 'evolt_pf_gallery', array(
		'title'  => esc_html__( 'Gallery', 'evolt' ),
		'fields' => array(
			array(
				'id'       => 'post-gallery-lightbox',
				'type'     => 'switch',
				'title'    => esc_html__( 'Lightbox?', 'evolt' ),
				'subtitle' => esc_html__( 'Enable lightbox for gallery images.', 'evolt' ),
				'default'  => true
			),
			array(
				'id'       => 'post-gallery-images',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Gallery Images ', 'evolt' ),
				'subtitle' => esc_html__( 'Upload images or add from media library.', 'evolt' )
			)
		)
	) );

	$metabox->add_section( 'evolt_pf_audio', array(
		'title'  => esc_html__( 'Audio', 'evolt' ),
		'fields' => array(
			array(
				'id'          => 'post-audio-url',
				'type'        => 'text',
				'title'       => esc_html__( 'Audio URL', 'evolt' ),
				'description' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'evolt' ),
				'validate'    => 'url',
				'msg'         => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'evolt_pf_link', array(
		'title'  => esc_html__( 'Link', 'evolt' ),
		'fields' => array(
			array(
				'id'       => 'post-link-url',
				'type'     => 'text',
				'title'    => esc_html__( 'URL', 'evolt' ),
				'validate' => 'url',
				'msg'      => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'evolt_pf_quote', array(
		'title'  => esc_html__( 'Quote', 'evolt' ),
		'fields' => array(
			array(
				'id'    => 'post-quote-cite',
				'type'  => 'text',
				'title' => esc_html__( 'Cite', 'evolt' )
			)
		)
	) );

	/**
	 * Config service meta options
	 *
	 */
	$metabox->add_section( 'service', array(
		'title'  => esc_html__( 'General', 'evolt' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
	            'id'       => 'icon_type',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Icon Type', 'evolt'),
	            'options'  => array(
	                'icon'  => esc_html__('Icon', 'evolt'),
	                'image'  => esc_html__('Image', 'evolt'),
	            ),
	            'default'  => 'icon'
	        ),
			array(
	            'id'       => 'service_icon',
	            'type'     => 'evolt_iconpicker',
	            'title'    => esc_html__('Icon', 'evolt'),
	            'required' => array( 0 => 'icon_type', 1 => 'equals', 2 => 'icon' ),
            	'force_output' => true
	        ),
	        array(
	            'id'       => 'service_icon_img',
	            'type'     => 'media',
	            'title'    => esc_html__('Icon Image', 'evolt'),
	            'default' => '',
	            'required' => array( 0 => 'icon_type', 1 => 'equals', 2 => 'image' ),
            	'force_output' => true
	        ),
			array(
				'id'       => 'service_except',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Excerpt', 'evolt' ),
				'validate' => 'no_html'
			),
			array(
				'id'             => 'service_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-service #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'evolt' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'evolt' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'evolt' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );

	/**
	 * Config portfolio meta options
	 *
	 */
	$metabox->add_section( 'portfolio', array(
		'title'  => esc_html__( 'General', 'evolt' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
	            'id'       => 'icon_type',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Icon Type', 'evolt'),
	            'options'  => array(
	                'icon'  => esc_html__('Icon', 'evolt'),
	                'image'  => esc_html__('Image', 'evolt'),
	            ),
	            'default'  => 'icon'
	        ),
			array(
	            'id'       => 'portfolio_icon',
	            'type'     => 'evolt_iconpicker',
	            'title'    => esc_html__('Icon', 'evolt'),
	            'required' => array( 0 => 'icon_type', 1 => 'equals', 2 => 'icon' ),
            	'force_output' => true
	        ),
	        array(
	            'id'       => 'portfolio_icon_img',
	            'type'     => 'media',
	            'title'    => esc_html__('Icon Image', 'evolt'),
	            'default' => '',
	            'required' => array( 0 => 'icon_type', 1 => 'equals', 2 => 'image' ),
            	'force_output' => true
	        ),
			array(
				'id'       => 'portfolio_except',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Excerpt', 'evolt' ),
				'validate' => 'no_html'
			),
			array(
				'id'             => 'portfolio_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-portfolio #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'evolt' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'evolt' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'evolt' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );


	/**
     * Config product meta options
     *
     */
    $metabox->add_section('product', array(
        'title'  => esc_html__('Product Settings', 'evolt'),
        'icon'   => 'el el-briefcase',
        'fields' => array(
		    array(
	            'id'      => 'product_date',
	            'type'    => 'text',
	            'title'   => esc_html__('Countdown', 'evolt'),
	            'default' => '',
	            'description' => esc_html__('Set date count down (Date format: yy/mm/dd)', 'evolt'),
	        ),
            array(
	            'id'          => 'line_color',
	            'type'        => 'color_rgba',
	            'title'       => esc_html__('Line Color', 'evolt'),
	            'transparent' => false,
	            'default'     => ''
	        ),
        )
    ));

}

function evolt_get_optionion_of_theme_options( $key, $default = '' ) {
	if ( empty( $key ) ) {
		return '';
	}
	$options = get_option( evolt_get_option_name(), array() );
	$value   = isset( $options[ $key ] ) ? $options[ $key ] : $default;

	return $value;
}