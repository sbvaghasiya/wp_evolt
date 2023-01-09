<?php
$default_settings = [
    'date' => '2030/10/10',
    'evolt_day' => '',
    'evolt_hour' => '',
    'evolt_minute' => '',
    'evolt_second' => '',
    'style' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings); 
$month = esc_html__('Month', 'evolt');
$months = esc_html__('Months', 'evolt');
$day = esc_html__('Day', 'evolt');
$days = esc_html__('Days', 'evolt');
if($style == 'style1' || $style == 'style4') {
	$hour = esc_html__('Hour', 'evolt');
	$hours = esc_html__('Hours', 'evolt');
	$minute = esc_html__('Minute', 'evolt');
	$minutes = esc_html__('Minutes', 'evolt');
	$second = esc_html__('Second', 'evolt');
	$seconds = esc_html__('Seconds', 'evolt');
} else {
	$hour = esc_html__('Hour', 'evolt');
	$hours = esc_html__('Hour', 'evolt');
	$minute = esc_html__('Min', 'evolt');
	$minutes = esc_html__('Min', 'evolt');
	$second = esc_html__('Sec', 'evolt');
	$seconds = esc_html__('Sec', 'evolt');
}
?>
<div class="evolt-countdown evolt-countdown-layout1 <?php echo esc_attr($settings['evolt_animate']); ?> <?php echo esc_attr($style.' '.$evolt_day.' '.$evolt_hour.' '.$evolt_minute.' '.$evolt_second); ?>" 
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