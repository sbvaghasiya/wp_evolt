<?php

class EVOLT_EvoltNavigationMenu_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_navigation_menu';
    protected $title = 'Wider Navigation';
    protected $icon = 'eicon-menu-bar';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"menu","label":"Select Menu","type":"select","options":{"all-pages":"All Pages","all-pages-flat":"All Pages Flat","empty-menu":"Empty Menu","header-demo-menu":"header-demo-menu","menu-top-bar-second-layout":"Menu top bar (Second Layout)","short":"Short","social-menu":"Social menu","testing-menu":"Testing Menu"}},{"name":"style","label":"Style","type":"select","options":{"default":"Default","style1":"Style 1 (Light)","style2":"Style 2 (Dark)","style3":"Style 3 (Main Menu)","style4":"Style 4 (Light)"},"default":"default"},{"name":"link_color","label":"Link Color","type":"color","selectors":{"{{WRAPPER}} .evolt-navigation-menu1.style1 a":"color: {{VALUE}};","{{WRAPPER}} .evolt-navigation-menu1.style1 a span::before":"background-color: {{VALUE}};"},"condition":{"style":["style1"]}},{"name":"link_color_hover","label":"Link Color Hover","type":"color","selectors":{"{{WRAPPER}} .evolt-navigation-menu1.style1 a:hover":"color: {{VALUE}};","{{WRAPPER}} .evolt-navigation-menu1.style1 a:hover span::before":"background-color: {{VALUE}};"},"condition":{"style":["style1"]}},{"name":"link_typography","label":"Link Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-navigation-menu1 li a"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}