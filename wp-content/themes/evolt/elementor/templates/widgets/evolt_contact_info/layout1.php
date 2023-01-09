<?php
$default_settings = [
    'contact_info' => '',
    'icon_color' => '',
    'icon_color_gradient' => '',
    'evolt_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$has_icon = ! empty( $settings['evolt_icon'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['evolt_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
$html_id = evolt_get_element_id($settings);
?>
<?php if(isset($settings['contact_info']) && !empty($settings['contact_info']) && count($settings['contact_info'])): ?>
    <div class="evolt-inline-css"  data-css="
        <?php if( !empty($icon_color) && !empty($icon_color_gradient) ) : ?>
            #<?php echo esc_attr($html_id) ?>.evolt-contact-info1 i {
                background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo esc_attr($icon_color); ?>), to(<?php echo esc_attr($icon_color_gradient); ?>));
                background-image: -webkit-linear-gradient(left, <?php echo esc_attr($icon_color); ?>, <?php echo esc_attr($icon_color_gradient); ?>);
                background-image: -moz-linear-gradient(left, <?php echo esc_attr($icon_color); ?>, <?php echo esc_attr($icon_color_gradient); ?>);
                background-image: -ms-linear-gradient(left, <?php echo esc_attr($icon_color); ?>, <?php echo esc_attr($icon_color_gradient); ?>);
                background-image: -o-linear-gradient(left, <?php echo esc_attr($icon_color); ?>, <?php echo esc_attr($icon_color_gradient); ?>);
                background-image: linear-gradient(left, <?php echo esc_attr($icon_color); ?>, <?php echo esc_attr($icon_color_gradient); ?>);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo esc_attr($icon_color); ?>', endColorStr='<?php echo esc_attr($icon_color_gradient); ?>');
                background-color: transparent;
                background-clip: text;
                -o-background-clip: text;
                -ms-background-clip: text;
                -moz-background-clip: text;
                -webkit-background-clip: text;
                text-fill-color: transparent;
                -o-text-fill-color: transparent;
                -ms-text-fill-color: transparent;
                -moz-text-fill-color: transparent;
                -webkit-text-fill-color: transparent;
            }
        <?php endif; ?>">
    </div>
    <ul id="<?php echo esc_attr($html_id); ?>" class="evolt-contact-info evolt-contact-info1 <?php echo esc_attr($evolt_animate); ?>" data-wow-duration="1.2s">
        <?php
        	foreach ($settings['contact_info'] as $key => $evolt_info):
        		$icon_key = $widget->get_repeater_setting_key( 'evolt_icon', 'contact_info', $key );

        		$has_icon = ! empty( $evolt_info['evolt_icon'] );
        		$widget->add_render_attribute( $icon_key, [
	                'class' => $evolt_info['evolt_icon'],
	                'aria-hidden' => 'true',
	            ] );
			?>
            <li>
            	<?php if ( $evolt_info['icon_type'] == 'icon' && $has_icon ) : ?>
			        <span class="evolt-contact-icon">
		                <?php
		                    if($is_new):
		                        \Elementor\Icons_Manager::render_icon( $evolt_info['evolt_icon'], [ 'aria-hidden' => 'true' ] );
		                ?>
		                <?php else: ?>
		                    <i <?php evolt_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
		                <?php endif; ?>
			        </span>
			    <?php endif; ?>
                <?php if ( $evolt_info['icon_type'] == 'image' && !empty($evolt_info['icon_image']) ) : 
                    $img_icon  = evolt_get_image_by_size( array(
                        'attach_id'  => $evolt_info['icon_image']['id'],
                        'thumb_size' => 'full',
                    ) );
                    $thumbnail_icon    = $img_icon['thumbnail'];
                    ?>
                    <span class="evolt-contact-icon">
                        <?php echo evolt_print_html($thumbnail_icon); ?>
                    </span>
                <?php endif; ?>
                <span class="evolt-contact-content">
            	   <?php echo evolt_print_html($evolt_info['content'])?>
                </span>
           </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
