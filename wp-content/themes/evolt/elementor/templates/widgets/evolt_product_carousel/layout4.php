<?php

$html_id = evolt_get_element_id($settings);
$source = $widget->get_setting('source', '');
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
$post_ids = $widget->get_setting('post_ids', '');
extract(evolt_get_posts_of_grid('product', [
    'source' => $source,
    'orderby' => $orderby,
    'order' => $order,
    'limit' => $limit,
    'post_ids' => $post_ids,
]));

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
$autoplay = $widget->get_setting('autoplay');
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
    'data-dir' => $carousel_dir,
    'data-colxs' => $col_xs,
    'data-colsm' => $col_sm,
    'data-colmd' => $col_md,
    'data-collg' => $col_lg,
    'data-colxl' => $col_xl,
    'data-slidesToScroll' => $slides_to_scroll,
] );

$title_tag = $widget->get_setting('title_tag', 'h3');

$thumbnail_size = $widget->get_setting('thumbnail_size', 'full');
$thumbnail_custom_dimension = $widget->get_setting('thumbnail_custom_dimension', '');
if($thumbnail_size != 'custom'){
    $img_size = $thumbnail_size;
}
elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
    $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
}
else{
    $img_size = '500x400';
}?>
<?php if (is_array($posts)): ?>

<div id="<?php echo esc_attr($html_id) ?>" class="evolt-product-carousel4 evolt-dots-style2 evolt-slick-slider evolt-arrow-middle woocommerce">
    <div <?php evolt_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
        <div <?php evolt_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>

        <?php
            foreach ($posts as $post):
            $line_color = get_post_meta($post->ID, 'line_color', true);
            if(class_exists('Woocommerce')) {
                $product = wc_get_product( $post->ID ); ?>
                <div class="carousel-item slick-slide">
                    <div class="grid-item-inner <?php echo esc_attr($settings['evolt_animate']); ?>">
                        <div class="woocommerce-product-inner" <?php if(!empty($line_color['rgba'])) : ?>style="border-color: <?php echo esc_attr($line_color['rgba']); ?>"<?php endif; ?>>
                            <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                                $img_id       = get_post_thumbnail_id( $post->ID );
                                $img          = evolt_get_image_by_size( array(
                                    'attach_id'  => $img_id,
                                    'thumb_size' => $img_size,
                                ) );
                                $thumbnail    = $img['thumbnail'];
                                ?>
                                <div class="woocommerce-product-header">
                                    <a class="woocommerce-product-details" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>                                    
                                    <div class="woocommerce-product-meta">
                                        <div class="woocommerce-add-to-cart woocommerce-add-to-cart-grid">
                                        <?php
                                            echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                                sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button ajax_add_to_cart %s product_type_%s">%s</a>',
                                                    esc_url( $product->add_to_cart_url() ),
                                                    esc_attr( $product->get_id() ),
                                                    esc_attr( $product->get_sku() ),
                                                    $product->is_purchasable() ? 'add_to_cart_button' : '',
                                                    esc_attr( $product->get_type() ),
                                                    esc_html( $product->add_to_cart_text() )
                                                ),
                                                $product );
                                            ?>
                                        </div>
                                        <?php if (class_exists('WPCleverWoosc')) { ?>
                                            <div class="woocommerce-compare">
                                                <?php echo do_shortcode('[woosc id="'.esc_attr( $product->get_id() ).'"]'); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if (class_exists('WPCleverWoosw')) { ?>
                                            <div class="woocommerce-wishlist">
                                                <?php echo do_shortcode('[woosw id="'.esc_attr( $product->get_id() ).'"]'); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if (class_exists('WPCleverWoosq')) { ?>
                                            <div class="woocommerce-quick-view">
                                                <?php echo do_shortcode('[woosq id="'.esc_attr( $product->get_id() ).'"]'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="woocommerce-product-content">
                               <h4 class="woocommerce-product--title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                </h4>
                                <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>