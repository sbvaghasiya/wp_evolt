<?php

class EVOLT_eVoltPaginationSingle_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_pagination_single';
    protected $title = 'Pagination Single';
    protected $icon = 'eicon-apps';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"archive_link","label":"Archive Link","type":"url","label_block":true}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}