<?php
$default_settings = [
    'date' => '2030/10/10',
    'evolt_day' => '',
    'evolt_hour' => '',
    'evolt_minute' => '',
    'evolt_second' => '',
    'title' => '',
    'sub_title' => '',
    'image' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings); 
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
<div class="evolt-countdown-banner1">
	<div class="item--inner">
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
        <div class="item--subtitle">
            <?php echo esc_attr($sub_title); ?>
        </div>
        <h4 class="item--title">    
            <?php echo esc_attr($title); ?>
        </h4>
		<div class="evolt-countdown evolt-countdown-layout2 <?php echo esc_attr($settings['evolt_animate']); ?> <?php echo esc_attr($evolt_day.' '.$evolt_hour.' '.$evolt_minute.' '.$evolt_second); ?>" 
			data-month="<?php echo esc_attr($month) ?>"
			data-months="<?php echo esc_attr($months) ?>"
			data-day="<?php echo esc_attr($day) ?>"
			data-days="<?php echo esc_attr($days) ?>"
			data-hour="<?php echo esc_attr($hour) ?>"
			data-hours="<?php echo esc_attr($hours) ?>"
			data-minute="<?php echo esc_attr($minute) ?>"
			data-minutes="<?php echo esc_attr($minutes) ?>"
			data-second="<?php echo esc_attr($second) ?>"
			data-seconds="<?php echo esc_attr($seconds) ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay']); ?>ms">
			<div class="evolt-countdown-inner" data-count-down="<?php echo esc_attr($date);?>"></div>
		</div>
	</div>
</div>