<?php
$widget->add_render_attribute( 'selected_icon', 'class' );
$has_icon = ! empty( $settings['selected_icon'] );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['selected_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}

$widget->add_render_attribute( 'description_text', 'class', 'item--description' );

$widget->add_inline_editing_attributes( 'title_text', 'none' );
$widget->add_inline_editing_attributes( 'description_text' );

$is_new = \Elementor\Icons_Manager::is_migration_allowed();

if ( ! empty( $settings['item_link']['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $settings['item_link']['url'] );

    if ( $settings['item_link']['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $settings['item_link']['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
?>
<div class="evolt-fancy-box evolt-fancy-box-layout3 <?php echo esc_attr($settings['style_l3']); ?> <?php echo esc_attr($settings['evolt_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay']); ?>ms">
    <div class="item--inner">
        <?php if ( $settings['icon_type'] == 'icon' && $has_icon ) : ?>
            <div class="item--icon">
                <?php if($is_new):
                    \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                    else: ?>
                    <i <?php evolt_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : ?>
            <div class="item--icon">
                <?php $img_icon  = evolt_get_image_by_size( array(
                        'attach_id'  => $settings['icon_image']['id'],
                        'thumb_size' => 'full',
                    ) );
                    $thumbnail_icon    = $img_icon['thumbnail'];
                echo evolt_print_html($thumbnail_icon); ?>
            </div>
        <?php endif; ?>
        <div class="item--holder">
            <h5 class="item--title">
                <?php echo evolt_print_html($settings['title_text']); ?>
            </h5>
            <div <?php evolt_print_html($widget->get_render_attribute_string( 'description_text' )); ?>><?php echo evolt_print_html($settings['description_text']); ?></div>
        </div>
        <?php if ( ! empty( $settings['item_link']['url'] ) ) { ?><a class="item--link" <?php evolt_print_html($widget->get_render_attribute_string( 'button' )); ?>></a><?php } ?>
    </div>
</div>