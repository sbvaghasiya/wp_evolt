<?php

class EVOLT_EvoltShopBanner_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_shop_banner';
    protected $title = 'Wider Shop Banner';
    protected $icon = 'eicon-product-images';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"https:\/\/localhost\/wp_theme\/wp-content\/themes\/evolt\/elementor\/templates\/widgets\/evolt_shop_banner\/layout-image\/layout1.jpg"},"2":{"label":"Layout 2","image":"https:\/\/localhost\/wp_theme\/wp-content\/themes\/evolt\/elementor\/templates\/widgets\/evolt_shop_banner\/layout-image\/layout2.jpg"},"3":{"label":"Layout 3","image":"https:\/\/localhost\/wp_theme\/wp-content\/themes\/evolt\/elementor\/templates\/widgets\/evolt_shop_banner\/layout-image\/layout3.jpg"}}}]},{"name":"section_title","label":"Title","tab":"content","controls":[{"name":"title_text","label":"Title","type":"text","placeholder":"Enter your title","label_block":true},{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .evolt-shop-banner .item--title":"color: {{VALUE}};"}},{"name":"title_typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-shop-banner .item--title"},{"name":"title_space_bottom","label":"Title Bottom Spacer","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .evolt-shop-banner .item--title":"margin-bottom: {{SIZE}}{{UNIT}} !important;"}},{"name":"evolt_animate_title","label":"Wider Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""},{"name":"evolt_animate_delay_title","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]},{"name":"section_desc","label":"Description","tab":"content","condition":{"layout":["1","2"]},"controls":[{"name":"description_text","label":"Description","type":"textarea","placeholder":"Enter your description","rows":10,"show_label":false},{"name":"desc_color","label":"Description Color","type":"color","selectors":{"{{WRAPPER}} .evolt-shop-banner .item--description":"color: {{VALUE}};"}},{"name":"desc_typography","label":"Description Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-shop-banner .item--description"},{"name":"desc_space_bottom","label":"Description Bottom Spacer","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .evolt-shop-banner .item--description":"margin-bottom: {{SIZE}}{{UNIT}} !important;"}},{"name":"evolt_animate_desc","label":"Wider Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""},{"name":"evolt_animate_delay_des","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]},{"name":"section_button","label":"Button","tab":"content","controls":[{"name":"btn_text","label":"Button Text","type":"text","label_block":true,"condition":{"layout":["1","2"]}},{"name":"btn_link","label":"Button Link","type":"url"},{"name":"btn_style","label":"Button Type","type":"select","options":{"default":"Default","outline":"Outline","dot btn-third-dot":"Third","dot btn-primary-dot":"Primary","btn-plus":"Plus","btn-plus-circle":"Circle Plus","btn-line-arrow":"Line Arrow"},"default":"default","condition":{"layout":["1","2"]}},{"name":"btn_bg_color","label":"Button Background Color","type":"color","selectors":{"{{WRAPPER}} .evolt-shop-banner .btn":"background: {{VALUE}} !important;"},"condition":{"btn_style":["default","btn-plus"]}},{"name":"btn_bg_color_hover_plus","label":"Button Background Color Hover","type":"color","selectors":{"{{WRAPPER}} .evolt-shop-banner1 .btn.item--button-btn-plus-circle:hover::before, {{WRAPPER}}  .evolt-shop-banner2 .btn.item--button-btn-plus-circle:hover::before":"background-color: {{VALUE}} !important;"},"condition":{"btn_style":["btn-plus-circle"]}},{"name":"btn_padding","label":"Button Padding","type":"dimensions","size_units":["px"],"selectors":{"{{WRAPPER}} .evolt-shop-banner .btn":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;"},"control_type":"responsive"},{"name":"button_typography","label":"Button Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-shop-banner .btn"},{"name":"button_icon_space_right","label":"Button Icon Space Right","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-shop-banner .btn.item--button-btn-plus i":"right: {{SIZE}}{{UNIT}} !important;"},"condition":{"btn_style":["btn-plus"]}},{"name":"evolt_animate_btn","label":"Wider Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""},{"name":"evolt_animate_delay_btn","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]},{"name":"section_image","label":"Image","tab":"content","controls":[{"name":"fixed_image","label":"Top Image","type":"media","condition":{"layout":["1"]}},{"name":"animate_image","label":"Bottom Image","type":"media"},{"name":"bottom_image_max_width","label":"Bottom Image Max Width","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-shop-banner .item--image-animate":"max-width: {{SIZE}}{{UNIT}} !important;"}},{"name":"bottom_image_left_position","label":"Bottom Image Left Position","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-shop-banner .item--image-animate":"left: {{SIZE}}{{UNIT}} !important;"}},{"name":"bottom_image_right_position","label":"Bottom Image Right Position","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-shop-banner .item--image-animate":"right: {{SIZE}}{{UNIT}} !important;"}},{"name":"bottom_image_bottom_position","label":"Bottom Image Bottom Position","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-shop-banner .item--image-animate.animated":"bottom: {{SIZE}}{{UNIT}} !important;"}}]},{"name":"section_label","label":"Label","tab":"content","controls":[{"name":"title_label","label":"Label","type":"text"},{"name":"label_style","label":"Label Style","type":"select","options":{"style1":"Style 1","style2":"Style 2","style3":"Style 3"},"default":"style1","condition":{"layout":["1","2"]}},{"name":"label_position","label":"Label Position","type":"select","options":{"position-left":"Left","position-right":"Right"},"default":"position-right","condition":{"layout":["1","2"],"label_style":["style2"]}},{"name":"label_color","label":"Label Color","type":"color","selectors":{"{{WRAPPER}} .evolt-shop-banner .item--title-label":"color: {{VALUE}};"}},{"name":"label_typography","label":"Label Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-shop-banner .item--title-label","condition":{"layout":["1","2"]}},{"name":"evolt_animate_label","label":"Wider Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""},{"name":"evolt_animate_delay_label","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]},{"name":"section_extra","label":"Extra","tab":"content","controls":[{"name":"wg_style","label":"Widget Style","type":"select","options":{"style1":"Style 1","style2":"Style 2","style3":"Style 3"},"default":"style1","condition":{"layout":["1"]}},{"name":"box_color","label":"Box Color","type":"color","selectors":{"{{WRAPPER}} .evolt-shop-banner":"background-color: {{VALUE}};"}},{"name":"box_color_hover","label":"Box Color Hover","type":"color","selectors":{"{{WRAPPER}} .evolt-shop-banner:hover":"background-color: {{VALUE}};"}},{"name":"box_bg_image","label":"Box Background Image","type":"media","condition":{"layout":["1","2"]},"default":""},{"name":"box_padding","label":"Box Padding","type":"dimensions","size_units":["px"],"selectors":{"{{WRAPPER}} .evolt-shop-banner":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"control_type":"responsive","condition":{"layout":["1","2"]}},{"name":"box_border_radius","label":"Box Border Radius","type":"dimensions","size_units":["px"],"selectors":{"{{WRAPPER}} .evolt-shop-banner":"border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"condition":{"layout":["1","2"]}},{"name":"content_max_width","label":"Content Max Width","type":"slider","control_type":"responsive","size_units":["%"],"range":{"px":{"min":0,"max":100}},"selectors":{"{{WRAPPER}} .evolt-shop-banner .item--holder":"max-width: {{SIZE}}% !important;"},"description":"Unit: %"},{"name":"box_shadow_display","label":"Box Shadow Hover","type":"select","options":{"hide":"Hidden","show":"Show"},"default":"hide","condition":{"layout":["1","2"]}},{"name":"box_shadow","label":"Box Shadow","type":"box_shadow","condition":{"layout":["1","2"],"box_shadow_display":["show"]},"selectors":{"{{SELECTOR}} .evolt-shop-banner:hover":"box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};"}},{"name":"evolt_animate","label":"Wider Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""},{"name":"evolt_animate_delay","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}