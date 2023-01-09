<?php
$default_settings = [
    'sub_title' => '',
    'title' => '',
    'description_text' => '',
    'box_image' => '',
    'box_image_left' => '',
    'style' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
if(class_exists('MC4WP_Container')) : ?>
	<?php
		switch ($style) {

			case 'style2': ?>
				<div class="evolt-mailchimp evolt-mailchimp1 bg-image style2" <?php if(!empty($box_image['id'])) : ?>style="background-image: url(<?php echo esc_url($box_image['url']); ?>);"<?php endif; ?>>
			    	<div class="evolt-mailchimp-inner">
			    		<?php if(!empty($box_image_left['id'])) :
			    			$img  = evolt_get_image_by_size( array(
							    'attach_id'  => $box_image_left['id'],
							    'thumb_size' => 'full',
							) );
							$thumbnail    = $img['thumbnail'];
			    			?>
				    		<div class="evolt-mailchimp-image-left">
				    			<?php echo wp_kses_post($thumbnail); ?>
				    		</div>
				    	<?php endif; ?>
			    		<?php if( !empty($title) ) : ?>
					    	<div class="evolt-mailchimp-meta">
					    		<?php if(!empty($title)) : ?>
					    			<h4 class="wg-title"><?php echo esc_attr($title); ?></h4>
					    		<?php endif; ?>
					    	</div>
				    	<?php endif; ?>
					    <?php echo do_shortcode('[mc4wp_form]'); ?>
					</div>
			    </div>
				<?php break;

			case 'style3': ?>
				<div class="evolt-mailchimp evolt-mailchimp1 style3">
			    	<div class="evolt-mailchimp-inner">
			    		<?php if( !empty($title) ) : ?>
					    	<div class="evolt-mailchimp-meta">
					    		<?php if(!empty($title)) : ?>
					    			<h4 class="wg-title"><?php echo esc_attr($title); ?></h4>
					    		<?php endif; ?>
					    		<div class="wg-desc"><?php echo esc_attr($description_text); ?></div>
					    	</div>
				    	<?php endif; ?>
					    <?php echo do_shortcode('[mc4wp_form]'); ?>
					</div>
			    </div>
				<?php break;
			
			default: ?>
				<div class="evolt-mailchimp evolt-mailchimp1 style1">
					<?php echo do_shortcode('[mc4wp_form]'); ?>
				</div>
				<?php break;
		}
	?>
<?php endif; ?>
