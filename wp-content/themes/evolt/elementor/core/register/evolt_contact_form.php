<?php

// Register Contact Form 7 Widget
if(class_exists('WPCF7')) {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->ID] = $cform->post_title;
        }
    } else {
        $contact_forms[esc_html__('No contact forms found', 'evolt')] = 0;
    }


    evolt_add_custom_widget(
        array(
            'name' => 'evolt_contact_form',
            'title' => esc_html__('Wider Contact Form', 'evolt'),
            'icon' => 'eicon-form-horizontal',
            'categories' => array(Wider_Theme_Core::EVOLT_CATEGORY_NAME),
            'scripts' => array(
                'jquery-ui-slider',
            ),
            'params' => array(
                'sections' => array(
                    array(
                        'name' => 'source_section',
                        'label' => esc_html__('Source Settings', 'evolt'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                        'controls' => array(
                            array(
                                'name' => 'form_id',
                                'label' => esc_html__('Select Form', 'evolt'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => $contact_forms,
                            ),
                            array(
                                'name' => 'sub_title',
                                'label' => esc_html__('Sub Title', 'evolt' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'condition' => [
                                    'style' => ['n'],
                                ],
                            ),
                            array(
                                'name' => 'title',
                                'label' => esc_html__('Title', 'evolt' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                                'condition' => [
                                    'style' => ['n'],
                                ],
                            ),
                            array(
                                'name' => 'description',
                                'label' => esc_html__('Description', 'evolt' ),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'rows' => 10,
                                'show_label' => false,
                                'condition' => [
                                    'style' => ['n'],
                                ],
                            ),
                            array(
                                'name' => 'style',
                                'label' => esc_html__('Style', 'evolt' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    'style1' => 'Style 1',
                                    'style2' => 'Style 2',
                                ],
                                'default' => 'style1',
                            ),
                            array(
                                'name' => 'title_color',
                                'label' => esc_html__('Title Color', 'evolt' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .evolt-contact-form .evolt-contact-meta h3' => 'color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => ['n'],
                                ],
                            ),
                            array(
                                'name' => 'title_typography',
                                'label' => esc_html__('Title Typography', 'evolt' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .evolt-contact-form .evolt-contact-meta h3',
                                'condition' => [
                                    'style' => ['n'],
                                ],
                            ),
                            array(
                                'name' => 'desc_color',
                                'label' => esc_html__('Description Color', 'evolt' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .evolt-contact-form .evolt-contact-meta p' => 'color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => ['n'],
                                ],
                            ),
                            array(
                                'name' => 'desc_typography',
                                'label' => esc_html__('Description Typography', 'evolt' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .evolt-contact-form .evolt-contact-meta p',
                                'condition' => [
                                    'style' => ['n'],
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
                ),
            ),
        ),
        get_template_directory() . '/elementor/core/widgets/'
    );
}