<?php
evolt_add_custom_widget(
    array(
        'name' => 'evolt_portfolio_details',
        'title' => esc_html__('Wider Portdolio Details', 'evolt'),
        'icon' => 'eicon-library-upload',
        'categories' => array(Wider_Theme_Core::EVOLT_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'evolt'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'wg_title',
                            'label' => esc_html__('Widget Title', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'portfolio_content',
                            'label' => esc_html__('Content', 'evolt'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'label',
                                    'label' => esc_html__('Label', 'evolt' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'evolt' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                            ),
                            'title_field' => '{{{ label }}}',
                        ),
                        array(
                            'name' => 'value_label',
                            'label' => esc_html__('Value Label', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'value_text',
                            'label' => esc_html__('Value Text', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);