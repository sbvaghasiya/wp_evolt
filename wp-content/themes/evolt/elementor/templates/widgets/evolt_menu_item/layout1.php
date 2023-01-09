<?php
$default_settings = [
    'style' => '',
    'wg_title' => '',
    'menu_item' => '',
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
?>
<?php if(isset($menu_item) && !empty($menu_item) && count($menu_item)): ?>
<div class="evolt-menu-item-wrap <?php echo esc_attr($col.' '.$style); ?>">
    <?php if(!empty($wg_title)) : ?>
        <div class="evolt-wg-title">
            <span class="evolt-icon-menu-lg"><i></i></span>
            <?php echo esc_attr($wg_title); ?>
        </div>
    <?php endif; ?>
    <ul class="evolt-menu-item <?php echo esc_attr($evolt_animate); ?>">
        <?php
        	foreach ($menu_item as $key => $item):
                $icon_key = $widget->get_repeater_setting_key( 'evolt_icon', 'icons', $key );
                $has_icon = ! empty( $item['evolt_icon'] );
                $widget->add_render_attribute( $icon_key, [
                    'class' => $item['evolt_icon'],
                    'aria-hidden' => 'true',
                ] );

                $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
                if ( ! empty( $item['link']['url'] ) ) {
                    $widget->add_render_attribute( $link_key, 'href', $item['link']['url'] );

                    if ( $item['link']['is_external'] ) {
                        $widget->add_render_attribute( $link_key, 'target', '_blank' );
                    }

                    if ( $item['link']['nofollow'] ) {
                        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                    }
                }
                $link_attributes = $widget->get_render_attribute_string( $link_key );
                ?>
                <li>
                    <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                        <?php if ( $has_icon ) : ?>
                            <?php
                                if($is_new):
                                    \Elementor\Icons_Manager::render_icon( $item['evolt_icon'], [ 'aria-hidden' => 'true' ] );
                            ?>
                            <?php else: ?>
                                <i <?php evolt_print_html($widget->get_render_attribute_string( $icon_key )); ?>></i>
                            <?php endif; ?>
                        <?php endif; ?>
                        <span><?php echo evolt_print_html($item['text']); ?></span>
                        <?php if(!empty($item['label'])) : ?>
                            <cite><?php echo esc_attr($item['label']); ?></cite>
                        <?php endif; ?>
                    </a>
                </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
