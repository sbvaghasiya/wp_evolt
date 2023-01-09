<?php
// Register Icon Box Widget
evolt_add_custom_widget(
    array(
        'name' => 'evolt_shop_banner',
        'title' => esc_html__('Wider Shop Banner', 'evolt' ),
        'icon' => 'eicon-product-images',
        'categories' => array( Wider_Theme_Core::EVOLT_CATEGORY_NAME ),
        'scripts' => array(

        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'evolt' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'evolt' ),
                            'type' => Wider_Theme_Core::LAYOUT_CONTROL,
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'evolt' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/evolt_shop_banner/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'evolt' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/evolt_shop_banner/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'evolt' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/evolt_shop_banner/layout-image/layout3.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_title',
                    'label' => esc_html__('Title', 'evolt' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title_text',
                            'label' => esc_html__('Title', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'placeholder' => esc_html__('Enter your title', 'evolt' ),
                            'label_block' => true,
                        ),  
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'evolt' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .evolt-shop-banner .item--title',
                        ),
                        array(
                            'name' => 'title_space_bottom',
                            'label' => esc_html__('Title Bottom Spacer', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'evolt_animate_title',
                            'label' => esc_html__('Wider Animate', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => evolt_animate(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'evolt_animate_delay_title',
                            'label' => esc_html__('Animate Delay', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => 'Enter number. Default 0ms',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_desc',
                    'label' => esc_html__('Description', 'evolt' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => ['1', '2'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'description_text',
                            'label' => esc_html__('Description', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'placeholder' => esc_html__('Enter your description', 'evolt' ),
                            'rows' => 10,
                            'show_label' => false,
                        ),  
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Description Typography', 'evolt' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .evolt-shop-banner .item--description',
                        ),
                        array(
                            'name' => 'desc_space_bottom',
                            'label' => esc_html__('Description Bottom Spacer', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--description' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'evolt_animate_desc',
                            'label' => esc_html__('Wider Animate', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => evolt_animate(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'evolt_animate_delay_des',
                            'label' => esc_html__('Animate Delay', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => 'Enter number. Default 0ms',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_button',
                    'label' => esc_html__('Button', 'evolt' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'btn_text',
                            'label' => esc_html__('Button Text', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'layout' => ['1','2'],
                            ],
                        ),
                        array(
                            'name' => 'btn_link',
                            'label' => esc_html__('Button Link', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Button Type', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'default' => 'Default',
                                'outline' => 'Outline',
                                'dot btn-third-dot' => 'Third',
                                'dot btn-primary-dot' => 'Primary',
                                'btn-plus' => 'Plus',
                                'btn-plus-circle' => 'Circle Plus',
                                'btn-line-arrow' => 'Line Arrow',
                            ],
                            'default' => 'default',
                            'condition' => [
                                'layout' => ['1', '2'],
                            ],
                        ),
                        array(
                            'name' => 'btn_bg_color',
                            'label' => esc_html__('Button Background Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .btn' => 'background: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'btn_style' => ['default','btn-plus'],
                            ],
                        ),
                        array(
                            'name' => 'btn_bg_color_hover_plus',
                            'label' => esc_html__('Button Background Color Hover', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner1 .btn.item--button-btn-plus-circle:hover::before, {{WRAPPER}}  .evolt-shop-banner2 .btn.item--button-btn-plus-circle:hover::before' => 'background-color: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'btn_style' => ['btn-plus-circle'],
                            ],
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Button Padding', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'button_typography',
                            'label' => esc_html__('Button Typography', 'evolt' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .evolt-shop-banner .btn',
                        ),
                        array(
                            'name' => 'button_icon_space_right',
                            'label' => esc_html__('Button Icon Space Right', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .btn.item--button-btn-plus i' => 'right: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'btn_style' => ['btn-plus'],
                            ],
                        ),
                        array(
                            'name' => 'evolt_animate_btn',
                            'label' => esc_html__('Wider Animate', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => evolt_animate(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'evolt_animate_delay_btn',
                            'label' => esc_html__('Animate Delay', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => 'Enter number. Default 0ms',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_image',
                    'label' => esc_html__('Image', 'evolt' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'fixed_image',
                            'label' => esc_html__( 'Top Image', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'layout' => ['1'],
                            ],
                        ),   
                        array(
                            'name' => 'animate_image',
                            'label' => esc_html__( 'Bottom Image', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),   
                        array(
                            'name' => 'bottom_image_max_width',
                            'label' => esc_html__('Bottom Image Max Width', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--image-animate' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'bottom_image_left_position',
                            'label' => esc_html__('Bottom Image Left Position', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--image-animate' => 'left: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'bottom_image_right_position',
                            'label' => esc_html__('Bottom Image Right Position', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--image-animate' => 'right: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'bottom_image_bottom_position',
                            'label' => esc_html__('Bottom Image Bottom Position', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--image-animate.animated' => 'bottom: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_label',
                    'label' => esc_html__('Label', 'evolt' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title_label',
                            'label' => esc_html__('Label', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),  
                        array(
                            'name' => 'label_style',
                            'label' => esc_html__('Label Style', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                            ],
                            'default' => 'style1',
                            'condition' => [
                                'layout' => ['1', '2'],
                            ],
                        ),
                        array(
                            'name' => 'label_position',
                            'label' => esc_html__('Label Position', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'position-left' => 'Left',
                                'position-right' => 'Right',
                            ],
                            'default' => 'position-right',
                            'condition' => [
                                'layout' => ['1', '2'],
                                'label_style' => ['style2'],
                            ],
                        ),
                        array(
                            'name' => 'label_color',
                            'label' => esc_html__('Label Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--title-label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_typography',
                            'label' => esc_html__('Label Typography', 'evolt' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .evolt-shop-banner .item--title-label',
                            'condition' => [
                                'layout' => ['1', '2'],
                            ],
                        ),
                        array(
                            'name' => 'evolt_animate_label',
                            'label' => esc_html__('Wider Animate', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => evolt_animate(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'evolt_animate_delay_label',
                            'label' => esc_html__('Animate Delay', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => 'Enter number. Default 0ms',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_extra',
                    'label' => esc_html__('Extra', 'evolt'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'wg_style',
                            'label' => esc_html__('Widget Style', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                            ],
                            'default' => 'style1',
                            'condition' => [
                                'layout' => ['1'],
                            ],
                        ),   
                        array(
                            'name' => 'box_color',
                            'label' => esc_html__('Box Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'box_color_hover',
                            'label' => esc_html__('Box Color Hover', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner:hover' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'box_bg_image',
                            'label' => esc_html__( 'Box Background Image', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'layout' => ['1','2'],
                            ],
                            'default' => '',
                        ),   
                        array(
                            'name' => 'box_padding',
                            'label' => esc_html__('Box Padding', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => ['1','2'],
                            ],
                        ),
                        array(
                            'name' => 'box_border_radius',
                            'label' => esc_html__('Box Border Radius', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['1','2'],
                            ],
                        ),
                        array(
                            'name' => 'content_max_width',
                            'label' => esc_html__('Content Max Width', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-shop-banner .item--holder' => 'max-width: {{SIZE}}% !important;',
                            ],
                            'description' => 'Unit: %',
                        ),
                        array(
                            'name' => 'box_shadow_display',
                            'label' => esc_html__('Box Shadow Hover', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'hide' => 'Hidden',
                                'show' => 'Show',
                            ],
                            'default' => 'hide',
                            'condition' => [
                                'layout' => ['1','2'],
                            ],
                        ),   
                        array(
                            'name' => 'box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::BOX_SHADOW,
                            'condition' => [
                                'layout' => ['1','2'],
                                'box_shadow_display' => ['show'],
                            ],
                            'selectors' => [
                                '{{SELECTOR}} .evolt-shop-banner:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};',
                            ],
                        ),   
                        array(
                            'name' => 'evolt_animate',
                            'label' => esc_html__('Wider Animate', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => evolt_animate(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'evolt_animate_delay',
                            'label' => esc_html__('Animate Delay', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => 'Enter number. Default 0ms',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);