<?php

class EVOLT_eVoltCountdown_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_countdown';
    protected $title = 'Wider Countdown';
    protected $icon = 'eicon-countdown';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"countdown_section","label":"Content","tab":"content","controls":[{"name":"layout","label":"Layout","type":"select","options":{"1":"Layout 1","2":"Layout 2"},"default":"1"},{"name":"date","label":"Date","type":"text","label_block":true,"description":"Set date count down (Date format: yy\/mm\/dd)"},{"name":"evolt_day","label":"Day","type":"select","options":{"show-day":"True","hide":"False"},"default":"show-day"},{"name":"evolt_hour","label":"Hour","type":"select","options":{"show-hour":"True","hide":"False"},"default":"show-hour"},{"name":"evolt_minute","label":"Minute","type":"select","options":{"show-minute":"True","hide":"False"},"default":"show-minute"},{"name":"evolt_second","label":"Second","type":"select","options":{"show-second":"True","hide":"False"},"default":"show-second"},{"name":"style","label":"Style","type":"select","options":{"style1":"Style 1","style2":"Style 2","style3":"Style 3","style4":"Style 4"},"default":"style1","condition":{"layout":["1"]}},{"name":"align","label":"Alignment","type":"choose","control_type":"responsive","options":{"flex-start":{"title":"Left","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"flex-end":{"title":"Right","icon":"eicon-text-align-right"}},"selectors":{"{{WRAPPER}} .evolt-countdown-layout1":"justify-content: {{VALUE}};"}},{"name":"image","label":"Image","type":"media","condition":{"layout":["2"]}},{"name":"title","label":"Title","type":"text","label_block":true,"condition":{"layout":["2"]}},{"name":"sub_title","label":"Sub Title","type":"text","condition":{"layout":["2"]}},{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .evolt-countdown-banner1 .item--title":"color: {{VALUE}};"},"condition":{"layout":["2"]}},{"name":"title_typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-countdown-banner1 .item--title","condition":{"layout":["2"]}},{"name":"subtitle_color","label":"Sub Title Color","type":"color","selectors":{"{{WRAPPER}} .evolt-countdown-banner1 .item--subtitle":"color: {{VALUE}};"},"condition":{"layout":["2"]}},{"name":"subtitle_typography","label":"Sub Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .evolt-countdown-banner1 .item--subtitle","condition":{"layout":["2"]}},{"name":"evolt_animate","label":"Wider Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomIn":"zoomIn","wow zoomInDown":"zoomInDown","wow zoomInLeft":"zoomInLeft","wow zoomInRight":"zoomInRight","wow zoomInUp":"zoomInUp","wow zoomOut":"zoomOut","wow zoomOutDown":"zoomOutDown","wow zoomOutLeft":"zoomOutLeft","wow zoomOutRight":"zoomOutRight","wow zoomOutUp":"zoomOutUp"},"default":""},{"name":"evolt_animate_delay","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'evolt-countdown' );
}