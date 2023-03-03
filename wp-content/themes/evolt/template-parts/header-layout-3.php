<?php
/**
 * Template part for displaying default header layout
 */
$sticky_on = evolt_get_option( 'sticky_on', false );
$sticky_header_type = evolt_get_option( 'sticky_header_type', 'scroll-to-bottom' );
$sticky_header_type_page = evolt_get_page_option( 'sticky_header_type_page', 'themeoption' );
if(isset($sticky_header_type_page) && !empty($sticky_header_type_page) && $sticky_header_type_page !== 'themeoption') {
    $sticky_header_type = $sticky_header_type_page;
}
$wishlist_icon = evolt_get_option( 'wishlist_icon', false );
$compare_icon = evolt_get_option( 'compare_icon', false );
$cart_icon = evolt_get_option( 'cart_icon', false );
$h_topbar = evolt_get_option( 'h_topbar', 'show' );
$short_text = evolt_get_option( 'short_text' );
$wellcome = evolt_get_option( 'wellcome' );
$h_phone = evolt_get_option( 'h_phone' );
$h_phone_link = evolt_get_option( 'h_phone_link' );
$h_address = evolt_get_option( 'h_address' );
$h_address_link = evolt_get_option( 'h_address_link' );
$login_text = evolt_get_option( 'login_text' );
$login_link = evolt_get_option( 'login_link' );
$register_text = evolt_get_option( 'register_text' );
$register_link = evolt_get_option( 'register_link' );
$language_switch = evolt_get_option( 'language_switch', false );
$user_icon = evolt_get_option( 'user_icon', false );
$default_mobile_logo = evolt_get_option( 'default_mobile_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout3" data-offset-sticky="100">
        <?php if(!empty($short_text)) : ?>
            <div class="evolt-topbar-shorttext">
                <div class="container">
                    <?php echo wp_kses_post($short_text); ?>
                    <i class="evolt-icon-close"></i>
                </div>
            </div>
        <?php endif; ?>
        <?php if($h_topbar == 'show') : ?>
            <div id="evolt-header-top" class="evolt-header-top3">
                <div class="container">
                    <div class="row">
                    <?php if(!empty($wellcome)) : ?>
                            <div class="evolt-topbar-left">                               
                                <?php if(!empty($h_phone)) : ?>
                                <div class="evolt-topbar-item">
                                    <a href="tel:<?php echo esc_attr($h_phone_link); ?>"><i class="fa fa-phone" aria-hidden="true"></i><?php echo wp_kses_post($h_phone); ?></a>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($h_address)) : ?>
                                    <div class="evolt-topbar-item">
                                        <a href="mailto:<?php echo esc_url($h_address_link); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo wp_kses_post($h_address); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="evolt-topbar-right">
                        <?php if($language_switch) : ?>
                                <?php if(class_exists('SitePress')) { ?>
                                    <div class="site-header-lang">
                                        <?php do_action('wpml_add_language_selector'); ?>
                                    </div>
                                <?php } else { 
                                    wp_enqueue_style('wpml-style', get_template_directory_uri() . '/assets/css/style-lang.css', array(), '1.0.0');
                                    ?>
                                    <div class="site-header-lang custom">
                                        <div class="wpml-ls-statics-shortcode_actions wpml-ls wpml-ls-legacy-dropdown js-wpml-ls-legacy-dropdown">
                                            <ul>
                                                <li tabindex="0" class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-en wpml-ls-current-language wpml-ls-first-item wpml-ls-item-legacy-dropdown">
                                                    <a href="#" class="js-wpml-ls-item-toggle wpml-ls-item-toggle"><img class="wpml-ls-flag" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/flag/en.png'); ?>" alt="en" title="English"><span class="wpml-ls-native"><?php echo esc_html__('English', 'evolt'); ?></span></a>
                                                    <ul class="wpml-ls-sub-menu">
                                                        <li class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-fr">
                                                            <a href="#" class="wpml-ls-link"><img class="wpml-ls-flag" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/flag/fr.png'); ?>" alt="fr" title="France"><span class="wpml-ls-native"><?php echo esc_html__('France', 'evolt'); ?></span></a>
                                                        </li>
                                                        <li class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-de wpml-ls-last-item">
                                                            <a href="#" class="wpml-ls-link"><img class="wpml-ls-flag" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/flag/ru.png'); ?>" alt="ue" title="Russia"><span class="wpml-ls-native"><?php echo esc_html__('Russia', 'evolt'); ?></span></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endif; ?>
                            <?php /* if ( has_nav_menu( 'menu-topbar' ) ) {
                                $attr_menu = array(
                                    'theme_location' => 'menu-topbar',
                                    'container'  => '',
                                    'menu_id'    => 'evolt-menu-topbar',
                                    'menu_class' => 'evolt-menu-topbar2 clearfix',
                                    'link_before'     => '</span><span>',
                                    'link_after'      => '</span>',
                                    'depth'       => '1',
                                    'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                );
                                wp_nav_menu( $attr_menu );
                            }*/ ?>
                            <!-- <div class="evolt-topbar-social">
                                <?php /* evolt_social_header(); */ ?>
                            </div> -->  
                            <?php if(!is_user_logged_in()) : ?>
                                <?php if(!empty($login_text)) { ?>
                                    <a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_attr($login_text); ?></a> 
                                <?php } else { ?>
                                    <a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_html__('Login', 'evolt'); ?></a>
                                <?php } ?>

                                <?php if(!empty($register_text)) { ?>
                                    / <a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_attr($register_text); ?></a>
                                <?php } else { ?>
                                    / <a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_html__('Register', 'evolt'); ?></a>
                                <?php } ?>
                            <?php endif; ?>                         
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
         <div id="evolt-header-middle">
            <div class="container">
                <div class="row">
                    <div class="evolt-header-branding">
                        <div class="evolt-header-branding-inner">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                    <?php evolt_get_product_search_h3(); ?>
                    <div class="evolt-header-right">                       
                        <div class="evolt-header-shop-icons">
                            <?php if($wishlist_icon && class_exists('WPCleverWoosw')) : 
                                $woosw_id = get_option( 'woosw_page_id' );
                                ?>
                                <div class="icon-item">
                                    <a class="evolt-woosw-btn" href="<?php echo esc_url(get_permalink($woosw_id)); ?>"></a>
                                    <i class="caseicon-heart-alt"></i>
                                    <span class="wishlist-count">
                                        <?php echo WPcleverWoosw::get_count(); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php if($compare_icon && class_exists('WPCleverWoosc')) : ?>
                                <div class="icon-item">
                                    <span class="woosc-btn wooscp-btn"></span>
                                    <i class="caseicon-random"></i>
                                </div>
                            <?php endif; ?>
                            <?php if(class_exists('Woocommerce') && $cart_icon) : ?>
                                <div class="icon-item h-btn-cart">
                                    <i class="caseicon-shopping-cart-alt"></i>
                                    <span class="widget_cart_counter"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="evolt-header-user">
                            <?php if(is_user_logged_in()) : ?>
                                <div class="h-btn-icon-user h-btn-user">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                    <ul class="evolt-user-account">
                                        <?php if(class_exists('WooCommerce') ) :
                                            $my_ac = get_option( 'woocommerce_myaccount_page_id' ); 
                                            ?>
                                            <li><a href="<?php echo esc_url(get_permalink($my_ac)); ?>"><?php echo esc_html__('My Account', 'evolt'); ?></a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo esc_url(wp_logout_url()); ?>"><?php echo esc_html__('Log Out', 'evolt'); ?></a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="evolt-header" class="evolt-header-main">
            <div class="container">
                <div class="row">
                    <div class="evolt-header-branding">
                        <div class="evolt-header-branding-inner">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                    <div class="evolt-header-navigation">
                        <?php if ( has_nav_menu( 'menu-shop' ) ) { ?>
                            <div class="evolt-menu-shop">
                                <?php $attr_menu = array(
                                    'theme_location' => 'menu-shop',
                                    'container'  => '',
                                    'menu_id'    => 'evolt-menu-shop',
                                    'menu_class' => 'evolt-main-menu children-arrow evolt-menu-shop clearfix',
                                    'link_before'     => '<span class="evolt-icon-menu-lg"><i></i></span><span>',
                                    'link_after'      => '</span>',
                                    'depth'       => '3',
                                    'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                );
                                wp_nav_menu( $attr_menu ); ?>
                            </div>
                        <?php } ?>
                        <nav class="evolt-main-navigation">
                            <div class="evolt-main-navigation-inner">
                                <?php if ($default_mobile_logo['url']) { ?>
                                    <div class="evolt-logo-mobile">
                                        <a href="<?php esc_url( esc_url( home_url( '/' ) ) ); ?>" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo esc_url( $default_mobile_logo['url'] ); ?>" alt="<?php esc_attr( get_bloginfo( 'name' ) ); ?>"/></a>
                                    </div>
                                <?php } ?>
                                <?php evolt_header_mobile_search(); ?>
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                                <?php if ( has_nav_menu( 'secondary' ) ) {
                                    $attr_menu = array(
                                        'theme_location' => 'secondary',
                                        'menu_class' => 'evolt-menu-secondary clearfix',
                                        'depth'       => '1',
                                        'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                    );
                                    wp_nav_menu( $attr_menu );
                                } ?>
                            </div>
                        </nav>
                    </div>
                    <div class="evolt-menu-overlay"></div>
                </div>
            </div>
            <div id="evolt-menu-mobile">
                <?php if(function_exists('up_get_template_part') && $user_icon) : ?>
                    <div class="evolt-mobile-meta-item h-btn-user">
                        <i class="flaticon-user"></i>
                        <?php if(is_user_logged_in()) : ?>
                                <ul class="evolt-user-account">
                                <?php if(class_exists('WooCommerce') ) :
                                    $my_ac = get_option( 'woocommerce_myaccount_page_id' ); 
                                    ?>
                                    <li><a href="<?php echo esc_url(get_permalink($my_ac)); ?>"><?php echo esc_html__('My Account', 'evolt'); ?></a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo esc_url(wp_logout_url()); ?>"><?php echo esc_html__('Log Out', 'evolt'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if(class_exists('Woocommerce') && $cart_icon) : ?>
                    <div class="evolt-mobile-meta-item btn-nav-cart">
                        <i class="caseicon-shopping-cart-alt"></i>
                    </div>
                <?php endif; ?>
                <div class="evolt-mobile-meta-item btn-nav-mobile open-menu">
                    <span></span>
                </div>
            </div>
        </div>

    </div>
</header>