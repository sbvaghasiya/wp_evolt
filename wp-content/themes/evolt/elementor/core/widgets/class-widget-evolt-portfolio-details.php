<?php

class EVOLT_EvoltPortfolioDetails_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_portfolio_details';
    protected $title = 'Wider Portdolio Details';
    protected $icon = 'eicon-library-upload';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"wg_title","label":"Widget Title","type":"text"},{"name":"portfolio_content","label":"Content","type":"repeater","controls":[{"name":"label","label":"Label","type":"text","label_block":true},{"name":"content","label":"Content","type":"text"}],"title_field":"{{{ label }}}"},{"name":"value_label","label":"Value Label","type":"text"},{"name":"value_text","label":"Value Text","type":"text"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}