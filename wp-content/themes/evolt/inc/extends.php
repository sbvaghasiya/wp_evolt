<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package eVolt
 */

/*
 * Get page ID by Slug
*/
function evolt_get_id_by_slug($slug, $post_type){
    $content = get_page_by_path($slug, OBJECT, $post_type);
    $id = $content->ID;
    return $id;
}

/**
 * Get content by slug
 **/
function evolt_get_content_by_slug($slug, $post_type){
    $content = get_posts(
        array(
            'name'      => $slug,
            'post_type' => $post_type
        )
    );
    if(!empty($content))
        return $content[0]->post_content;
    else
        return;
}

/**
 * Show content by slug
 **/
if(!function_exists('evolt_content_by_slug')){
    function evolt_content_by_slug($slug, $post_type){
        $content = evolt_get_content_by_slug($slug, $post_type);

        $id = evolt_get_id_by_slug($slug, $post_type);
        echo apply_filters('the_content',  $content);
    }
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function evolt_body_classes( $classes )
{   
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if (evolt_get_option( 'site_boxed', false )) {
        $classes[] = 'site-boxed';
    }

    if (class_exists('ReduxFramework')) {
        $classes[] = 'redux-page';
    }

    $header_layout = evolt_get_option( 'header_layout', '1' );
    $custom_main_header = evolt_get_page_option( 'custom_main_header', '0' );
    if ( $custom_main_header == '1' ){
        $page_header_layout = evolt_get_page_option('header_layout');
        $header_layout = $page_header_layout;
    }
    if (class_exists('ReduxFramework')) {
        $classes[] = ' site-h'.$header_layout;
    }

    $body_default_font = evolt_get_option( 'body_default_font', 'Barlow' );
    $heading_default_font = evolt_get_option( 'heading_default_font', 'Jost' );

    if($body_default_font == 'Barlow') {
        $classes[] = 'body-default-font';
    }

    if($heading_default_font == 'Jost') {
        $classes[] = 'heading-default-font';
    }

    if (evolt_get_option( 'sticky_on', false )) {
        $classes[] = 'header-sticky';
    }

    $page_404 = evolt_get_option( 'page_404' );
    if(isset($page_404)) {
        $classes[] = ' site-404-'.$page_404;
    }

    $fixed_footer = evolt_get_option('fixed_footer');
    if(isset($fixed_footer) && $fixed_footer) {
        $classes[] = ' fixed-footer';
    }

    return $classes;
}
add_filter( 'body_class', 'evolt_body_classes' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function evolt_pingback_header()
{
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'evolt_pingback_header' );
