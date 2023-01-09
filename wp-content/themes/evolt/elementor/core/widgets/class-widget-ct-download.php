<?php

class EVOLT_eVoltDownload_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_download';
    protected $title = 'Download';
    protected $icon = 'eicon-file-download';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"download","label":"Download List","type":"repeater","default":[],"controls":[{"name":"title","label":"Title","type":"textarea","label_block":true},{"name":"evolt_icon","label":"Icon","type":"icons","fa4compatibility":"icon"},{"name":"link","label":"Link","type":"url"}],"title_field":"{{{ title }}}"},{"name":"wg_title","label":"Widget Title","type":"textarea","label_block":true},{"name":"box_bg_image","label":"Box Background Image","type":"media"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}