<?php
$widget->add_render_attribute( 'counter', [
    'class' => 'evolt-counter-number-value',
    'data-duration' => $settings['duration'],
    'data-to-value' => $settings['ending_number'],
] );

if ( ! empty( $settings['thousand_separator'] ) ) {
    $delimiter = empty( $settings['thousand_separator_char'] ) ? ',' : $settings['thousand_separator_char'];
    $widget->add_render_attribute( 'counter', 'data-delimiter', $delimiter );
}

$widget->add_render_attribute( 'selected_icon', 'class' );
$has_icon = ! empty( $settings['selected_icon'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['selected_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}

$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="evolt-counter evolt-counter-layout1 <?php echo esc_attr($settings['style'].' '.$settings['evolt_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay']); ?>ms">
    <div class="evolt-counter-inner">
        <?php if($settings['evolt_icon_type'] == 'icon'): ?>
            <div class="evolt-counter-icon">
                <?php if(!empty($settings['counter_icon'])): ?>
                    <?php
                    if($is_new):
                        \Elementor\Icons_Manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] );
                    ?>
                    <?php
                    else:
                        $widget->add_render_attribute( 'i', 'class', $settings['counter_icon'] );
                        $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
                    ?>
                        <i <?php evolt_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php elseif($settings['evolt_icon_type'] == 'image'): ?>
            <div class="evolt-counter-icon">
                <?php
                    if(!empty($settings['icon_image'])){
                        echo wp_get_attachment_image($settings['icon_image']['id']);
                    }
                ?>
            </div>
        <?php endif; ?>
        <div class="evolt-counter-meta">
            <div class="evolt-counter-number">
                <?php if(!empty($settings['prefix'])) : ?>
                    <span class="evolt-counter-number-prefix"><?php echo evolt_print_html($settings['prefix']); ?></span>
                <?php endif; ?>
                <span <?php evolt_print_html($widget->get_render_attribute_string( 'counter' )); ?>><?php echo esc_html($settings['starting_number']); ?></span>
                <?php if(!empty($settings['suffix'])) : ?>
                    <span class="evolt-counter-number-suffix"><?php echo evolt_print_html($settings['suffix']); ?></span>
                <?php endif; ?>
            </div>
            <?php if ( $settings['title'] ) : ?>
                <div class="evolt-counter-title"><?php echo evolt_print_html($settings['title']); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>