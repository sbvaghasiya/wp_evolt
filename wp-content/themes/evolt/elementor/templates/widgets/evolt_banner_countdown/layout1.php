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
$month = esc_html__('Month', 'evolt');
$months = esc_html__('Months', 'evolt');
$day = esc_html__('Day', 'evolt');
$days = esc_html__('Days', 'evolt');
$hour = esc_html__('Hour', 'evolt');
$hours = esc_html__('Hours', 'evolt');
$minute = esc_html__('Minute', 'evolt');
$minutes = esc_html__('Minutes', 'evolt');
$second = esc_html__('Second', 'evolt');
$seconds = esc_html__('Seconds', 'evolt');
?>
<?php if(isset($settings['banner_countdown']) && !empty($settings['banner_countdown']) && count($settings['banner_countdown'])): ?>
    <div class="evolt-banner-countdown evolt-bc-carousel1 evolt-slick-slider">
        <div <?php evolt_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php evolt_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['banner_countdown'] as $value): 
                    $title = isset($value['title']) ? $value['title'] : '';
                    $sub_title = isset($value['sub_title']) ? $value['sub_title'] : '';
                    $date = isset($value['date']) ? $value['date'] : '';
                    $image = isset($value['image']) ? $value['image'] : '';
                    ?>
                        <div class="slick-slide">
                            <div class="item--inner <?php echo esc_attr($settings['evolt_animate']); ?>">
                                <?php if(!empty($image['id'])) { 
                                    $img = evolt_get_image_by_size( array(
                                        'attach_id'  => $image['id'],
                                        'thumb_size' => 'full',
                                    ));
                                    $thumbnail = $img['thumbnail']; 
                                    ?>
                                    <div class="item--image">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                <?php } ?>
                                <div class="item--meta">
                                    <div class="item--subtitle">
                                        <?php echo esc_attr($sub_title); ?>
                                    </div>
                                    <h4 class="item--title">    
                                        <?php echo esc_attr($title); ?>
                                    </h4>
                                    <div class="evolt-countdown evolt-countdown-layout1 style4" 
                                        data-month="<?php echo esc_attr($month) ?>"
                                        data-months="<?php echo esc_attr($months) ?>"
                                        data-day="<?php echo esc_attr($day) ?>"
                                        data-days="<?php echo esc_attr($days) ?>"
                                        data-hour="<?php echo esc_attr($hour) ?>"
                                        data-hours="<?php echo esc_attr($hours) ?>"
                                        data-minute="<?php echo esc_attr($minute) ?>"
                                        data-minutes="<?php echo esc_attr($minutes) ?>"
                                        data-second="<?php echo esc_attr($second) ?>"
                                        data-seconds="<?php echo esc_attr($seconds) ?>">
                                        <div class="evolt-countdown-inner" data-count-down="<?php echo esc_attr($date);?>"></div>
                                    </div>
                                </div>
                           </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>