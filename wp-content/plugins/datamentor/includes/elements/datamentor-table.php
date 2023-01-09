<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Frontend;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Datamentor_Data_Table_Widget extends Widget_Base {

    public function get_name() {
        return 'datamentor_table';
    }

    public function get_title() {
        return __('DM Data Table', DMELE_DOMAIN);
    }

    public function get_icon() {
        return 'fas fa-table';
    }

    //Function for include element into the category.
    public function get_categories() {
        return ['datamentor'];
    }

    /*
     * Adding the controls fields for the Blog Layout
     */

    protected function register_controls() {

        $this->start_controls_section(
                'section_layout', array(
            'label' => __('Header', DMELE_DOMAIN),
                )
        );
        $repeater = new \Elementor\Repeater();
        
            $repeater->add_control(
                'dmele_data_table_header_col', [
                    'label' => __('Column Name', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Table Header', DMELE_DOMAIN),
                    'label_block' => false,
                ]
            );
            $repeater->add_control(
                'dmele_data_table_header_col_span', [
                    'label' => __('Column Span', DMELE_DOMAIN),
                    'default' => '',
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                ]
            );
            $repeater->add_control(
                'dmele_data_table_header_col_icon_enabled', [
                    'label' => __('Enable Header Icon', DMELE_DOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', DMELE_DOMAIN),
                    'label_off' => __('No', DMELE_DOMAIN),
                    'default' => 'false',
                    'return_value' => 'true',
                ]
            );
            $repeater->add_control(
                'dmele_data_table_header_icon_type', [
                    'label' => __('Header Icon Type', DMELE_DOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'none' => [
                            'title' => __('None', DMELE_DOMAIN),
                            'icon' => 'fa fa-ban',
                        ],
                        'icon' => [
                            'title' => __('Icon', DMELE_DOMAIN),
                            'icon' => 'fa fa-star',
                        ],
                        'image' => [
                            'title' => __('Image', DMELE_DOMAIN),
                            'icon' => 'eicon-image',
                        ],
                    ],
                    'default' => 'icon',
                    'condition' => [
                        'dmele_data_table_header_col_icon_enabled' => 'true'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_header_col_icon_new', [
                    'label' => __('Icon', DMELE_DOMAIN),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'dmele_data_table_header_col_icon',
                    'default' => '',
                    'condition' => [
                        'dmele_data_table_header_col_icon_enabled' => 'true',
                        'dmele_data_table_header_icon_type' => 'icon'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_header_col_img', [
                    'label' => __('Image', DMELE_DOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'dmele_data_table_header_icon_type' => 'image'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_header_col_img_size', [
                    'label' => __('Image Size(px)', DMELE_DOMAIN),
                    'default' => '25',
                    'type' => Controls_Manager::NUMBER,
                    'label_block' => false,
                    'condition' => [
                        'dmele_data_table_header_icon_type' => 'image'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_header_col_svg_img_size', [
                    'label' => __('SVG Image Size(px)', DMELE_DOMAIN),
                    'default' => '15',
                    'type' => Controls_Manager::NUMBER,
                    'label_block' => false,
                    'condition' => [
                        'dmele_data_table_header_icon_type' => 'icon',
                        'dmele_data_table_header_col_icon_new' => '',
                    ]
                ]
            );

            $repeater->add_control(
                'dmele_data_table_header_css_class', [
                    'label' => __('CSS Class', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                ]
                );
            $repeater->add_control(
                'dmele_data_table_header_css_id', [
                    'label' => __('CSS ID', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                ]
            );

            $this->add_control(
                'dmele_data_table_header_cols_data', [
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'separator' => 'before',
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        ['dmele_data_table_header_col' => __('Table Header', DMELE_DOMAIN)],
                        ['dmele_data_table_header_col' => __('Table Header', DMELE_DOMAIN)],
                        ['dmele_data_table_header_col' => __('Table Header', DMELE_DOMAIN)],
                        ['dmele_data_table_header_col' => __('Table Header', DMELE_DOMAIN)],
                    ],
                    'title_field' => '{{dmele_data_table_header_col}}', 
                ]       
            );

        $this->end_controls_section();

        /**
         * Data Table Content
         */
        $this->start_controls_section(
            'dmele_section_data_table_cotnent', [
                'label' => __('Content', DMELE_DOMAIN)
            ]
        );
        $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'dmele_data_table_content_row_type', [
                    'label' => __('Row Type', DMELE_DOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'row',
                    'label_block' => false,
                    'options' => [
                        'row' => __('Row', DMELE_DOMAIN),
                        'col' => __('Column', DMELE_DOMAIN),
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_content_row_colspan', [
                    'label' => __('Col Span', DMELE_DOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('Default: 1 (optional).'),
                    'default' => 1,
                    'min' => 1,
                    'label_block' => true,
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_content_row_rowspan', [
                    'label' => __('Row Span', DMELE_DOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('Default: 1 (optional).'),
                    'default' => 1,
                    'min' => 1,
                    'label_block' => true,
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_content_type', [
                    'label' => __('Content Type', DMELE_DOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'textarea' => [
                            'title' => __('Textarea', DMELE_DOMAIN),
                            'icon' => 'fa fa-text-width',
                        ],
                        'editor' => [
                            'title' => __('Editor', DMELE_DOMAIN),
                            'icon' => 'eicon-edit',
                        ],
                        'template' => [
                            'title' => __('Templates', DMELE_DOMAIN),
                            'icon' => 'fa fa-file',
                        ],
                        'button' => [
                            'title' => __('Button', DMELE_DOMAIN),
                            'icon' => 'eicon-button',
                        ]
                    ],
                    'default' => 'textarea',
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col'
                    ]
                ]
            );

            $repeater->add_control(
                'dmele_data_table_custom_button_text', [
                    'label' => __('Button Text', DMELE_DOMAIN),
                    'default' => __('Click here', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'condition' => [
                        'dmele_data_table_content_type' => 'button',
                    ],
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_link', [
                    'label' => __('Button Link', DMELE_DOMAIN),
                    'type' => Controls_Manager::URL,
                    'label_block' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => '',
                    ],
                    'show_external' => true,
                    'separator' => 'before',
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ],
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_align', [
                    'label' => __('Button Alignment', DMELE_DOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'elementor'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'elementor'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'elementor'),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __('Justified', 'elementor'),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'prefix_class' => 'elementor%s-align-',
                    'default' => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table {{CURRENT_ITEM}} .dmele-content-button' => 'text-align: {{VALUE}};'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ],
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_color', [
                    'label' => __('Button Text Color', DMELE_DOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'color: {{VALUE}};'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_bg_color', [
                    'label' => __('Button Background Color', DMELE_DOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#61ce70',
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'background-color: {{VALUE}};'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );

            $repeater->add_control(
                'dmele_data_table_custom_button_border', [
                    'label' => __('Button Border', DMELE_DOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'default' => 'none',
                    'options' => [
                        'none' => __('None', DMELE_DOMAIN),
                        'solid' => __('Solid', DMELE_DOMAIN),
                        'double' => __('Double', DMELE_DOMAIN),
                        'dotted' => __('Dotted', DMELE_DOMAIN),
                        'dashed' => __('Dashed', DMELE_DOMAIN),
                        'groove' => __('Groove', DMELE_DOMAIN),
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_border_radius', [
                    'label' => __('Button Border Radius', DMELE_DOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'top' => 3,
                        'right' => 3,
                        'bottom' => 3,
                        'left' => 3,
                        'isLinked' => true,
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );

            $repeater->add_control(
                'dmele_data_table_custom_button_border_width', [
                    'label' => __('Button Border Width', DMELE_DOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 50,
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'border-width: {{VALUE}}px;'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_border_color', [
                    'label' => __('Button Border Color', DMELE_DOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_hover_color', [
                    'label' => __('Button Text Hover Color', DMELE_DOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}};'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_hover_bg_color', [
                    'label' => __('Button Hover Background Color', DMELE_DOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a:hover' => 'background-color: {{VALUE}};'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_hover_border_color', [
                    'label' => __('Button Hover Border Color', DMELE_DOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a:hover' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_text_padding', [
                    'label' => __('Button Padding', DMELE_DOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em'],
                    'default' => [
                        'top' => 12,
                        'right' => 24,
                        'bottom' => 12,
                        'left' => 24,
                        'isLinked' => true,
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_icon_type', [
                    'label' => __('Button Icon Type', DMELE_DOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'none' => [
                            'title' => __('None', DMELE_DOMAIN),
                            'icon' => 'fa fa-ban',
                        ],
                        'icon' => [
                            'title' => __('Icon', DMELE_DOMAIN),
                            'icon' => 'fa fa-star',
                        ],
                        'image' => [
                            'title' => __('Image', DMELE_DOMAIN),
                            'icon' => 'eicon-image',
                        ],
                    ],
                    'default' => 'icon',
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_icon_value', [
                    'label' => __('Button Icon', DMELE_DOMAIN),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'dmele_data_table_custom_button_icon_compatibility',
                    'default' => '',
                    'condition' => [
                        'dmele_data_table_custom_button_icon_type' => 'icon',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );

            $repeater->add_control(
                'dmele_data_table_custom_button_image_value', [
                    'label' => __('Button Image', DMELE_DOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'dmele_data_table_custom_button_icon_type' => 'image',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_image_size', [
                    'label' => __('Button Image Size(px)', DMELE_DOMAIN),
                    'default' => '25',
                    'type' => Controls_Manager::NUMBER,
                    'label_block' => false,
                    'condition' => [
                        'dmele_data_table_custom_button_icon_type' => 'image',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_icon_align', [
                    'label' => __('Button Icon Position', DMELE_DOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left' => __('Before', DMELE_DOMAIN),
                        'right' => __('After', DMELE_DOMAIN),
                    ],
                    'condition' => [
                        'dmele_data_table_custom_button_icon_type' => 'icon',
                            'dmele_data_table_custom_button_icon_value' => '',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );

            $repeater->add_control(
                'dmele_data_table_custom_button_icon_indent', [
                    'label' => __('Button Icon Spacing', DMELE_DOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 50,
                    'selectors' => [
                        '{{WRAPPER}} .dmele-content-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}px;',
                        '{{WRAPPER}} .dmele-content-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}px;',
                    ],
                    'condition' => [
                        'dmele_data_table_custom_button_icon_type' => 'icon',
                        'dmele_data_table_custom_button_icon_value' => '',
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_text_decoration', [
                    'label' => __('Button Text Decoration', DMELE_DOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => __('Default', DMELE_DOMAIN),
                        'underline' => __('Underline', DMELE_DOMAIN),
                        'overline' => __('Overline', DMELE_DOMAIN),
                        'line-through' => __('Line Through', DMELE_DOMAIN),
                        'none' => __('None', DMELE_DOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'text-decoration: {{VALUE}};',
                    ],
                    'condition' => [
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_text_transform', [
                    'label' => __('Button Text Transform', DMELE_DOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => __('Default', DMELE_DOMAIN),
                        'uppercase' => __('Uppercase', DMELE_DOMAIN),
                        'lowercase' => __('Lowercase', DMELE_DOMAIN),
                        'capitalize' => __('Capatilize', DMELE_DOMAIN),
                        'none' => __('Normal', DMELE_DOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'text-transform: {{VALUE}};',
                    ],
                    'condition' => [
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_font_weight', [
                    'label' => __('Button Font Weight', DMELE_DOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => '500',
                    'options' => [
                        '' => __('Default', DMELE_DOMAIN),
                        '100' => __('100', DMELE_DOMAIN),
                        '200' => __('200', DMELE_DOMAIN),
                        '300' => __('300', DMELE_DOMAIN),
                        '400' => __('400', DMELE_DOMAIN),
                        '500' => __('500', DMELE_DOMAIN),
                        '600' => __('600', DMELE_DOMAIN),
                        '700' => __('700', DMELE_DOMAIN),
                        '800' => __('800', DMELE_DOMAIN),
                        '900' => __('900', DMELE_DOMAIN),
                        'normal' => __('Normal', DMELE_DOMAIN),
                        'bold' => __('Bold', DMELE_DOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .dmele-data-table-wrap {{CURRENT_ITEM}} a' => 'font-weight: {{VALUE}};',
                    ],
                    'condition' => [
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_custom_button_id', [
                    'label' => __('Button Id', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => '',
                    'title' => __('Add your custom id WITHOUT the Pound key. e.g: my-button-id', DMELE_DOMAIN),
                    'label_block' => false,
                    'description' => __('Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', DMELE_DOMAIN),
                    'separator' => 'before',
                    'condition' => [
                        'dmele_data_table_content_type' => 'button'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_primary_templates_for_tables', [
                    'label' => __('Choose Template', DMELE_DOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => dmele_get_page_templates(),
                    'condition' => [
                        'dmele_data_table_content_type' => 'template',
                    ],
                ]
            );
            $repeater->add_control(
                'dmele_data_table_content_row_title', [
                    'label' => __('Cell Text', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default' => __('Content', DMELE_DOMAIN),
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'textarea'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_content_row_content', [
                    'label' => __('Cell Text', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default' => __('Content', DMELE_DOMAIN),
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'editor'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_content_row_title_link', [
                    'label' => __('Link', DMELE_DOMAIN),
                    'type' => Controls_Manager::URL,
                    'label_block' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => '',
                    ],
                    'show_external' => true,
                    'separator' => 'before',
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col',
                        'dmele_data_table_content_type' => 'textarea'
                    ],
                ]
            );
            $repeater->add_control(
                'dmele_data_table_content_row_css_class', [
                    'label' => __('CSS Class', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col'
                    ]
                ]
            );
            $repeater->add_control(
                'dmele_data_table_content_row_css_id', [
                    'label' => __('CSS ID', DMELE_DOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'condition' => [
                        'dmele_data_table_content_row_type' => 'col'
                    ]
                ]
                
            );
            
            $this->add_control(
                'dmele_data_table_content_rows', [
                    'type' => \Elementor\Controls_Manager::REPEATER ,
                    'seperator' => 'before',
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        ['dmele_data_table_content_row_type' => 'row'],
                        ['dmele_data_table_content_row_type' => 'col'],
                        ['dmele_data_table_content_row_type' => 'col'],
                        ['dmele_data_table_content_row_type' => 'col'],
                        ['dmele_data_table_content_row_type' => 'col'],
                    ],
                    'title_field' => '<span style="text-transform:capitalize; font-weight:600;">{{dmele_data_table_content_row_type}}</span>::{{dmele_data_table_content_row_title || dmele_data_table_content_row_content || dmele_data_table_custom_button_text}}',
                ]
            );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Data Table Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'dmele_section_data_table_style_settings', [
                'label' => __('General Style', DMELE_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'table_width', [
                'label' => __('Width', DMELE_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'table_alignment', [
                'label' => __('Alignment', DMELE_DOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => __('Left', DMELE_DOMAIN),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', DMELE_DOMAIN),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', DMELE_DOMAIN),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'dmele-table-align-',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Data Table Header Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'dmele_section_data_table_title_style_settings', [
                'label' => __('Header Style', DMELE_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );


        $this->add_control(
            'dmele_section_data_table_header_radius', [
                'label' => __('Header Border Radius', DMELE_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table thead tr th:first-child' => 'border-radius: {{SIZE}}px 0px 0px 0px;',
                    '{{WRAPPER}} .dmele-data-table thead tr th:last-child' => 'border-radius: 0px {{SIZE}}px 0px 0px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'dmele_data_table_each_header_padding', [
                'label' => __('Padding', DMELE_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table .table-header th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .dmele-data-table tbody tr td .th-mobile-screen' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('dmele_data_table_header_title_clrbg');

        $this->start_controls_tab('dmele_data_table_header_title_normal', ['label' => __('Normal', DMELE_DOMAIN)]);

        $this->add_control(
            'dmele_data_table_header_title_color', [
                'label' => __('Color', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table thead tr th' => 'color: {{VALUE}};',
                    '{{WRAPPER}} table.dataTable thead .sorting:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} table.dataTable thead .sorting_asc:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} table.dataTable thead .sorting_desc:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmele_data_table_header_title_bg_color', [
                'label' => __('Background Color', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#4a4893',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table thead tr th' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'dmele_data_table_header_border',
                'label' => __('Border', DMELE_DOMAIN),
                'selector' => '{{WRAPPER}} .dmele-data-table thead tr th'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('dmele_data_table_header_title_hover', ['label' => __('Hover', DMELE_DOMAIN)]);

        $this->add_control(
            'dmele_data_table_header_title_hover_color', [
                'label' => __('Color', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table thead tr th:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} table.dataTable thead .sorting:after:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} table.dataTable thead .sorting_asc:after:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} table.dataTable thead .sorting_desc:after:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmele_data_table_header_title_hover_bg_color', [
                'label' => __('Background Color', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table thead tr th:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'dmele_data_table_header_hover_border',
                'label' => __('Border', DMELE_DOMAIN),
                'selector' => '{{WRAPPER}} .dmele-data-table thead tr th:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'dmele_data_table_header_title_typography',
                'selector' => '{{WRAPPER}} .dmele-data-table thead > tr th',
            ]
        );

        $this->add_responsive_control(
            'dmele_data_table_header_title_alignment', [
                'label' => __('Title Alignment', DMELE_DOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'left' => [
                        'title' => __('Left', DMELE_DOMAIN),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', DMELE_DOMAIN),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', DMELE_DOMAIN),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'prefix_class' => 'dmele-dt-th-align-',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Data Table Content Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'dmele_section_data_table_content_style_settings', [
                'label' => __('Content Style', DMELE_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs('dmele_data_table_content_row_cell_styles');

        $this->start_controls_tab('dmele_data_table_odd_cell_style', ['label' => __('Normal', DMELE_DOMAIN)]);

        $this->add_control(
            'dmele_data_table_content_odd_style_heading', [
                'label' => __('ODD Cell', DMELE_DOMAIN),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dmele_data_table_content_color_odd', [
                'label' => __('Color ( Odd Row )', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#6d7882',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody > tr:nth-child(2n) td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmele_data_table_content_bg_odd', [
                'label' => __('Background ( Odd Row )', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2f2f2',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody > tr:nth-child(2n) td' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmele_data_table_content_even_style_heading', [
                'label' => __('Even Cell', DMELE_DOMAIN),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'dmele_data_table_content_even_color', [
                'label' => __('Color ( Even Row )', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#6d7882',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody > tr:nth-child(2n+1) td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmele_data_table_content_bg_even_color', [
                'label' => __('Background Color (Even Row)', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody > tr:nth-child(2n+1) td' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'dmele_data_table_cell_border',
                'label' => __('Border', DMELE_DOMAIN),
                'selector' => '{{WRAPPER}} .dmele-data-table tbody tr td',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'dmele_data_table_each_cell_padding', [
                'label' => __('Padding', DMELE_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('dmele_data_table_odd_cell_hover_style', ['label' => __('Hover', DMELE_DOMAIN)]);

        $this->add_control(
            'dmele_data_table_content_hover_color_odd', [
                'label' => __('Color ( Odd Row )', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody > tr:nth-child(2n) td:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmele_data_table_content_hover_bg_odd', [
                'label' => __('Background ( Odd Row )', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody > tr:nth-child(2n) td:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmele_data_table_content_even_hover_style_heading', [
                'label' => __('Even Cell', DMELE_DOMAIN),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dmele_data_table_content_hover_color_even', [
                'label' => __('Color ( Even Row )', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#6d7882',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody > tr:nth-child(2n+1) td:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dmele_data_table_content_bg_even_hover_color', [
                'label' => __('Background Color (Even Row)', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody > tr:nth-child(2n+1) td:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'dmele_data_table_content_typography',
                'selector' => '{{WRAPPER}} .dmele-data-table tbody tr td'
            ]
        );

        $this->add_control(
            'dmele_data_table_content_link_typo', [
                'label' => __('Link Color', DMELE_DOMAIN),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        /* Table Content Link */
        $this->start_controls_tabs('dmele_data_table_link_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'dmele_data_table_link_normal', [
                'label' => __('Normal', DMELE_DOMAIN)
            ]
        );

        $this->add_control(
            'dmele_data_table_link_normal_text_color', [
                'label' => __('Text Color', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#c15959',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table-wrap table td a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'dmele_data_table_link_hover', [
                'label' => __('Hover', DMELE_DOMAIN)
            ]
        );

        $this->add_control(
            'dmele_data_table_link_hover_text_color', [
                'label' => __('Text Color', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#6d7882',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table-wrap table td a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'dmele_data_table_content_alignment', [
                'label' => __('Content Alignment', DMELE_DOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'left' => [
                        'title' => __('Left', DMELE_DOMAIN),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', DMELE_DOMAIN),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', DMELE_DOMAIN),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'prefix_class' => 'dmele-dt-td-align-',
            ]
        );
        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Responsive Style (Data Table Content Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'dmele_section_data_table_responsive_style_settings', [
                'label' => __('Responsive Options', DMELE_DOMAIN),
                'devices' => ['tablet', 'mobile'],
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'dmele_enable_responsive_header_styles', [
                'label' => __('Enable Responsive Table', DMELE_DOMAIN),
                'description' => __('If enabled, table header will be automatically responsive for mobile.', DMELE_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', DMELE_DOMAIN),
                'label_off' => __('No', DMELE_DOMAIN),
                'return_value' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'mobile_table_header_width', [
                'label' => __('Width', DMELE_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table .th-mobile-screen' => 'flex-basis: {{SIZE}}px;',
                ],
                'condition' => [
                    'dmele_enable_responsive_header_styles' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'dmele_data_table_responsive_header_color', [
                'label' => __('Color', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody .th-mobile-screen' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'dmele_enable_responsive_header_styles' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'dmele_data_table_responsive_header_bg_color', [
                'label' => __('Background Color', DMELE_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dmele-data-table tbody .th-mobile-screen' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'dmele_enable_responsive_header_styles' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'dmele_data_table_responsive_header_typography',
                'selector' => '{{WRAPPER}} .dmele-data-table .th-mobile-screen',
                'condition' => [
                    'dmele_enable_responsive_header_styles' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'dmele_data_table_responsive_header_border',
                'label' => __('Border', DMELE_DOMAIN),
                'selector' => '{{WRAPPER}} tbody td .th-mobile-screen',
                'condition' => [
                    'dmele_enable_responsive_header_styles' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Render Datamentor widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();
        // print_r($settings);
        $table_tr = [];
        $table_td = [];

        // Storing Data table content values
        foreach ($settings['dmele_data_table_content_rows'] as $content_row) {

            $row_id = uniqid();
            if ($content_row['dmele_data_table_content_row_type'] == 'row') {
                $table_tr[] = [
                    'id' => $row_id,
                    'type' => $content_row['dmele_data_table_content_row_type'],
                ];
            }
            if ($content_row['dmele_data_table_content_row_type'] == 'col') {
                $target = $content_row['dmele_data_table_content_row_title_link']['is_external'] ? 'target="_blank"' : '';
                $nofollow = $content_row['dmele_data_table_content_row_title_link']['nofollow'] ? 'rel="nofollow"' : '';

                $table_tr_keys = array_keys($table_tr);
                $last_key = end($table_tr_keys);

                $tbody_content = ($content_row['dmele_data_table_content_type'] == 'editor') ? $content_row['dmele_data_table_content_row_content'] : $content_row['dmele_data_table_content_row_title'];

                if ($content_row['dmele_data_table_content_type'] == 'button') {
                    $tbody_content = $content_row['dmele_data_table_custom_button_text'];
                }

                $table_td[] = [
                    '_id' => $content_row['_id'],
                    'row_id' => isset($table_tr[$last_key]['id']),
                    'type' => $content_row['dmele_data_table_content_row_type'],
                    'content_type' => $content_row['dmele_data_table_content_type'],
                    'template' => $content_row['dmele_primary_templates_for_tables'],
                    'button_text' => $content_row['dmele_data_table_custom_button_text'],
                    'button_link' => $content_row['dmele_data_table_custom_button_link']['url'],
                    'button_icon_type' => $content_row['dmele_data_table_custom_button_icon_type'],
                    'button_icon' => $content_row['dmele_data_table_custom_button_icon_value']['value'],
                    'button_image' => $content_row['dmele_data_table_custom_button_image_value'],
                    'button_size' => $content_row['dmele_data_table_custom_button_image_size'],
                    'button_align' => $content_row['dmele_data_table_custom_button_icon_align'],
                    'button_id' => $content_row['dmele_data_table_custom_button_id'],
                    'button_alignment' => $content_row['dmele_data_table_custom_button_align'],
                    'button_border' => $content_row['dmele_data_table_custom_button_border'],
                    'title' => $tbody_content,
                    'link_url' => $content_row['dmele_data_table_content_row_title_link']['url'],
                    'link_target' => $target,
                    'nofollow' => $nofollow,
                    'colspan' => $content_row['dmele_data_table_content_row_colspan'],
                    'rowspan' => $content_row['dmele_data_table_content_row_rowspan'],
                    'tr_class' => $content_row['dmele_data_table_content_row_css_class'],
                    'tr_id' => $content_row['dmele_data_table_content_row_css_id']
                ];

                // print_r($table_td);
            }
        }
        $table_th_count = count($settings['dmele_data_table_header_cols_data']);
        $this->add_render_attribute('dmele_data_table_wrap', [
            'class' => 'dmele-data-table-wrap',
            'data-table_id' => esc_attr($this->get_id()),
            'data-custom_responsive' => $settings['dmele_enable_responsive_header_styles'] ? 'true' : 'false'
        ]);
        if (isset($settings['dmele_section_data_table_enabled']) && $settings['dmele_section_data_table_enabled']) {
            $this->add_render_attribute('dmele_data_table_wrap', 'data-table_enabled', 'true');
        }
        $this->add_render_attribute('dmele_data_table', [
            'class' => ['tablesorter dmele-data-table', esc_attr($settings['table_alignment'])],
            'id' => 'dmele-data-table-' . esc_attr($this->get_id())
        ]);

        $this->add_render_attribute('td_content', [
            'class' => 'td-content'
        ]);

        if ('yes' == $settings['dmele_enable_responsive_header_styles']) {
            $this->add_render_attribute('dmele_data_table_wrap', 'class', 'custom-responsive-option-enable');
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('dmele_data_table_wrap'); ?>>
            <table <?php echo $this->get_render_attribute_string('dmele_data_table'); ?>>
                <thead>
                    <tr class="table-header">
                        <?php
                        $i = 0;
                        foreach ($settings['dmele_data_table_header_cols_data'] as $header_title) :
                            // print_r($header_title);
                            $this->add_render_attribute('th_class' . $i, [
                                'class' => [$header_title['dmele_data_table_header_css_class']],
                                'id' => $header_title['dmele_data_table_header_css_id'],
                                'colspan' => $header_title['dmele_data_table_header_col_span']
                            ]);
                            ?>
                            <th <?php echo $this->get_render_attribute_string('th_class' . $i); ?>>
                                <span class="elementor-header-section">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-icon">
                                            <?php if ($header_title['dmele_data_table_header_col_icon_enabled'] == 'true' && $header_title['dmele_data_table_header_icon_type'] == 'icon') : ?>
                                                <?php if (( empty($header_title['dmele_data_table_header_col_icon']) || isset($header_title['__fa4_migrated']['dmele_data_table_header_col_icon_new']) ) && empty($header_title['dmele_data_table_header_col_icon_new']['value']['url'])) { ?>
                                                    <i class="<?php echo $header_title['dmele_data_table_header_col_icon_new']['value'] ?> dmele-data-header-icon"></i>
                                                <?php } else if ($header_title['dmele_data_table_header_col_icon_new']['value']['url'] != "") { ?>
                                                    <img width="<?php echo $header_title["dmele_data_table_header_col_svg_img_size"] ?>" class="data-header-svg" src="<?php echo $header_title['dmele_data_table_header_col_icon_new']['value']['url']; ?>" />
                                                <?php } else { ?>
                                                    <i class="<?php echo $header_title['dmele_data_table_header_col_icon'] ?> dmele-data-header-icon"></i>
                                                <?php } ?>
                                            <?php endif; ?>
                                            <?php
                                            if ($header_title['dmele_data_table_header_col_icon_enabled'] == 'true' && $header_title['dmele_data_table_header_icon_type'] == 'image') :
                                                $this->add_render_attribute('data_table_th_img' . $i, [
                                                    'src' => esc_url($header_title['dmele_data_table_header_col_img']['url']),
                                                    'class' => 'dmele-data-table-th-img',
                                                    'style' => "width:{$header_title['dmele_data_table_header_col_img_size']}px;",
                                                    'alt' => esc_attr(get_post_meta($header_title['dmele_data_table_header_col_img']['id'], '_wp_attachment_image_alt', true))
                                                ]);
                                                ?>

                                                <img <?php echo $this->get_render_attribute_string('data_table_th_img' . $i); ?>>
                                            <?php endif; ?>
                                        </span>
                                        <span class="elementor-button-text elementor-inline-editing">
                                            <?php echo __($header_title['dmele_data_table_header_col'], DMELE_DOMAIN); ?>
                                        </span>
                                    </span>
                                </span>
                            </th>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($table_tr); $i++) : ?>
                        <tr>
                            <?php
                            for ($j = 0; $j < count($table_td); $j++) {
                                if ($table_tr[$i]['id'] == $table_td[$j]['row_id']) {

                                    $this->add_render_attribute('table_inside_td' . $i . $j, [
                                        'colspan' => $table_td[$j]['colspan'] > 1 ? $table_td[$j]['colspan'] : '',
                                        'rowspan' => $table_td[$j]['rowspan'] > 1 ? $table_td[$j]['rowspan'] : '',
                                        'class' => $table_td[$j]['tr_class'],
                                        'id' => $table_td[$j]['tr_id']
                                            ]
                                    );
                                    ?>
                                    <?php if ($table_td[$j]['content_type'] == 'textarea' && !empty($table_td[$j]['link_url'])) : ?>
                                        <td <?php echo $this->get_render_attribute_string('table_inside_td' . $i . $j); ?>>
                                            <div class="td-content-wrapper">
                                                <a href="<?php echo esc_url($table_td[$j]['link_url']); ?>" <?php echo $table_td[$j]['link_target'] ?> <?php echo $table_td[$j]['nofollow'] ?>><?php echo wp_kses_post($table_td[$j]['title']); ?></a>
                                            </div>
                                        </td>

                                    <?php elseif ($table_td[$j]['content_type'] == 'template' && !empty($table_td[$j]['template'])) : ?>
                                        <td <?php echo $this->get_render_attribute_string('table_inside_td' . $i . $j); ?>>
                                            <div class="td-content-wrapper">
                                                <div <?php echo $this->get_render_attribute_string('td_content'); ?>>
                                                    <?php
                                                    $dmele_frontend = new Frontend;
                                                    echo $dmele_frontend->get_builder_content(intval($table_td[$j]['template']), true);
                                                    ?>
                                                </div>
                                            </div>
                                        </td>

                                    <?php elseif ($table_td[$j]['content_type'] == 'button' && !empty($table_td[$j]['button_text'])) : ?>
                                        <td <?php echo $this->get_render_attribute_string('table_inside_td' . $i . $j); ?>>
                                            <div class="td-content-wrapper elementor-button-wrapper elementor-repeater-item-<?php echo $table_td[$j]['_id']; ?>">
                                                <div class="td-content-wrapper dmele-content-button td-content-button <?php echo $table_td[$j]['button_alignment'] ?> <?php echo $table_td[$j]['button_border'] ?>">
                                                    <a id="<?php echo $table_td[$j]['button_id']; ?>" class="elementor-button-link elementor-button" href="<?php echo esc_url($table_td[$j]['button_link']); ?>">
                                                        <span class="elementor-button-content-wrapper">
                                                            <span class="elementor-button-icon elementor-align-icon-<?php echo $table_td[$j]['button_align'] ?>">
                                                                <?php if (!empty($table_td[$j]['button_icon']) && $table_td[$j]['button_icon_type'] == "icon" && empty($table_td[$j]['button_icon']['url'])) { ?>
                                                                    <i class="<?php echo $table_td[$j]['button_icon'] ?> button-icon"></i>
                                                                <?php } ?>
                                                                <?php if (!empty($table_td[$j]['button_icon']['url']) && $table_td[$j]['button_icon_type'] == "icon") { ?>
                                                                    <img width="15" class="elementor-svg-button elementor-button-img" src="<?php echo $table_td[$j]['button_icon']['url']; ?>" />
                                                                <?php } ?>
                                                                <?php if (!empty($table_td[$j]['button_image']['url']) && $table_td[$j]['button_icon_type'] == "image") { ?>
                                                                    <img class="elementor-button-img" width="<?php echo $table_td[$j]['button_size'] ?>" src="<?php echo $table_td[$j]['button_image']['url']; ?>" />
                                                                <?php } ?>
                                                            </span>
                                                            <span class="elementor-button-text elementor-inline-editing">
                                                                <?php echo wp_kses_post($table_td[$j]['button_text']); ?>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td <?php echo $this->get_render_attribute_string('table_inside_td' . $i . $j); ?>>
                                            <div class="td-content-wrapper"><div <?php echo $this->get_render_attribute_string('td_content'); ?>><?php echo $table_td[$j]['title']; ?></div></div>
                                        </td>
                                    <?php endif; ?>
                                    <?php
                                }
                            }
                            ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new Datamentor_Data_Table_Widget());
