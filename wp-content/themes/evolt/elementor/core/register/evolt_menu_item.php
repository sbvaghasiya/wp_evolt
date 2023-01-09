<?php
evolt_add_custom_widget(
    array(
        'name' => 'evolt_menu_item',
        'title' => esc_html__('Wider Menu Items', 'evolt'),
        'icon' => 'eicon-columns',
        'categories' => array(Wider_Theme_Core::EVOLT_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'evolt'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Menu Type', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'wg_title',
                            'label' => esc_html__('Widget Title', 'evolt'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'style' => ['style2'],
                            ],
                        ),
                        array(
                            'name' => 'menu_item',
                            'label' => esc_html__('Item', 'evolt'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'evolt_icon',
                                    'label' => esc_html__('Icon', 'evolt' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                ),
                                array(
                                    'name' => 'text',
                                    'label' => esc_html__('Text', 'evolt'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'label',
                                    'label' => esc_html__('Label', 'evolt'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'evolt'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ text }}}',
                        ),
                        array(
                            'name' => 'col',
                            'label' => esc_html__('Column', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'col1' => '1 Column',
                                'col2' => '2 Column',
                            ],
                            'default' => 'col1',
                            'condition' => [
                                'style' => ['style3'],
                            ],
                        ),
                        array(
                            'name' => 'evolt_animate',
                            'label' => esc_html__('Wider Animate', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => evolt_animate(),
                            'default' => '',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'evolt'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-menu-item-wrap .evolt-menu-item li a, {{WRAPPER}} .evolt-menu-item-wrap .evolt-menu-item li a:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .evolt-menu-item-wrap .evolt-menu-item li a span:before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__('Link Color Hover', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-menu-item-wrap .evolt-menu-item li a:hover, {{WRAPPER}} .evolt-menu-item-wrap .evolt-menu-item li a:hover:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .evolt-menu-item-wrap .evolt-menu-item li a:hover span:before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_typography',
                            'label' => esc_html__('Link Typography', 'evolt' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .evolt-menu-item-wrap .evolt-menu-item li a',
                        ),
                        array(
                            'name' => 'item_space',
                            'label' => esc_html__('Item Spacer', 'evolt' ),
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
                                '{{WRAPPER}} .evolt-menu-item-wrap .evolt-menu-item li + li' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'style' => ['style1','style3'],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);