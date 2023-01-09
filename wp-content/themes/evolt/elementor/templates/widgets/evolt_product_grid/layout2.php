<?php
if(class_exists('Woocommerce')) {
    $html_id = evolt_get_element_id($settings);
    $tax = array();
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
    ], array('product_cat') ));


    $filter_default_title = $widget->get_setting('filter_default_title', 'All');
    $col_xl = 12 / intval($widget->get_setting('col_xl', 4));
    $col_lg = 12 / intval($widget->get_setting('col_lg', 4));
    $col_md = 12 / intval($widget->get_setting('col_md', 3));
    $col_sm = 12 / intval($widget->get_setting('col_sm', 2));
    $col_xs = 12 / intval($widget->get_setting('col_xs', 1));
    $grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
    $gap = intval($widget->get_setting('gap', 30));
    $gap_item = intval($gap / 2);
    $grid_class = '';
    $layout_type = $widget->get_setting('layout_type', 'masonry');
    if ($layout_type == 'masonry') {
        $grid_class = 'evolt-grid-inner evolt-grid-masonry row';
    } else {
        $grid_class = 'evolt-grid-inner row';
    }
    $filter = $widget->get_setting('filter', 'false');
    $filter_alignment = $widget->get_setting('filter_alignment', 'center');
    $pagination_type = $widget->get_setting('pagination_type', 'pagination');
    $evolt_animate = $widget->get_setting('evolt_animate');
    $img_size = $widget->get_setting('img_size');
    $grid_masonry = $widget->get_setting('grid_masonry');
    $load_more = array(
        'posttype' => 'product',
        'startPage' => $paged,
        'maxPages'  => $max,
        'total'     => $total,
        'perpage'   => $limit,
        'nextLink'  => $next_link,
        'source' => $source,
        'orderby' => $orderby,
        'order' => $order,
        'limit' => $limit,
        'post_ids' => $post_ids,
        'col_xl'    => $col_xl,
        'col_lg'    => $col_lg,
        'col_md'    => $col_md,
        'col_sm'    => $col_sm,
        'col_xs'    => $col_xs,
        'pagination_type' => $pagination_type,
        'img_size' => $img_size,
        'grid_masonry' => $grid_masonry,
        'evolt_animate' => $evolt_animate,
        'template_type' => 'product_grid_layout2',
    );
    ?>

    <div id="<?php echo esc_attr($html_id) ?>" class="evolt-grid evolt-product-grid  woocommerce-product-meta-grid evolt-product-grid-layout2 woocommerce" data-layout="<?php echo esc_attr($layout_type); ?>" data-start-page="<?php echo esc_attr($paged); ?>" data-max-pages="<?php echo esc_attr($max); ?>" data-total="<?php echo esc_attr($total); ?>" data-perpage="<?php echo esc_attr($limit); ?>" data-next-link="<?php echo esc_attr($next_link); ?>">
        <div class="evolt-grid-overlay"></div>
        <?php if ($filter == "true" and $layout_type == 'masonry'): ?>
            <div class="grid-filter-wrap <?php echo esc_attr($settings['filter_style']); ?> align-<?php echo esc_attr($filter_alignment); ?>">
                <span class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
                <?php foreach ($categories as $category): ?>
                    <?php $category_arr = explode('|', $category); ?>
                    <?php $tax[] = $category_arr[1]; ?>
                    <?php $term = get_term_by('slug',$category_arr[0], $category_arr[1]); ?>

                    <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                        <?php echo esc_html($term->name); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="<?php echo esc_attr($grid_class); ?> animate-time" data-gutter="<?php echo esc_attr($gap_item); ?>">
            <?php
            $load_more['tax'] = $tax;
            evolt_get_post_grid($posts, $load_more);
            ?>
            <?php if ($layout_type == 'masonry') : ?>
                <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
            <?php endif; ?>
        </div>
        <?php if ($layout_type == 'masonry' && $pagination_type == 'pagination') { ?>
            <div class="evolt-grid-pagination" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-query="<?php echo esc_attr(json_encode($args)); ?>">
                <?php evolt_posts_pagination($query, true); ?>
            </div>
        <?php } ?>
        <?php if (!empty($next_link) && $layout_type == 'masonry' && $pagination_type == 'loadmore') { ?>
            <div class="evolt-load-more text-center" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>">
                <span class="btn btn-animate">
                    <i class="caseicon-refresh-arrow"></i>
                    <?php echo esc_html__('Load more', 'evolt') ?>
                </span>
            </div>
        <?php } ?>
    </div>
<?php } ?>