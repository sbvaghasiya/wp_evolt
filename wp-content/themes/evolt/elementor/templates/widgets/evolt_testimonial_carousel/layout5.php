<?php
$widget->add_render_attribute( 'inner', [
    'class' => 'evolt-carousel-inner',
] );

$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

$arrows = $widget->get_setting('arrows');
$dots = $widget->get_setting('dots');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay', '');
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '500');
if (is_rtl()) {
    $carousel_dir = 'true';
} else {
    $carousel_dir = 'false';
}
$widget->add_render_attribute( 'carousel', [
    'class' => 'evolt-slick-carousel slick-shadow',
    'data-arrows' => $arrows,
    'data-dots' => $dots,
    'data-pauseOnHover' => $pause_on_hover,
    'data-autoplay' => $autoplay,
    'data-autoplaySpeed' => $autoplay_speed,
    'data-infinite' => $infinite,
    'data-speed' => $speed,
    'data-colxs' => $col_xs,
    'data-colsm' => $col_sm,
    'data-colmd' => $col_md,
    'data-collg' => $col_lg,
    'data-colxl' => $col_xl,
    'data-dir' => $carousel_dir,
    'data-slidesToScroll' => $slides_to_scroll,
] );
?>
<?php if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="evolt-testimonial evolt-testimonial-carousel5 evolt-slick-slider evolt-dots-<?php echo esc_attr($settings['dot_style']); ?>">
        <div <?php evolt_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php evolt_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['testimonial'] as $value): 
                    $title = isset($value['title']) ? $value['title'] : '';
                    $position = isset($value['position']) ? $value['position'] : '';
                    $description = isset($value['description']) ? $value['description'] : '';
                    $star = isset($value['star']) ? $value['star'] : '';
                    $image = isset($value['image']) ? $value['image'] : '';
                    ?>
                        <div class="slick-slide">
                            <div class="item--inner <?php echo esc_attr($settings['evolt_animate']); ?>">
                                <div class="item--line line-top"></div>
                                <div class="item--line line-right"></div>
                                <div class="item--line line-bottom"></div>
                                <div class="item--line line-left"></div>
                                <?php if(!empty($star)) : ?>
                                    <div class="item--star">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 341.333 341.333" style="enable-background:new 0 0 341.333 341.333;" xml:space="preserve"><g><polygon points="341.333,135.111 211.911,135.111 170.667,7.111 129.422,135.111 0,135.111 105.529,210.204 65.138,334.222 170.667,257.422 276.196,334.222 235.804,210.204 "/></g></svg>
                                        <?php echo esc_attr($star); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="item--description <?php echo esc_attr($settings['evolt_animate_d']); ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay_d']); ?>ms"><?php echo evolt_print_html($description); ?></div>
                                <div class="item--holder">
                                    <?php if(!empty($image['id'])) { 
                                        $img = evolt_get_image_by_size( array(
                                            'attach_id'  => $image['id'],
                                            'thumb_size' => '80x75',
                                        ));
                                        $thumbnail = $img['thumbnail']; 
                                        ?>
                                        <div class="item--image">
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="item--meta">
                                        <h3 class="item--title <?php echo esc_attr($settings['evolt_animate_t']); ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay_t']); ?>ms">    
                                            <?php echo esc_attr($title); ?>
                                        </h3>
                                        <div class="item--position <?php echo esc_attr($settings['evolt_animate_p']); ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay_p']); ?>ms"><?php echo esc_attr($position); ?></div>
                                    </div>
                                </div>
                           </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>