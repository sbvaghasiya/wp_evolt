<?php
$default_settings = [
    'item_list' => '',
    'evolt_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = evolt_get_element_id($settings);
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($item_list) && !empty($item_list) && count($item_list)): ?>
	<div class="evolt-point">
		<?php foreach ($item_list as $key => $value): ?>
		    <div id="<?php echo esc_attr($html_id.$key); ?>" class="evolt-point-item">
		    	<div class="evolt-point-holder">
		    		<div class="evolt-point-meta <?php echo esc_attr($value['sm_md_pos']); ?>">
			    		<div class="evolt-point-desc el-empty"><?php echo evolt_print_html($value['desc']); ?></div>
			    		<h5 class="evolt-point-title el-empty"><span><?php echo evolt_print_html($value['title']); ?></span></h5>
				    </div>
				    <?php if ( ! empty( $value['point_icon'] ) ) : 
			    		$widget->add_render_attribute( 'i', 'class', $value['point_icon'] );
						   $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
			    		?>
			            <div class="evolt-point-icon">
			                <?php if($is_new):
			                    \Elementor\Icons_Manager::render_icon( $value['point_icon'], [ 'aria-hidden' => 'true' ] );
			                    else: ?>
			                    <i <?php evolt_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
			                <?php endif; ?>
			            </div>
			        <?php endif; ?>
	    		</div>
		    	<div class="evolt-inline-css"  data-css="
		            .evolt-point #<?php echo esc_attr($html_id.$key) ?> {
		                left: <?php echo esc_attr($value['left_positioon']['size']); ?>%;
		                top: <?php echo esc_attr($value['top_positioon']['size']); ?>%;
		            }">
		        </div>
		    </div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
