<?php

class EVOLT_eVoltFindMarkerForm_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_find_marker_form';
    protected $title = 'Find Marker Form';
    protected $icon = 'eicon-map-pin';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"content_section","label":"Content","tab":"content","controls":[]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-ui-slider' );
}