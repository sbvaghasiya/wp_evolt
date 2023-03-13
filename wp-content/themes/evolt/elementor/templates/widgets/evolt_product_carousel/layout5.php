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
    $img_size = '600x500';
}?>
<?php if (is_array($posts)): ?>

<div class="evolt-slick-filter-wrap">
    <?php if($settings['filter'] == 'true') : ?>
        <div class="evolt-slick-filter">
            <span id="filter-all" class="filter-item active"><?php echo esc_attr($settings['filter_default_title']); ?></span>
            <?php foreach ($categories as $category): ?>
                <?php $category_arr = explode('|', $category); ?>
                <?php $tax[] = $category_arr[1]; ?>
                <?php $term = get_term_by('slug',$category_arr[0], $category_arr[1]); ?>
                <span id="filter-<?php echo esc_attr($term->slug); ?>" class="filter-item">
                    <?php echo esc_html($term->name); ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div id="<?php echo esc_attr($html_id) ?>" class="evolt-product-carousel5 evolt-dots-style3 evolt-slick-slider evolt-arrow-middle woocommerce <?php echo esc_attr($settings['style_l5']); ?>">
        <div <?php evolt_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php evolt_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>

            <?php
                foreach ($posts as $post):
                if($settings['filter'] == 'true') {
                    $filter_class = evolt_get_term_of_slick_filter($post->ID, array_unique($tax));
                }
                $line_color = get_post_meta($post->ID, 'line_color', true);
                if(class_exists('Woocommerce')) {
                    $product = wc_get_product( $post->ID );
                    $average = $product->get_average_rating(); ?>
                    <div class="carousel-item slick-slide <?php if($settings['filter'] == 'true') { echo esc_attr('evolt-slick-filter-all '.$filter_class); } ?>">
                        <div class="grid-item-inner <?php echo esc_attr($settings['evolt_animate']); ?>">
                            <div class="woocommerce-product-inner">
                                <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                                    $img_id       = get_post_thumbnail_id( $post->ID );
                                    $img          = evolt_get_image_by_size( array(
                                        'attach_id'  => $img_id,
                                        'thumb_size' => $img_size,
                                    ) );
                                    $thumbnail    = $img['thumbnail'];
                                    ?>
                                    <div class="woocommerce-product-header" <?php if(!empty($line_color['rgba']) && $settings['style_l5'] == 'style2') : ?>style="background-color: <?php echo esc_attr($line_color['rgba']); ?>"<?php endif; ?>>
                                        <a class="woocommerce-product-details" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                                        <div class="woocommerce-product-meta">
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
                                   <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="woocommerce-product--title">
                                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                        </h4>
                                        <div class="woocommerce-product-average">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 406.125 406.125" style="enable-background:new 0 0 406.125 406.125;" xml:space="preserve">
                                            <path d="M260.133,155.967c-4.487,0-9.25-3.463-10.64-7.73L205.574,13.075c-1.39-4.268-3.633-4.268-5.023,0
                                                L156.64,148.237c-1.39,4.268-6.153,7.73-10.64,7.73H3.88c-4.487,0-5.186,2.138-1.553,4.78l114.971,83.521
                                                c3.633,2.642,5.454,8.242,4.064,12.51L77.452,391.932c-1.39,4.268,0.431,5.592,4.064,2.951l114.971-83.521
                                                c3.633-2.642,9.519-2.642,13.152,0l114.971,83.529c3.633,2.642,5.454,1.317,4.064-2.951l-43.911-135.154
                                                c-1.39-4.268,0.431-9.868,4.064-12.51l114.971-83.521c3.633-2.642,2.934-4.78-1.553-4.78H260.133V155.967z"/>
                                            </svg>

                                            <?php echo esc_attr($average); ?>
                                        </div>
                                   </div>
                                    <div class="woocommerce-product--flex">
                                        <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                                        <!-- <div class="woocommerce-product--rating">
                                            <?php /* 
                                                $rating  = $product->get_average_rating();
                                                $count   = $product->get_rating_count();
                                                echo wc_get_rating_html( $rating, $count ); */
                                            ?>
                                        </div> -->
                                    </div>
                                    <div class="woocommerce-add-to--cart">
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
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>