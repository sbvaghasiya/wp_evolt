<?php
evolt_add_custom_widget(
    array(
        'name' => 'evolt_mailchimp_form',
        'title' => esc_html__('Wider Mailchimp Form', 'evolt'),
        'icon' => 'eicon-email-field',
        'categories' => array(Wider_Theme_Core::EVOLT_CATEGORY_NAME),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Color Settings', 'evolt'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'style' => ['style2','style3'],
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'evolt' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .evolt-mailchimp1 .evolt-mailchimp-meta .wg-title',
                            'condition' => [
                                'style' => ['style2','style3'],
                            ],
                        ),

                        array(
                            'name' => 'description_text',
                            'label' => esc_html__('Description', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'placeholder' => esc_html__('Enter your description', 'evolt' ),
                            'rows' => 10,
                            'show_label' => false,
                            'condition' => [
                                'style' => ['style3'],
                            ],
                        ),

                        array(
                            'name' => 'box_image_left',
                            'label' => esc_html__( 'Box Image Left', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'style' => ['style2'],
                            ],
                        ),
                        array(
                            'name' => 'box_image',
                            'label' => esc_html__( 'Box Background Image', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'style' => ['style2'],
                            ],
                        ),
                        array(
                            'name' => 'box_bg_color',
                            'label' => esc_html__('Box Background Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-mailchimp1.style2' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'style' => ['style2'],
                            ],
                        ),
                        array(
                            'name' => 'input_color',
                            'label' => esc_html__('Input Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-mailchimp.evolt-mailchimp1 .mc4wp-form .mc4wp-form-fields input' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'input_bg_color',
                            'label' => esc_html__('Input Background Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-mailchimp.evolt-mailchimp1 .mc4wp-form .mc4wp-form-fields input' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'input_border_color',
                            'label' => esc_html__('Input Focus Border Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-mailchimp1.style1 .mc4wp-form .mc4wp-form-fields input[type="email"], {{WRAPPER}} .evolt-mailchimp1.style1 .mc4wp-form .mc4wp-form-fields input[type="text"]' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'input_focus_border_color',
                            'label' => esc_html__('Input Focus Border Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-mailchimp1.style1 .mc4wp-form .mc4wp-form-fields input[type="email"]:focus, {{WRAPPER}} .evolt-mailchimp1.style1 .mc4wp-form .mc4wp-form-fields input[type="text"]:focus' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_icon_color',
                            'label' => esc_html__('Button Icon Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-mailchimp1.style1 .mc4wp-form .mc4wp-form-fields::after' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_bg_color',
                            'label' => esc_html__('Button Background Color', 'evolt' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .evolt-mailchimp.evolt-mailchimp1 .mc4wp-form .mc4wp-form-fields:before' => 'background: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);