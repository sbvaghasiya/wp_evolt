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
$user_icon = evolt_get_option( 'user_icon', false );
$wishlist_icon = evolt_get_option( 'wishlist_icon', false );
$cart_icon = evolt_get_option( 'cart_icon', false );
$h_phone_label = evolt_get_option( 'h_phone_label' );
$h_phone = evolt_get_option( 'h_phone' );
$h_phone_link = evolt_get_option( 'h_phone_link' );
$login_text = evolt_get_option( 'login_text' );
$login_link = evolt_get_option( 'login_link' );
$register_text = evolt_get_option( 'register_text' );
$register_link = evolt_get_option( 'register_link' );
$default_mobile_logo = evolt_get_option( 'default_mobile_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout8 <?php if($sticky_on == 1) { echo 'is-sticky '; echo esc_attr($sticky_header_type); } ?>" data-offset-sticky="140">
        <div id="evolt-header" class="evolt-header-main">
            <div class="container">
                <div class="row">
                    <div class="evolt-header-branding">
                        <div class="evolt-header-branding-inner">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                    <div class="evolt-header-navigation">
                        <nav class="evolt-main-navigation">
                            <div class="evolt-main-navigation-inner">
                                <?php if ($default_mobile_logo['url']) { ?>
                                    <div class="evolt-logo-mobile">
                                        <a href="<?php esc_url( esc_url( home_url( '/' ) ) ); ?>" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo esc_url( $default_mobile_logo['url'] ); ?>" alt="<?php esc_attr( get_bloginfo( 'name' ) ); ?>"/></a>
                                    </div>
                                <?php } ?>
                                <?php evolt_header_mobile_search(); ?>
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                            </div>
                        </nav>
                    </div>
                    <?php if(!empty($h_phone_label) || !empty($h_phone_link) || !empty($h_phone)) : ?>
                        <div class="evolt-header-phone evolt-hidden-lg">
                            <div class="evolt-header-phone-icon">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <div class="evolt-header-phone-meta">
                                <a href="tel:<?php echo esc_attr($h_phone_link); ?>"><?php echo esc_attr($h_phone); ?></a>
                                <label><?php echo esc_attr($h_phone_label); ?></label>
                            </div>
                        </div>
                    <?php endif; ?>
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
        <div class="evolt-header-bottom evolt-hidden-lg">
            <div class="evolt-header-bottom-inner">
                <div class="evolt-topbar-social">
                    <?php  evolt_social_header(); ?>
                </div>
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
                <?php evolt_get_product_search_h8(); ?>
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
                    <?php if(class_exists('Woocommerce') && $cart_icon) : ?>
                        <div class="icon-item h-btn-cart">
                        <i class="caseicon-shopping-cart-alt"></i>
                            <span class="widget_cart_counter"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class=" icon-item evolt-header-user">
                        <?php if(!is_user_logged_in()) : ?>
                            <div class="h-btn-icon-user h-btn-user">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                            <ul class="evolt-user-account">
                                <?php if(!empty($login_text)) { ?>
                                    <li><a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_attr($login_text); ?></a></li> 
                                <?php } else { ?>
                                    <li><a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_html__('Login', 'evolt'); ?></a></li>
                                <?php } ?>

                                <?php if(!empty($register_text)) { ?>
                                     <li><a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_attr($register_text); ?></a></li>
                                <?php } else { ?>
                                     <li><a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_html__('Register', 'evolt'); ?></a></li>
                                <?php } ?>
                            </ul>
                            </div>
                        <?php endif; ?>

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
</header>