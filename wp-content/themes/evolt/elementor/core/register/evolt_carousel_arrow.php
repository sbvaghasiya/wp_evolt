<?php

// Register Widget
evolt_add_custom_widget(
    array(
        'name' => 'evolt_carousel_arrow',
        'title' => esc_html__('Carousel Arrow', 'evolt'),
        'icon' => 'eicon-animation',
        'categories' => array(Wider_Theme_Core::EVOLT_CATEGORY_NAME),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'content_alignment_section',
                    'label' => esc_html__('Content Alignment', 'evolt' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                                'style4' => 'Style 4',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'arrow_align',
                            'label' => esc_html__('Alignment', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__('Left', 'evolt' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'evolt' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'flex-end' => [
                                    'title' => esc_html__('Right', 'evolt' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .evolt-nav-carousel' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'class',
                            'label' => esc_html__('Class', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);