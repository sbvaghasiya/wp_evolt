<?php
// Register Button Widget
evolt_add_custom_widget(
    array(
        'name' => 'evolt_button',
        'title' => esc_html__('Wider Button', 'evolt' ),
        'icon' => 'eicon-button',
        'categories' => array( Wider_Theme_Core::EVOLT_CATEGORY_NAME ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'evolt' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default btn-animate',
                            'options' => [
                                'btn-default btn-animate' => esc_html__('Default', 'evolt' ),
                                'btn-white-icon' => esc_html__('White Icon Fixed', 'evolt' ),
                                'btn-icon-fixed-left btn-animate' => esc_html__('Icon Fixed Left', 'evolt' ),
                                'btn-slider-animate1' => esc_html__('Animate One', 'evolt' ),
                                'btn-slider-animate2' => esc_html__('Animate Two', 'evolt' ),
                            ],
                        ),
                        array(
                            'name' => 'text',
                            'label' => esc_html__('Text', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Click here', 'evolt'),
                            'placeholder' => esc_html__('Click here', 'evolt'),
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'placeholder' => esc_html__('https://your-link.com', 'evolt' ),
                            'default' => [
                                'url' => '#',
                            ],
                        ),
                        array(
                            'name' => 'align',
                            'label' => esc_html__('Alignment', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left'    => [
                                    'title' => esc_html__('Left', 'evolt' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'evolt' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'evolt' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__('Justified', 'evolt' ),
                                    'icon' => 'fa fa-align-justify',
                                ],
                            ],
                            'prefix_class' => 'elementor-align-',
                            'default' => '',
                            'selectors'         => [
                                '{{WRAPPER}} .evolt-button-wrapper' => 'text-align: {{VALUE}}',
                            ],
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'btn_border_radius',
                            'label' => esc_html__('Border Radius', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'typography',
                            'label' => esc_html__('Typography', 'evolt' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .evolt-button-wrapper .btn',
                        ),
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Icon', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'label_block' => true,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'style' => ['btn-default btn-animate', 'btn-white-icon', 'btn-icon-fixed-left btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'icon_align',
                            'label' => esc_html__('Icon Position', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'left',
                            'options' => [
                                'left' => esc_html__('Before', 'evolt' ),
                                'right' => esc_html__('After', 'evolt' ),
                            ],
                            'condition' => [
                                'btn_icon!' => '',
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'icon_space_left',
                            'label' => esc_html__('Icon Space Left', 'evolt' ),
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
                                '{{WRAPPER}} .evolt-button-wrapper .evolt-button-icon.evolt-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_align' => ['left'],
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'icon_space_right',
                            'label' => esc_html__('Icon Space Right', 'evolt' ),
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
                                '{{WRAPPER}} .evolt-button-wrapper .evolt-button-icon.evolt-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_align' => ['right'],
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'icon_font_size',
                            'label' => esc_html__('Icon Font Size', 'evolt' ),
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
                                '{{WRAPPER}} .evolt-button-wrapper .evolt-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'btn_color',
                            'label' => esc_html__('Text Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'btn_bg_color',
                            'label' => esc_html__('Background Color Main', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn' => 'background: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'style' => ['btn-default btn-animate', 'btn-white-icon', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'btn_bg_color_gradient',
                            'label' => esc_html__('Background Color Gradient', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'btn_bg_color_hover',
                            'label' => esc_html__('Background Color Hover', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn:not(.btn-animate):hover, {{WRAPPER}} .evolt-button-wrapper .btn:not(.btn-animate):focus, {{WRAPPER}} .btn.btn-animate:before' => 'background: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'style' => ['btn-default btn-animate', 'btn-white-icon', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'btn_color_hover',
                            'label' => esc_html__('Text Color Hover', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn:hover' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'border_type',
                            'label' => esc_html__( 'Border Type', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '' => esc_html__( 'None', 'evolt' ),
                                'solid' => esc_html__( 'Solid', 'evolt' ),
                                'double' => esc_html__( 'Double', 'evolt' ),
                                'dotted' => esc_html__( 'Dotted', 'evolt' ),
                                'dashed' => esc_html__( 'Dashed', 'evolt' ),
                                'groove' => esc_html__( 'Groove', 'evolt' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn' => 'border-style: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'border_type!' => '',
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
                            ],
                            'responsive' => true,
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .evolt-button-wrapper .btn' => 'border-color: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'border_type!' => '',
                                'style' => ['btn-default btn-animate', 'btn-slider-animate1', 'btn-slider-animate2'],
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