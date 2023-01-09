<?php
$default_settings = [
    'title' => '',
    'title_tag' => 'h3',
    'style' => 'st-default',
    'sub_title' => '',
    'sub_title_style' => '',
    'text_align' => '',
    'evolt_animate' => '',
    'evolt_animate_delay' => '',
    'evolt_icon' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings); 
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="evolt-heading h-align-<?php echo esc_attr($text_align); ?> item-<?php echo esc_attr($style); ?>">
	<?php if(!empty($sub_title)) : ?>
		<div class="item--sub-title <?php echo esc_attr($sub_title_style); ?>">
            <span>
                <?php if($sub_title_style == 'style-default') { ?><span>~</span><?php } ?>
                <?php echo esc_attr($sub_title); ?>
                <?php if($sub_title_style == 'style-default') { ?><span>~</span><?php } ?>
            </span>
        </div>
	<?php endif; ?>
    <<?php echo esc_attr($title_tag); ?> class="item--title case-animate-time <?php echo esc_attr($style); ?> <?php if($evolt_animate != 'case-fade-in-up') { echo esc_attr('wow '.$evolt_animate); } ?>" data-wow-delay="<?php echo esc_attr($evolt_animate_delay); ?>ms">
        <?php if($evolt_animate == 'case-fade-in-up') {
            $arr_str = explode(' ', $title);
            foreach ($arr_str as $index => $value) {
                $arr_str[$index] = '<span class="slide-in-container"><span class="d-inline-block wow '.$evolt_animate.'">' . $value . '</span></span>';
            }
            $str = implode(' ', $arr_str);
            echo evolt_print_html($str);
        } else {
            echo '<span>';
            echo wp_kses_post($title);
            echo '</span>';
        } ?>
    </<?php echo esc_attr($title_tag); ?>>
</div>

