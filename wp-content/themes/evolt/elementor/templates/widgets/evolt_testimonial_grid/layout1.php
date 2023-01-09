<?php
$default_settings = [
    'col_xl' => '4',
    'col_lg' => '4',
    'col_md' => '3',
    'col_sm' => '2',
    'col_xs' => '1',
    'content_list' => '',
    'thumbnail_size' => '',
    'thumbnail_custom_dimension' => '',
    'evolt_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$col_xl = 12 / intval($col_xl);
$col_lg = 12 / intval($col_lg);
$col_md = 12 / intval($col_md);
$col_sm = 12 / intval($col_sm);
$col_xs = 12 / intval($col_xs);
$grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
$item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
    <div class="evolt-grid evolt-testimonial-grid1">
        <div class="evolt-grid-inner evolt-grid-masonry row animate-time" data-gutter="7">
            <?php foreach ($content_list as $key => $value):
    			$title = isset($value['title']) ? $value['title'] : '';
                $position = isset($value['position']) ? $value['position'] : '';
                $description = isset($value['description']) ? $value['description'] : '';
                $image = isset($value['image']) ? $value['image'] : '';
                ?>
                <div class="<?php echo esc_attr($item_class); ?>">
                    <div class="item--inner <?php echo esc_attr($evolt_animate); ?>" data-wow-duration="1.2s">
                        <?php if(!empty($image['id'])) { 
                            $img = evolt_get_image_by_size( array(
                                'attach_id'  => $image['id'],
                                'thumb_size' => '86x86',
                            ));
                            $thumbnail = $img['thumbnail']; 
                            ?>
                            <div class="item--image">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </div>
                        <?php } ?>
                        <div class="item--description <?php echo esc_attr($settings['evolt_animate_d']); ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay_d']); ?>ms"><?php echo evolt_print_html($description); ?></div>
                        <div class="item--meta">
                            <h3 class="item--title <?php echo esc_attr($settings['evolt_animate_t']); ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay_t']); ?>ms">    
                                <?php echo esc_attr($title); ?>
                            </h3>
                            <div class="item--position <?php echo esc_attr($settings['evolt_animate_p']); ?>" data-wow-delay="<?php echo esc_attr($settings['evolt_animate_delay_p']); ?>ms"><?php echo esc_attr($position); ?></div>
                        </div>
                   </div>
                </div>
            <?php endforeach; ?>
            <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        </div>
    </div>
<?php endif; ?>
