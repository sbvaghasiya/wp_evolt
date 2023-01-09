<?php
$default_settings = [
    'icons' => '',
    'style' => '',
    'align' => '',
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
<?php if(isset($icons) && !empty($icons) && count($icons)): ?>
    <div class="evolt-icon1 icon-align-<?php echo esc_attr($align); ?> <?php echo esc_attr($style); ?>">
        <?php foreach ($settings['icons'] as $key => $value):
            $icon_key = $widget->get_repeater_setting_key( 'evolt_icon', 'icons', $key );
            $has_icon = ! empty( $value['evolt_icon'] );
            $widget->add_render_attribute( $icon_key, [
                'class' => $value['evolt_icon'],
                'aria-hidden' => 'true',
            ] );

            $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
            if ( ! empty( $value['icon_link']['url'] ) ) {
                $widget->add_render_attribute( $link_key, 'href', $value['icon_link']['url'] );

                if ( $value['icon_link']['is_external'] ) {
                    $widget->add_render_attribute( $link_key, 'target', '_blank' );
                }

                if ( $value['icon_link']['nofollow'] ) {
                    $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                }
            }
            $link_attributes = $widget->get_render_attribute_string( $link_key ); ?>
            <?php if ( $has_icon ) : ?>
                <a class="<?php echo esc_attr($html_id.'-'.$key); ?>" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                    <?php
                        if($is_new):
                            \Elementor\Icons_Manager::render_icon( $value['evolt_icon'], [ 'aria-hidden' => 'true' ] );
                    ?>
                    <?php else: ?>
                        <i <?php evolt_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>