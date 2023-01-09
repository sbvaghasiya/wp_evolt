<?php
$default_settings = [
    'list' => '',
    'selected_icon' => '',
    'evolt_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$has_icon = ! empty( $selected_icon );
if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $selected_icon );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($list) && !empty($list) && count($list)): ?>
    <div class="evolt-list">
        <?php
        	foreach ($list as $key => $evolt_list): ?>
            <div class="evolt-list-item <?php echo esc_attr($evolt_animate); ?>">
                <?php if ( $has_icon ) : ?>
                    <div class="evolt-list-icon">
                        <?php if($is_new):
                            \Elementor\Icons_Manager::render_icon( $selected_icon, [ 'aria-hidden' => 'true' ] );
                            else: ?>
                            <i <?php evolt_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            	<div class="evolt-list-content">
	            	<?php echo evolt_print_html($evolt_list['content'])?>
	            </div>
           </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
