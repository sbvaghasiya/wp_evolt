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

$h_topbar = evolt_get_option( 'h_topbar', 'show' );
$wellcome = evolt_get_option( 'wellcome' );
$login_text = evolt_get_option( 'login_text' );
$login_link = evolt_get_option( 'login_link' );
$register_text = evolt_get_option( 'register_text' );
$register_link = evolt_get_option( 'register_link' );

$user_icon = evolt_get_option( 'user_icon', false );

$cart_icon = evolt_get_option( 'cart_icon', false );
$search_icon = evolt_get_option( 'search_icon', false );
$wishlist_icon = evolt_get_option( 'wishlist_icon', false );

$default_mobile_logo = evolt_get_option( 'default_mobile_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout5 evolt-header-custom-layout6 <?php if($sticky_on == 1) { echo 'is-sticky '; echo esc_attr($sticky_header_type); } ?>" data-offset-sticky="100">
        <?php if($h_topbar == 'show') : ?>
            <div id="evolt-header-top" class="evolt-header-top4">
                <div class="container">
                    <div class="row">
                        <?php if(!empty($wellcome)) : ?>
                            <div class="evolt-topbar-left">
                                <?php if(!empty($wellcome)) : ?>
                                    <div class="evolt-topbar-item">
                                        <?php echo wp_kses_post($wellcome); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="evolt-topbar-social">
                            <?php evolt_social_header(); ?>
                        </div>
                        <?php if(!empty($login_text) || !empty($register_text)) : ?>
                            <div class="evolt-topbar-right evolt-topbar-user">
                                <?php if(!is_user_logged_in()) : ?>
                                    <?php if(!empty($login_text)) { ?>
                                        <a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_attr($login_text); ?></a> 
                                    <?php } else { ?>
                                        <a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_html__('Login', 'evolt'); ?></a>
                                    <?php } ?>

                                    <?php if(!empty($register_text)) { ?>
                                        <a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_attr($register_text); ?></a>
                                    <?php } else { ?>
                                        <a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_html__('Register', 'evolt'); ?></a>
                                    <?php } ?>
                                <?php endif; ?>

                                <?php if(is_user_logged_in()) : ?>
                                    <div class="h-btn-icon-user h-btn-user">
                                        <i class="flaticon-user"></i>
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
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                            </div>
                        </nav>
                        <div class="evolt-header-right">
                            <div class="evolt-header-icons">
                                <?php if($wishlist_icon && class_exists('WPCleverWoosw')) : 
                                    $woosw_id = get_option( 'woosw_page_id' );
                                    ?>
                                    <div class="icon-item">
                                        <a class="evolt-woosw-btn" href="<?php echo esc_url(get_permalink($woosw_id)); ?>">
                                            <i class="flaticon-love"></i>
                                            <span class="wishlist-count">
                                                <?php echo WPcleverWoosw::get_count(); ?>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(class_exists('Woocommerce') && $cart_icon) : ?>
                                    <div class="icon-item h-btn-cart">
                                        <i class="flaticon-cart-1"></i>
                                        <span class="widget_cart_counter"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($search_icon) : ?>
                                    <div class="icon-item h-btn-search"><i class="flaticon-search"></i></div>
                                <?php endif; ?>
                            </div>
                        </div>
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