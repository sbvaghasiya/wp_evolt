<?php

class EVOLT_eVoltProgressbar_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_progressbar';
    protected $title = 'Progress Bar';
    protected $icon = 'eicon-skill-bar';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"progressbar_list","label":"Progress Bar Lists","type":"repeater","controls":[{"name":"title","label":"Title","type":"text","label_block":true},{"name":"percent","label":"Percentage","type":"slider","default":{"size":50,"unit":"%"},"label_block":true}],"title_field":"{{{ title }}}"},{"name":"layout","label":"Layout","type":"select","options":{"1":"Layout 1","2":"Layout 2","3":"Layout 3","4":"Layout 4","5":"Layout 5"},"default":"1"},{"name":"style","label":"Style","type":"select","options":{"style1":"Style 1","style2":"Style 2"},"default":"style1","condition":{"layout":["3"]}}]},{"name":"section_title","label":"Style","tab":"style","controls":[{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .evolt-progressbar .evolt-progress-title":"color: {{VALUE}};"}},{"name":"typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-progressbar .evolt-progress-title"},{"name":"percent_color","label":"Percentage Color","type":"color","selectors":{"{{WRAPPER}} .evolt-progressbar .evolt-progress-percentage":"color: {{VALUE}};"}},{"name":"bar_color","label":"Bar Color","type":"color","selectors":{"{{WRAPPER}} .evolt-progressbar .evolt-progress-bar":"background-color: {{VALUE}};"}},{"name":"bar_bg_color","label":"Bar Background Color","type":"color","selectors":{"{{WRAPPER}} .evolt-progressbar .evolt-progress-holder":"background: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'progressbar','evolt-progressbar-widget-js' );
}