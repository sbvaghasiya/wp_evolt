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
$cart_icon = evolt_get_option( 'cart_icon', false );
$search_icon = evolt_get_option( 'search_icon', false );
$wishlist_icon = evolt_get_option( 'wishlist_icon', false );
$h_custom_menu_left = evolt_get_page_option( 'h_custom_menu_left' );
$h_custom_menu_right = evolt_get_page_option( 'h_custom_menu_right' );
$h_topbar = evolt_get_option( 'h_topbar', 'show' );
$wellcome = evolt_get_option( 'wellcome', '' );
$h_phone = evolt_get_option( 'h_phone' );
$h_phone_link = evolt_get_option( 'h_phone_link' );
$h_address = evolt_get_option( 'h_address' );
$h_address_link = evolt_get_option( 'h_address_link' );
$login_text = evolt_get_option( 'login_text' );
$login_link = evolt_get_option( 'login_link' );
$register_text = evolt_get_option( 'register_text' );
$register_link = evolt_get_option( 'register_link' );
$icon_has_children = evolt_get_option('icon_has_children', 'arrow');
$language_switch = evolt_get_option('language_switch', false);
$default_mobile_logo = evolt_get_option( 'default_mobile_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout1 item-menu-style1 fixed-height <?php if ( !(has_nav_menu( 'menu-left' )) && !(has_nav_menu( 'menu-right' )) ) { echo 'evolt-header-reset'; } ?> <?php if($sticky_on == 1) { echo 'is-sticky '; echo esc_attr($sticky_header_type); } ?>" data-offset-sticky="100">
        <?php if($h_topbar == 'show') : ?>
            <div id="evolt-header-top" class="evolt-header-top1">
                <div class="container">
                    <div class="row justify-content-between">
                        <?php if(!empty($wellcome)) : ?>
                            <!-- <div class="evolt-topbar-wellcome">
                                <?php /*  echo wp_kses_post($wellcome); */?>
                            </div> -->
                        <?php endif; ?>                        
                        <div class="details_top_header">
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
                        <div class="evolt-topbar-cart">
                            <?php if(class_exists('Woocommerce') && $cart_icon) : ?>
                                <div class="header-right-item h-btn-cart">
                                    <i class="caseicon-shopping-cart"></i>
                                    <?php echo esc_html__('Cart', 'evolt').':'; ?>
                                    <span class="widget_cart_counter_header"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?> - <span class="cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></span></span>
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
        <div id="evolt-header" class="evolt-header-main">
            <div class="container">
                <div class="row d-flex justify-content-between align-items-center">
                    <?php if ( has_nav_menu( 'menu-left' ) ) { ?>
                        <div class="evolt-header-navigation evolt-header-navigation-left">
                            <nav class="evolt-main-navigation">
                                <div class="evolt-main-navigation-inner">
                                    <?php
                                        $attr_menu = array(
                                            'theme_location' => 'menu-left',
                                            'container'  => '',
                                            'menu_id'    => 'evolt-main-menu-left',
                                            'menu_class' => 'evolt-main-menu children-'.$icon_has_children.' clearfix',
                                            'link_before'     => '<span>',
                                            'link_after'      => '</span>',
                                            'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                        );
                                        if(isset($h_custom_menu_left) && !empty($h_custom_menu_left)) {
                                            $attr_menu['menu'] = $h_custom_menu_left;
                                        }
                                        wp_nav_menu( $attr_menu );
                                    ?>
                                </div>
                            </nav>
                        </div>
                    <?php } ?>
                    <div class="evolt-header-branding">
                        <div class="evolt-header-branding-inner">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                    <?php if ( has_nav_menu( 'menu-right' ) ) { ?>
                        <div class="evolt-header-navigation evolt-header-navigation-right">
                            <nav class="evolt-main-navigation">
                                <div class="evolt-main-navigation-inner">
                                    <?php if ($default_mobile_logo['url']) { ?>
                                        <div class="evolt-logo-mobile">
                                            <a href="<?php esc_url( esc_url( home_url( '/' ) ) ); ?>" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo esc_url( $default_mobile_logo['url'] ); ?>" alt="<?php esc_attr( get_bloginfo( 'name' ) ); ?>"/></a>
                                        </div>
                                    <?php } ?>
                                    <?php evolt_header_mobile_search(); ?>
                                    <?php if ( has_nav_menu( 'menu-left' ) ) {
                                        $attr_menu = array(
                                            'theme_location' => 'menu-left',
                                            'container'  => '',
                                            'menu_id'    => 'evolt-main-menu-left-mobile',
                                            'menu_class' => 'evolt-main-menu children-'.$icon_has_children.' clearfix',
                                            'link_before'     => '<span>',
                                            'link_after'      => '</span>',
                                            'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                        );
                                        if(isset($h_custom_menu_left) && !empty($h_custom_menu_left)) {
                                            $attr_menu['menu'] = $h_custom_menu_left;
                                        }
                                        wp_nav_menu( $attr_menu );
                                    } 
                                    $attr_menu = array(
                                        'theme_location' => 'menu-right',
                                        'container'  => '',
                                        'menu_id'    => 'evolt-main-menu-right',
                                        'menu_class' => 'evolt-main-menu children-'.$icon_has_children.' clearfix',
                                        'link_before'     => '<span>',
                                        'link_after'      => '</span>',
                                        'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                    );
                                    if(isset($h_custom_menu_right) && !empty($h_custom_menu_right)) {
                                        $attr_menu['menu'] = $h_custom_menu_right;
                                    }
                                    wp_nav_menu( $attr_menu );
                                    ?>
                                </div>
                            </nav>
                            <div class="evolt-header-meta">
                                <?php if($search_icon) : ?>
                                    <div class="header-right-item h-btn-search"><i class="caseicon-search"></i></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ( !(has_nav_menu( 'menu-left' )) && !(has_nav_menu( 'menu-right' )) ) { ?>
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
                                    <?php if($search_icon) : ?>
                                        <div class="icon-item h-btn-search"><i class="flaticon-search"></i></div>
                                    <?php endif; ?>
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
                                            <i class="caseicon-shopping-cart-alt"></i>
                                            <span class="widget_cart_counter"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?></span>
                                        </div>
                                    <?php endif; ?>   
                                    <div class="icon-item evolt-header-user">                                        
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
                    <?php } ?>
                    <div class="evolt-menu-overlay"></div>
                </div>
            </div>
            <div id="evolt-menu-mobile">
                <?php if(class_exists('Woocommerce') && $cart_icon) : ?>
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