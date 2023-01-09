<?php

$html_id = evolt_get_element_id($settings);
$source = $widget->get_setting('source', '');
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
$post_ids = $widget->get_setting('post_ids', '');
extract(evolt_get_posts_of_grid('portfolio', [
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

$img_size = $widget->get_setting('img_size', '');
$show_title = $widget->get_setting('show_title', '');
$show_category = $widget->get_setting('show_category', '');
$show_button = $widget->get_setting('show_button', '');
$button_text = $widget->get_setting('button_text', '');

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
    'data-colxs' => $col_xs,
    'data-colsm' => $col_sm,
    'data-colmd' => $col_md,
    'data-collg' => $col_lg,
    'data-colxl' => $col_xl,
    'data-dir' => $carousel_dir,
    'data-slidesToScroll' => $slides_to_scroll,
] );
?>
<?php if (is_array($posts)): ?>

<div id="<?php echo esc_attr($html_id) ?>" class="evolt-portfolio-carousel1 evolt-slick-slider evolt-arrow-middle">
    <div <?php evolt_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
        <div <?php evolt_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
        <?php
            $default_size = '435x500'; 
            if(!empty($img_size)) {
                $default_size = $img_size;
            }
            foreach ($posts as $post): 
            $img_id = get_post_thumbnail_id($post->ID);
            $img = evolt_get_image_by_size( array(
                'attach_id'  => $img_id,
                'thumb_size' => $default_size,
            ));
            $thumbnail = $img['thumbnail'];
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): ?>
                <div class="carousel-item slick-slide">
                    <div class="grid-item-inner <?php echo esc_attr($settings['evolt_animate']); ?>">
                        <div class="item--featured">
                            <?php echo evolt_print_html($thumbnail); ?>
                        </div>
                        
                        <div class="item--holder">
                            <div class="item--meta">
                                <?php if($show_title == 'true'): ?>
                                    <h3 class="item--title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
                                <?php endif; ?>
                                <?php if($show_category == 'true'): ?>
                                    <div class="item--category">
                                        <?php the_terms( $post->ID, 'portfolio-category', '', ' ' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if($show_button == 'true') : ?>
                                <div class="item--readmore">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>