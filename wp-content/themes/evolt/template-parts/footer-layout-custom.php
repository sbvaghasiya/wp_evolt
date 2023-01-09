<?php
$footer_custom_custom = evolt_get_option('footer_custom_custom');
$custom_footer = evolt_get_page_option('custom_footer', 'false');
$footer_custom_custom_page = evolt_get_page_option('footer_custom_custom');
if($custom_footer && !empty($footer_custom_custom_page) ) {
    $footer_custom_custom = $footer_custom_custom_page;
}
?>
<footer id="colophon" class="site-footer-custom">
    <?php if(!empty($footer_custom_custom)) :  ?>
        <div class="footer-custom-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php $post = get_post($footer_custom_custom);
                        if (!is_wp_error($post) && $post->ID == $footer_custom_custom && class_exists('Wider_Theme_Core') && function_exists('evolt_print_html')){
                            $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_custom_custom );
                            evolt_print_html($content);
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <span class="evolt-footer-year"><?php echo esc_attr(date("Y")); ?></span>
</footer>