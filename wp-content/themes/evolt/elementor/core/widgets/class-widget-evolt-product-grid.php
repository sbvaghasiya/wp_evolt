<?php

class EVOLT_EvoltProductGrid_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_product_grid';
    protected $title = 'Wider Products Grid';
    protected $icon = 'eicon-cart-medium';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/wp_evolt\/wp-content\/themes\/evolt\/elementor\/templates\/widgets\/evolt_product_grid\/layout-image\/layout1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/wp_evolt\/wp-content\/themes\/evolt\/elementor\/templates\/widgets\/evolt_product_grid\/layout-image\/layout2.jpg"},"3":{"label":"Layout 3","image":"http:\/\/localhost\/wp_evolt\/wp-content\/themes\/evolt\/elementor\/templates\/widgets\/evolt_product_grid\/layout-image\/layout3.jpg"},"4":{"label":"Layout 4","image":"http:\/\/localhost\/wp_evolt\/wp-content\/themes\/evolt\/elementor\/templates\/widgets\/evolt_product_grid\/layout-image\/layout4.jpg"},"5":{"label":"Layout 5","image":"http:\/\/localhost\/wp_evolt\/wp-content\/themes\/evolt\/elementor\/templates\/widgets\/evolt_product_grid\/layout-image\/layout5.jpg"}}}]},{"name":"source_section","label":"Source","tab":"content","controls":[{"name":"source","label":"Select Categories","type":"select2","multiple":true,"options":{"external|product_type":"external","grouped|product_type":"grouped","simple|product_type":"simple","variable|product_type":"variable","exclude-from-catalog|product_visibility":"exclude-from-catalog","exclude-from-search|product_visibility":"exclude-from-search","featured|product_visibility":"featured","uncategorized|product_cat":"Uncategorized","accessories|product_cat":"Accessories","clothing|product_cat":"Clothing","decor|product_cat":"Decor","hoodies|product_cat":"Hoodies","music|product_cat":"Music","tshirts|product_cat":"Tshirts","blue|pa_color":"Blue","gray|pa_color":"Gray","green|pa_color":"Green","red|pa_color":"Red","yellow|pa_color":"Yellow","large|pa_size":"L","medium|pa_size":"M","small|pa_size":"S"}},{"name":"orderby","label":"Order By","type":"select","default":"date","options":{"date":"Date","ID":"ID","author":"Author","title":"Title","rand":"Random"}},{"name":"order","label":"Sort Order","type":"select","default":"desc","options":{"desc":"Descending","asc":"Ascending"}},{"name":"limit","label":"Total items","type":"number","default":"6"},{"name":"evolt_animate","label":"Wider Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""}]},{"name":"grid_section","label":"Grid Settings","tab":"content","controls":[{"name":"show_quantity","label":"Show Quantity","type":"select","default":"no","options":{"no":"No","yes":"Yes"},"condition":{"layout":["3","4"]}},{"name":"img_size","label":"Image Size","type":"text","description":"Enter image size (Example: \"thumbnail\", \"medium\", \"large\", \"full\" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height))."},{"name":"filter","label":"Filter on Masonry","type":"select","default":"false","options":{"true":"Enable","false":"Disable"}},{"name":"filter_default_title","label":"Filter Default Title","type":"text","default":"All","condition":{"filter":"true"}},{"name":"filter_alignment","label":"Filter Alignment","type":"select","default":"center","options":{"center":"Center","left":"Left","right":"Right"},"condition":{"filter":"true"}},{"name":"filter_style","label":"Filter Style","type":"select","default":"filter-style1","options":{"filter-style1":"Style 1","filter-style2":"Style 2","filter-style3":"Style 3"}},{"name":"pagination_type","label":"Pagination Type","type":"select","default":"false","options":{"pagination":"Pagination","loadmore":"Loadmore","false":"Disable"}},{"name":"col_xs","label":"Columns XS Devices","type":"select","default":"1","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_sm","label":"Columns SM Devices","type":"select","default":"2","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_md","label":"Columns MD Devices","type":"select","default":"3","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_lg","label":"Columns LG Devices","type":"select","default":"4","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_xl","label":"Columns XL Devices","type":"select","default":"4","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"grid_masonry","label":"Grid Masonry","type":"repeater","condition":{"layout":["1"]},"controls":[{"name":"col_xs_m","label":"Columns XS Devices","type":"select","default":"1","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_sm_m","label":"Columns SM Devices","type":"select","default":"2","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_md_m","label":"Columns MD Devices","type":"select","default":"3","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_lg_m","label":"Columns LG Devices","type":"select","default":"4","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_xl_m","label":"Columns XL Devices","type":"select","default":"4","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"img_size_m","label":"Image Size","type":"text","description":"Enter image size (Example: \"thumbnail\", \"medium\", \"large\", \"full\" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height))."}]}]},{"name":"style_section_l5","label":"Style","tab":"content","condition":{"layout":"5"},"controls":[{"name":"style_l5","label":"Style","type":"select","default":"style1","options":{"style1":"Style 1","style2":"Style 2"}},{"name":"button_bg_color","label":"Button Background Color","type":"color","selectors":{"{{WRAPPER}} .btn.btn-circle-plus::before":"background-color: {{VALUE}};"},"condition":{"style_l5":"style2"}},{"name":"button_bg_color_hover","label":"Button Background Color Hover","type":"color","selectors":{"{{WRAPPER}} .btn.btn-circle-plus:hover:before":"background-color: {{VALUE}};"},"condition":{"style_l5":"style2"}},{"name":"btn_readmore","label":"Button Readmore Text","type":"text","condition":{"style_l5":"style2"}}]},{"name":"product_banner","label":"Product Banner","tab":"content","condition":{"layout":"5","style_l5":"style2"},"controls":[{"name":"sub_title","label":"Sub Title","type":"text"},{"name":"subtitle_color","label":"Sub Title Color","type":"color","selectors":{"{{WRAPPER}} .evolt-product-banner1 .item--subtitle":"color: {{VALUE}};"}},{"name":"subtitle_typography","label":"Sub Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-product-banner1 .item--subtitle"},{"name":"title","label":"Title","type":"text"},{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .evolt-product-banner1 .item--title":"color: {{VALUE}};"}},{"name":"title_typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-product-banner1 .item--title"},{"name":"btn_text","label":"Button Text","type":"text"},{"name":"btn_link","label":"Button Link","type":"url"},{"name":"sbutton_bg_color","label":"Button Background Color","type":"color","selectors":{"{{WRAPPER}} .evolt-product-banner1 .item--button .btn":"background-color: {{VALUE}};"}},{"name":"button_typography","label":"Button Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-product-banner1 .item--button .btn"},{"name":"image","label":"Image","type":"media"},{"name":"image_max_width","label":"Image Max Width","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-product-banner1 .item--image":"max-width: {{SIZE}}{{UNIT}} !important;"}},{"name":"image_left_position","label":"Image Left Position","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-product-banner1 .item--image":"left: {{SIZE}}{{UNIT}} !important;"}},{"name":"image_right_position","label":"Image Right Position","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-product-banner1 .item--image":"right: {{SIZE}}{{UNIT}} !important;"}},{"name":"image_bottom_position","label":"Image Bottom Position","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .evolt-product-banner1 .item--image.animated":"bottom: {{SIZE}}{{UNIT}} !important;"}},{"name":"box_padding","label":"Box Padding","type":"dimensions","size_units":["px"],"selectors":{"{{WRAPPER}} .evolt-product-banner1 .item--inner":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"control_type":"responsive"}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'imagesloaded','isotope','evolt-post-masonry-widget-js','evolt-post-grid-widget-js' );
}