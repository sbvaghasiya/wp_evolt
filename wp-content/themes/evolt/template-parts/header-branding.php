<?php
/**
 * Template part for displaying site branding
 */

$default_dark_logo = evolt_get_option( 'default_dark_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
$default_light_logo = evolt_get_option( 'default_light_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-light.png', 'id' => '' ) );
$default_mobile_logo = evolt_get_option( 'default_mobile_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );

$custom_main_header = evolt_get_page_option('custom_main_header');
$page_dark_logo = evolt_get_page_option('page_dark_logo');
$page_light_logo = evolt_get_page_option('page_light_logo');
$page_mobile_logo = evolt_get_page_option('page_mobile_logo');

if($custom_main_header && !empty($page_dark_logo['url'])) {
    $default_dark_logo['url'] = $page_dark_logo['url'];
}

if ($default_dark_logo['url']) {
    printf(
        '<a class="logo-dark" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $default_dark_logo['url'] )
    );
}

if($custom_main_header && !empty($page_light_logo['url'])) {
    $default_light_logo['url'] = $page_light_logo['url'];
}

if ($default_light_logo['url']) {
    printf(
        '<a class="logo-light" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $default_light_logo['url'] )
    );
}

if($custom_main_header && !empty($page_mobile_logo['url'])) {
    $default_mobile_logo['url'] = $page_mobile_logo['url'];
}

if ($default_mobile_logo['url']) {
    printf(
        '<a class="logo-mobile" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $default_mobile_logo['url'] )
    );
}