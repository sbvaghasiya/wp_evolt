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
$default_mobile_logo = evolt_get_option( 'default_mobile_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout9 <?php if($sticky_on == 1) { echo 'is-sticky '; echo esc_attr($sticky_header_type); } ?>" data-offset-sticky="140">
        <div id="evolt-header-middle" class="evolt-hidden-lg">
            <div class="container">
                <div class="row">
                    <div class="evolt-header-branding">
                        <div class="evolt-header-branding-inner">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="evolt-header" class="evolt-header-main">
            <div class="container">
                <div class="row">
                    <?php if ( has_nav_menu( 'menu-shop' ) ) { ?>
                        <div class="evolt-menu-shop evolt-hidden-lg">
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
                    <div class="evolt-header-branding evolt-hidden-xl">
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
                    <div class="evolt-header-shop-icons evolt-hidden-lg">
                        <?php if($wishlist_icon && class_exists('WPCleverWoosw')) : 
                            $woosw_id = get_option( 'woosw_page_id' );
                            ?>
                            <div class="icon-item h-btn-wishlist">
                                <a class="evolt-woosw-btn" href="<?php echo esc_url(get_permalink($woosw_id)); ?>"></a>
                                <i class="flaticon-wishlist"></i>
                                <span class="wishlist-count">
                                    <?php echo WPcleverWoosw::get_count(); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if(class_exists('Woocommerce') && $cart_icon) : ?>
                            <div class="icon-item h-btn-cart">
                                <i class="flaticon-add-to-cart"></i>
                                <span class="widget_cart_counter"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if(function_exists('up_get_template_part') && $user_icon) : ?>
                            <div class="icon-item h-btn-user">
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