<?php

class EVOLT_eVoltPieCharts_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_pie_charts';
    protected $title = 'Pie Chart';
    protected $icon = 'fa fa-pie-chart';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"section_piecharts","label":"Piecharts","tab":"content","controls":[{"name":"title","label":"Title","type":"text","label_block":true},{"name":"description","label":"Description","type":"textarea","rows":10,"show_label":false},{"name":"percentage_value","label":"Percentage Value","type":"number","min":1,"max":100,"step":1,"default":50},{"name":"icon_type","label":"Icon Type","type":"select","options":{"icon":"Icon","image":"Image"},"default":"icon"},{"name":"selected_icon","label":"Icon","type":"icons","fa4compatibility":"icon","condition":{"icon_type":"icon"}},{"name":"icon_image","label":"Icon Image","type":"media","description":"Select image icon.","condition":{"icon_type":"image"}},{"name":"chart_size","label":"Chart Size","type":"slider","control_type":"responsive","size_units":["px"],"default":{"size":126},"range":{"px":{"min":0,"max":1170}}},{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .evolt-piechart .item--title":"color: {{VALUE}};"}},{"name":"title_typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-piechart .item--title"},{"name":"desc_color","label":"Description Color","type":"color","selectors":{"{{WRAPPER}} .evolt-piechart .item--desc":"color: {{VALUE}};"}},{"name":"bar_color","label":"Bar Color","type":"color"},{"name":"track_color","label":"Track Color","type":"color"},{"name":"evolt_animate","label":"Wider Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'easy-pie-chart-lib-js','evolt-piecharts-widget-js' );
}