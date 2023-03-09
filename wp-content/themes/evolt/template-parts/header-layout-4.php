<?php

/**
 * Template part for displaying default header layout
 */
$sticky_on = evolt_get_option('sticky_on', false);
$sticky_header_type = evolt_get_option('sticky_header_type', 'scroll-to-bottom');
$sticky_header_type_page = evolt_get_page_option('sticky_header_type_page', 'themeoption');
if (isset($sticky_header_type_page) && !empty($sticky_header_type_page) && $sticky_header_type_page !== 'themeoption') {
    $sticky_header_type = $sticky_header_type_page;
}
$cart_icon = evolt_get_option('cart_icon', false);
$h_topbar = evolt_get_option('h_topbar', 'show');
$wellcome = evolt_get_option('wellcome');
$h_phone_label = evolt_get_option('h_phone_label');
$h_phone = evolt_get_option('h_phone');
$language_switch = evolt_get_option('language_switch', false);
$h_phone_link = evolt_get_option('h_phone_link');
$login_text = evolt_get_option( 'login_text' );
$login_link = evolt_get_option( 'login_link' );
$register_text = evolt_get_option( 'register_text' );
$register_link = evolt_get_option( 'register_link' );
$h_address = evolt_get_option( 'h_address' );
$h_address_link = evolt_get_option( 'h_address_link' );
$default_mobile_logo = evolt_get_option('default_mobile_logo', array('url' => get_template_directory_uri() . '/assets/images/logo-dark.png', 'id' => ''));
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout4 evolt-header-layout2 fixed-height 
    <?php if ($sticky_on == 1) {
            echo 'is-sticky ';
            echo esc_attr($sticky_header_type);
        } ?>" data-offset-sticky="100">
    <?php if ($h_topbar == 'show') : ?>
            <div id="evolt-header-top" class="evolt-header-top2">
                <div class="container">
                    <div class="row">
                        <?php /* if (!empty($wellcome)) : ?>
                            <div class="evolt-topbar-wellcome">
                                <?php echo wp_kses_post($wellcome); ?>
                            </div>
                        <?php endif; */ ?>
                        <div class="details_top_header">
                            <?php if(!empty($h_address)) : ?>
                                <div class="evolt-topbar-item">
                                    <a href="mailto:<?php echo esc_url($h_address_link); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo wp_kses_post($h_address); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="evolt-topbar-right">
                            <?php if ($language_switch) : ?>
                                <?php if (class_exists('SitePress')) { ?>
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
                            <?php /* if (has_nav_menu('menu-topbar')) {
                                $attr_menu = array(
                                    'theme_location' => 'menu-topbar',
                                    'container'  => '',
                                    'menu_id'    => 'evolt-menu-topbar',
                                    'menu_class' => 'evolt-main-menu children-arrow evolt-menu-topbar clearfix',
                                    'link_before'     => '</span><span>',
                                    'link_after'      => '</span>',
                                    'depth'       => '1',
                                    'walker'         => class_exists('EFramework_Mega_Menu_Walker') ? new EFramework_Mega_Menu_Walker : '',
                                );
                                wp_nav_menu($attr_menu);
                            } */ ?>
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
                            <?php get_template_part('template-parts/header-branding'); ?>
                        </div>
                    </div>
                    <?php evolt_get_product_search(); ?>
                    <div class="evolt-header-right">
                        <div class="evolt-header-shop-icons">
                            <div class="icon-item">
                                <a class="evolt-woosw-btn" href="http://localhost/wp_evolt/wishlist/"></a>
                                <i class="caseicon-heart-alt"></i>
                                <span class="wishlist-count"><?php echo WPcleverWoosw::get_count(); ?></span>
                            </div>                        
                            <div class="icon-item h-btn-cart">
                                <i class="caseicon-shopping-cart-alt"></i>
                                <span class="widget_cart_counter">2</span>
                            </div>
                        </div>
                        <div class="icon-item evolt-header-user">
                            <?php if(!is_user_logged_in()) : ?>
                                <div class="h-btn-icon-user h-btn-user">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <ul class="evolt-user-account register_box">
                                    <?php if(!empty($login_text)) { ?>
                                        <li><a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_attr($login_text); ?></a></li> 
                                    <?php } else { ?>
                                        <li><a href="<?php echo esc_url(get_permalink($login_link)); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i><?php echo esc_html__('Login', 'evolt'); ?></a></li>
                                    <?php } ?>

                                    <?php if(!empty($register_text)) { ?>
                                        <li><a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_attr($register_text); ?></a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo esc_url(get_permalink($register_link)); ?>"><i class="fa fa-user-plus" aria-hidden="true"></i><?php echo esc_html__('Register', 'evolt'); ?></a></li>
                                    <?php } ?>
                                </ul>
                                </div>
                            <?php endif; ?>

                            <?php if(is_user_logged_in()) : ?>
                                <div class="h-btn-icon-user h-btn-user">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                    <ul class="evolt-user-account">
                                        <?php global $current_user; ?>
                                        <li><span><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo "Hi! ".$current_user->first_name." ".$current_user->last_name; ?></span></li>
                                        <?php if(class_exists('WooCommerce') ) :
                                            $my_ac = get_option( 'woocommerce_myaccount_page_id' ); 
                                            ?>
                                            <li><a href="<?php echo esc_url(get_permalink($my_ac)); ?>"><i class="flaticon-user"></i><?php echo esc_html__('My Account', 'evolt'); ?></a></li>
                                        <?php endif; ?>
                                        <li><a href="javascript:;"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Order</a></li>
                                        <li><a href="<?php echo esc_url(wp_logout_url()); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo esc_html__('Log Out', 'evolt'); ?></a></li>
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
                            <?php get_template_part('template-parts/header-branding'); ?>
                        </div>
                    </div>
                    <div class="evolt-header-navigation">
                        <div class="evolt-menu-shop">
                            <?php if (has_nav_menu('menu-shop')) {
                                $attr_menu = array(
                                    'theme_location' => 'menu-shop',
                                    'container'  => '',
                                    'menu_id'    => 'evolt-menu-shop',
                                    'menu_class' => 'evolt-main-menu children-arrow evolt-menu-shop clearfix',
                                    'link_before'     => '<span class="evolt-icon-menu"><i></i></span><span>',
                                    'link_after'      => '</span>',
                                    'depth'       => '3',
                                    'walker'         => class_exists('EFramework_Mega_Menu_Walker') ? new EFramework_Mega_Menu_Walker : '',
                                );
                                wp_nav_menu($attr_menu);
                            } ?>
                        </div>
                        <nav class="evolt-main-navigation">
                            <div class="evolt-main-navigation-inner">
                                <?php if ($default_mobile_logo['url']) { ?>
                                    <div class="evolt-logo-mobile">
                                        <a href="<?php esc_url(esc_url(home_url('/'))); ?>" title="<?php esc_attr(get_bloginfo('name')); ?>" rel="home"><img src="<?php echo esc_url($default_mobile_logo['url']); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" /></a>
                                    </div>
                                <?php } ?>
                                <?php evolt_header_mobile_search(); ?>
                                <?php get_template_part('template-parts/header-menu'); ?>
                            </div>
                        </nav>
                        <?php if (class_exists('Woocommerce') && $cart_icon) : ?>
                            <div class="header-right-item h-btn-cart">
                                <i class="caseicon-shopping-cart"></i>
                                <?php echo esc_html__('Cart', 'evolt') . ':'; ?>
                                <span class="widget_cart_counter_header"><?php echo sprintf(_n('%d', '%d', WC()->cart->cart_contents_count, 'evolt'), WC()->cart->cart_contents_count); ?> - <span class="cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></span></span>
                            </div>
                        <?php endif; ?>
                        <div class="evolt-header-right">
                            <?php if (!empty($h_phone_label) || !empty($h_phone_link) || !empty($h_phone)) : ?>
                                <div class="evolt-header-phone">
                                    <div class="evolt-header-phone-meta">
                                        <a href="tel:<?php echo esc_attr($h_phone_link); ?>"><?php echo esc_attr($h_phone); ?></a>
                                        <label><?php echo esc_attr($h_phone_label); ?></label>
                                    </div>
                                    <div class="evolt-header-phone-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6.22587 15.1997C8.14879 17.4896 10.4636 19.2926 13.1056 20.5683C14.1115 21.0432 15.4567 21.6067 16.9555 21.7032C17.0484 21.7073 17.1372 21.7113 17.2302 21.7113C18.2361 21.7113 19.044 21.3652 19.7025 20.6528C19.7065 20.6488 19.7146 20.6408 19.7186 20.6327C19.9529 20.351 20.2196 20.0975 20.4983 19.8278C20.6882 19.6467 20.8821 19.4576 21.0679 19.2644C21.9284 18.371 21.9284 17.236 21.0598 16.3708L18.6319 13.9521C18.2199 13.5255 17.727 13.3001 17.21 13.3001C16.6929 13.3001 16.196 13.5255 15.7718 13.948L14.3256 15.3888C14.1923 15.3123 14.0549 15.2439 13.9256 15.1795C13.764 15.099 13.6146 15.0226 13.4813 14.9381C12.1643 14.105 10.9685 13.0184 9.82529 11.6219C9.2476 10.8934 8.85979 10.2817 8.58912 9.65792C8.96886 9.31584 9.32436 8.95766 9.66774 8.60752C9.78893 8.48276 9.91416 8.35801 10.0394 8.23325C10.4757 7.7986 10.71 7.29554 10.71 6.78443C10.71 6.27332 10.4797 5.77025 10.0394 5.33561L8.83555 4.13631C8.69416 3.99545 8.56084 3.85862 8.42349 3.71776C8.15687 3.44409 7.87812 3.16238 7.60342 2.90884C7.18733 2.50236 6.69852 2.28906 6.18143 2.28906C5.66838 2.28906 5.17553 2.50236 4.74328 2.91286L3.23241 4.41802C2.683 4.96535 2.37194 5.6294 2.3073 6.39807C2.23055 7.35993 2.4083 8.38215 2.86883 9.61767C3.57579 11.5293 4.64228 13.3041 6.22587 15.1997ZM3.293 6.48259C3.34148 5.94733 3.54751 5.50061 3.93533 5.11426L5.43811 3.61715C5.67242 3.39177 5.93096 3.27506 6.18143 3.27506C6.42785 3.27506 6.67832 3.39177 6.90858 3.6252C7.17925 3.87471 7.43375 4.13631 7.70846 4.414C7.84581 4.55485 7.9872 4.69571 8.12859 4.84059L9.33244 6.03989C9.5829 6.28941 9.71217 6.54296 9.71217 6.79248C9.71217 7.04199 9.5829 7.29554 9.33244 7.54506C9.2072 7.66982 9.08197 7.7986 8.95674 7.92336C8.58104 8.30166 8.22958 8.65984 7.84177 9.00192C7.83369 9.00997 7.82965 9.014 7.82157 9.02205C7.48627 9.35608 7.53879 9.67402 7.61958 9.91549C7.62362 9.92756 7.62766 9.93561 7.6317 9.94768C7.94276 10.6922 8.37501 11.4005 9.04965 12.2457C10.2616 13.7347 11.5381 14.8898 12.944 15.7792C13.1177 15.8919 13.3035 15.9804 13.4772 16.0689C13.6388 16.1494 13.7883 16.2259 13.9216 16.3104C13.9378 16.3185 13.9499 16.3265 13.966 16.3346C14.0993 16.403 14.2286 16.4352 14.3579 16.4352C14.6811 16.4352 14.8911 16.2299 14.9598 16.1615L16.4707 14.6563C16.705 14.4229 16.9595 14.2982 17.21 14.2982C17.517 14.2982 17.7674 14.4873 17.925 14.6563L20.361 17.0791C20.8457 17.562 20.8417 18.0852 20.3488 18.5963C20.1792 18.7774 20.0014 18.9505 19.8116 19.1316C19.5288 19.4053 19.2339 19.687 18.9672 20.0049C18.5027 20.5039 17.9492 20.7374 17.2342 20.7374C17.1655 20.7374 17.0928 20.7333 17.0241 20.7293C15.6991 20.6448 14.467 20.1297 13.5419 19.691C11.0291 18.4796 8.82343 16.7612 6.99342 14.5799C5.48659 12.7729 4.47261 11.0906 3.80201 9.28766C3.38592 8.18093 3.22837 7.29151 3.293 6.48259Z" fill="#333333" stroke="#333333" stroke-width="0.2"/>
                                        </svg>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="evolt-menu-overlay"></div>
                </div>
            </div>
            <div id="evolt-menu-mobile">
                <?php if (class_exists('Woocommerce') && $cart_icon) : ?>
                    <div class="evolt-mobile-meta-item btn-nav-cart">
                        <i class="caseicon-shopping-cart"></i>
                    </div>
                <?php endif; ?>
                <div class="evolt-mobile-meta-item btn-nav-mobile open-menu">
                    <span></span>
                </div>
            </div>
        </div>

    </div>
</header>