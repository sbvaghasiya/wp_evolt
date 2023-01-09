<?php
$default_settings = [
    'user_type' => 'sign-in',
    'title' => '',
    'btn_label' => '',
    'btn_text' => '',
    'btn_link' => '',
    'footer_text' => '',
    'footer_link' => '',
    'evolt_animate' => '',
    'evolt_animate_delay' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
if ( ! empty( $btn_link['url'] ) ) {
    $widget->add_render_attribute( 'btn_link', 'href', $btn_link['url'] );

    if ( $btn_link['is_external'] ) {
        $widget->add_render_attribute( 'btn_link', 'target', '_blank' );
    }

    if ( $btn_link['nofollow'] ) {
        $widget->add_render_attribute( 'btn_link', 'rel', 'nofollow' );
    }
}
if ( ! empty( $footer_link['url'] ) ) {
    $widget->add_render_attribute( 'footer_link', 'href', $footer_link['url'] );

    if ( $footer_link['is_external'] ) {
        $widget->add_render_attribute( 'footer_link', 'target', '_blank' );
    }

    if ( $footer_link['nofollow'] ) {
        $widget->add_render_attribute( 'footer_link', 'rel', 'nofollow' );
    }
}
?>
<div class="evolt-user <?php echo esc_attr($evolt_animate); ?>" data-wow-delay="<?php echo esc_attr($evolt_animate_delay); ?>ms">
    <div class="evolt-user-inner">
        <div class="evolt-user-holder">
            <div class="evolt-user-meta">
                <?php if(!empty($title)) : ?>
                    <h4 class="evolt-user-title"><?php echo esc_attr($title); ?></h4>
                <?php endif; ?>
                <?php if($user_type == 'sign-in') {
                    echo do_shortcode('[evolt-user-form form_type="login" is_logged="profile"]'); 
                } else {
                    echo do_shortcode('[evolt-user-form form_type="register"]');
                } ?>
            </div>  
            <?php if(!empty($btn_text)) : ?>
                <div class="evolt-user-bottom">
                    <?php echo esc_attr($btn_label); ?>
                    <a <?php evolt_print_html($widget->get_render_attribute_string( 'btn_link' )); ?>><?php echo esc_attr($btn_text); ?></a>
                </div>   
            <?php endif; ?>
        </div>
        <?php if(!empty($footer_text)) : ?>
            <div class="evolt-user-footer">
                <a <?php evolt_print_html($widget->get_render_attribute_string( 'footer_link' )); ?>><?php echo esc_attr($footer_text); ?></a>
            </div>
        <?php endif; ?>   
    </div>
</div>