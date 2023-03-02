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
$default_mobile_logo = evolt_get_option('default_mobile_logo', array('url' => get_template_directory_uri() . '/assets/images/logo-dark.png', 'id' => ''));
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout2 fixed-height 
    <?php if ($sticky_on == 1) {
            echo 'is-sticky ';
            echo esc_attr($sticky_header_type);
        } ?>" data-offset-sticky="100">
    <?php if ($h_topbar == 'show') : ?>
            <div id="evolt-header-top" class="evolt-header-top2">
                <div class="container">
                    <div class="row">
                        <?php if (!empty($wellcome)) : ?>
                            <div class="evolt-topbar-wellcome">
                                <?php echo wp_kses_post($wellcome); ?>
                            </div>
                        <?php endif; ?>
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
                            <?php if(!is_user_logged_in()) : ?>
                                    <?php if(!empty($login_text)) { ?>
                                        <a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_attr($login_text); ?></a> 
                                    <?php } else { ?>
                                        <a href="<?php echo esc_url(get_permalink($login_link)); ?>"><?php echo esc_html__('Sign In', 'evolt'); ?></a>
                                    <?php } ?>

                                    <?php if(!empty($register_text)) { ?>
                                        / <a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_attr($register_text); ?></a>
                                    <?php } else { ?>
                                        / <a href="<?php echo esc_url(get_permalink($register_link)); ?>"><?php echo esc_html__('Sign Up', 'evolt'); ?></a>
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
                            <?php get_template_part('template-parts/header-branding'); ?>
                        </div>
                    </div>
                    <?php evolt_get_product_search(); ?>
                    <?php if (!empty($h_phone_label) || !empty($h_phone_link) || !empty($h_phone)) : ?>
                        <div class="evolt-header-phone">
                            <div class="evolt-header-phone-icon">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <g>
                                        <path d="M256,0C131.935,0,31,100.935,31,225c0,13.749,0,120.108,0,122c0,24.813,20.187,45,45,45h17.58
                                            c6.192,17.458,22.865,30,42.42,30c24.813,0,45-20.187,45-45V255c0-24.813-20.187-45-45-45c-19.555,0-36.228,12.542-42.42,30H76
                                            c-5.259,0-10.305,0.915-15,2.58V225c0-107.523,87.477-195,195-195s195,87.477,195,195v17.58c-4.695-1.665-9.741-2.58-15-2.58
                                            h-17.58c-6.192-17.458-22.865-30-42.42-30c-24.813,0-45,20.187-45,45v122c0,24.813,20.187,45,45,45
                                            c4.541,0,8.925-0.682,13.061-1.939C383.45,438.523,366.272,452,346,452h-47.58c-6.192-17.458-22.865-30-42.42-30
                                            c-24.813,0-45,20.187-45,45s20.187,45,45,45c19.555,0,36.228-12.542,42.42-30H346c41.355,0,75-33.645,75-75v-15h15
                                            c24.813,0,45-20.187,45-45c0-1.864,0-108.262,0-122C481,100.935,380.065,0,256,0z M121,255c0-8.271,6.729-15,15-15s15,6.729,15,15
                                            v122c0,8.271-6.729,15-15,15s-15-6.729-15-15V255z M76,270h15v92H76c-8.271,0-15-6.729-15-15v-62C61,276.729,67.729,270,76,270z
                                             M256,482c-8.271,0-15-6.729-15-15s6.729-15,15-15s15,6.729,15,15S264.271,482,256,482z M391,377c0,8.271-6.729,15-15,15
                                            s-15-6.729-15-15V255c0-8.271,6.729-15,15-15s15,6.729,15,15V377z M451,347c0,8.271-6.729,15-15,15h-15v-92h15
                                            c8.271,0,15,6.729,15,15V347z" />
                                    </g>
                                </svg>
                            </div>
                            <div class="evolt-header-phone-meta">
                                <label><?php echo esc_attr($h_phone_label); ?></label>
                                <a href="tel:<?php echo esc_attr($h_phone_link); ?>"><?php echo esc_attr($h_phone); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
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
                            <div class="evolt-header-shop-icons">
                                <div class="icon-item">
                                    <a class="evolt-woosw-btn" href="http://localhost/wp_evolt/wishlist/"></a>
                                    <i class="caseicon-heart-alt"></i>
                                    <span class="wishlist-count"><?php echo WPcleverWoosw::get_count(); ?></span>
                                </div>
                                <div class="icon-item">
                                    <span class="woosc-btn wooscp-btn">Compare</span>
                                    <i class="caseicon-random"></i>
                                </div>
                                <div class="icon-item h-btn-cart">
                                    <i class="caseicon-shopping-cart-alt"></i>
                                    <span class="widget_cart_counter">2</span>
                                </div>
                            </div>
                            <!-- <div class="evolt-header-user">

                                <div class="h-btn-icon-user h-btn-user">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                    <ul class="evolt-user-account">
                                        <li><a href="http://localhost/wp_evolt/my-account/">My Account</a></li>
                                        <li><a href="http://localhost/wp_evolt/wp-login.php?action=logout&amp;_wpnonce=dc7f75eefe">Log Out</a></li>
                                    </ul>
                                </div>
                            </div> -->
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