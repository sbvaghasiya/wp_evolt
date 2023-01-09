<?php

class EVOLT_eVoltTeamMember_Widget extends Wider_Theme_Core_Widget_Base{
    protected $name = 'evolt_team_member';
    protected $title = 'Team Member';
    protected $icon = 'eicon-nerd-wink';
    protected $categories = array( 'wider-theme-core' );
    protected $params = '{"sections":[{"name":"section_Content","label":"Content","tab":"content","controls":[{"name":"image","label":"Image","type":"media","description":"Select image."},{"name":"title","label":"Title","type":"text","label_block":true},{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .evolt-team-member .evolt-team-title":"color: {{VALUE}};"}},{"name":"position","label":"Position","type":"text"},{"name":"position_color","label":"Position Color","type":"color","selectors":{"{{WRAPPER}} .evolt-team-member .evolt-team-position":"color: {{VALUE}};"}},{"name":"btn_text","label":"Button Text","type":"text"},{"name":"btn_link","label":"Button Link","type":"url"},{"name":"btn_style","label":"Button Style","type":"select","options":{"btn":"Default","btn btn-gradient":"Gradient"},"default":"btn"},{"name":"button_bg_color","label":"Button Background Color","type":"color","selectors":{"{{WRAPPER}} .evolt-team-member .evolt-team-button .btn-gradient":"background: {{VALUE}};"}},{"name":"button_bg_color_hover","label":"Button Background Color","type":"color","selectors":{"{{WRAPPER}} .evolt-team-member .evolt-team-button .btn-gradient:hover":"background: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}