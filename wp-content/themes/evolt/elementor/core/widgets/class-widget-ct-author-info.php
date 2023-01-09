<?php

class EVOLT_eVoltAuthorInfo_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_author_info';
    protected $title = 'Author Info';
    protected $icon = 'eicon-user-circle-o';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"content_section","label":"Content","tab":"content","controls":[{"name":"image","label":"Image","type":"media"},{"name":"bg","label":"Background Image","type":"media"},{"name":"title","label":"Title","type":"text"},{"name":"position","label":"Position","type":"text"},{"name":"social","label":"Social","type":"evolt_icons"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}