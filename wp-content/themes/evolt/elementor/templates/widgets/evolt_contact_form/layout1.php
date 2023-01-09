<?php
$default_settings = [
    'form_id' => '',
    'sub_title' => '',
    'title' => '',
    'description' => '',
    'style' => 'style1',
    'evolt_animate' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

if(class_exists('WPCF7') && !empty($form_id)) : ?>
    <div class="evolt-contact-form evolt-contact-form-layout1 <?php echo esc_attr($style.' '.$evolt_animate); ?>">
    	<?php if(!empty($title) || !empty($description)) : ?>
	    	<div class="evolt-contact-meta">
                <?php if(!empty($sub_title)) : ?>
                    <h6><?php echo esc_attr($sub_title); ?></h6>
                <?php endif; ?>
                <?php if(!empty($title)) : ?>
                    <h3><span><?php echo esc_attr($title); ?></span></h3>
                <?php endif; ?>
                <?php if(!empty($description)) : ?>
	    		     <p><?php echo evolt_print_html($description); ?></p>
                <?php endif; ?>
	    	</div>
	    <?php endif; ?>
        <div class="evolt-contact-form">
            <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $form_id ).'"]'); ?>
        </div>
    </div>
<?php endif; ?>
