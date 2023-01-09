<?php

class EVOLT_eVoltHistoryCarousel_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_history_carousel';
    protected $title = 'History Carousel';
    protected $icon = 'eicon-flip-box';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"content_list","label":"Content","type":"repeater","controls":[{"name":"year","label":"Year","type":"text"},{"name":"title","label":"Title","type":"text","label_block":true},{"name":"description","label":"Description","type":"textarea","rows":10,"show_label":false}],"title_field":"{{{ title }}}"}]},{"name":"section_carousel_settings","label":"Carousel","tab":"content","controls":[{"name":"slidestoshow","label":"Slides To Show","type":"text","label_block":true}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-slick','evolt-post-carousel-widget-js' );
}