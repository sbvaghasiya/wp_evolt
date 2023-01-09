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
$icon_has_children = evolt_get_option('icon_has_children', 'arrow');
$default_mobile_logo = evolt_get_option( 'default_mobile_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout1 item-menu-style1 fixed-height <?php if ( !(has_nav_menu( 'menu-left' )) && !(has_nav_menu( 'menu-right' )) ) { echo 'evolt-header-reset'; } ?> <?php if($sticky_on == 1) { echo 'is-sticky '; echo esc_attr($sticky_header_type); } ?>" data-offset-sticky="100">
        <?php if($h_topbar == 'show') : ?>
            <div id="evolt-header-top" class="evolt-header-top1">
                <div class="container">
                    <div class="row">
                        <?php if(!empty($wellcome)) : ?>
                            <div class="evolt-topbar-wellcome">
                                <?php echo wp_kses_post($wellcome); ?>
                            </div>
                        <?php endif; ?>
                        <div class="evolt-topbar-cart">
                            <?php if(class_exists('Woocommerce') && $cart_icon) : ?>
                                <div class="header-right-item h-btn-cart">
                                    <i class="caseicon-shopping-cart"></i>
                                    <?php echo esc_html__('Cart', 'evolt').':'; ?>
                                    <span class="widget_cart_counter_header"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?> - <span class="cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></span></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div id="evolt-header" class="evolt-header-main">
            <div class="container">
                <div class="row">
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
                                    <?php if($search_icon) : ?>
                                        <div class="icon-item h-btn-search"><i class="flaticon-search"></i></div>
                                    <?php endif; ?>
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