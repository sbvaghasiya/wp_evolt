<?php
/**
 * Template part for displaying default header layout
 */
$custom_main_header = evolt_get_page_option( 'custom_main_header', false );
$sticky_on = evolt_get_option( 'sticky_on', false );
$sticky_header_type = evolt_get_option( 'sticky_header_type', 'scroll-to-bottom' );
$sticky_header_type_page = evolt_get_page_option( 'sticky_header_type_page', 'themeoption' );
if(isset($sticky_header_type_page) && !empty($sticky_header_type_page) && $sticky_header_type_page !== 'themeoption') {
    $sticky_header_type = $sticky_header_type_page;
}
$user_icon = evolt_get_option( 'user_icon', false );
$wishlist_icon = evolt_get_option( 'wishlist_icon', false );
$cart_icon = evolt_get_option( 'cart_icon', false );
$h_address_label = evolt_get_option( 'h_address_label' );
$h_address = evolt_get_option( 'h_address' );
$h_address_link = evolt_get_option( 'h_address_link' );
$h_phone_label = evolt_get_option( 'h_phone_label' );
$h_phone = evolt_get_option( 'h_phone' );
$h_phone_link = evolt_get_option( 'h_phone_link' );
$h_btn_text = evolt_get_option( 'h_btn_text' );
$h_btn_link = evolt_get_option( 'h_btn_link' );
$default_mobile_logo = evolt_get_option( 'default_mobile_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
$btn_custom_text = evolt_get_page_option( 'btn_custom_text' );
if($custom_main_header && !empty($btn_custom_text)) {
    $h_btn_text = $btn_custom_text;
}
?>
<header id="evolt-masthead">
    <div id="evolt-header-wrap" class="evolt-header-layout10 <?php if($sticky_on == 1) { echo 'is-sticky '; echo esc_attr($sticky_header_type); } ?>" data-offset-sticky="200">
         <div id="evolt-header-middle">
            <div class="container">
                <div class="row">
                    <div class="evolt-header-branding">
                        <div class="evolt-header-branding-inner">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                    <div class="evolt-header-info">
                        <?php if(!empty($h_phone_label) || !empty($h_phone_link) || !empty($h_phone)) : ?>
                            <div class="evolt-header-info-item">
                                <div class="evolt-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M4.72241 14.4786C6.81254 16.9676 9.3286 18.9274 12.2003 20.3141C13.2937 20.8303 14.7559 21.4427 16.385 21.5477C16.486 21.5521 16.5826 21.5564 16.6836 21.5564C17.777 21.5564 18.6552 21.1802 19.3709 20.4059C19.3753 20.4016 19.3841 20.3928 19.3885 20.3841C19.6431 20.0779 19.933 19.8023 20.2359 19.5092C20.4423 19.3123 20.6531 19.1067 20.8551 18.8968C21.7904 17.9256 21.7904 16.692 20.8463 15.7515L18.2073 13.1225C17.7594 12.6588 17.2237 12.4138 16.6616 12.4138C16.0996 12.4138 15.5595 12.6588 15.0984 13.1181L13.5264 14.6842C13.3815 14.601 13.2322 14.5267 13.0917 14.4567C12.9161 14.3692 12.7536 14.2861 12.6087 14.1942C11.1772 13.2887 9.87748 12.1076 8.63482 10.5897C8.0069 9.79789 7.58536 9.13298 7.29116 8.45494C7.70392 8.08311 8.09033 7.69378 8.46357 7.3132C8.5953 7.1776 8.73142 7.04199 8.86755 6.90638C9.34178 6.43394 9.59646 5.88713 9.59646 5.33158C9.59646 4.77602 9.34617 4.22921 8.86755 3.75677L7.55902 2.45319C7.40533 2.30008 7.26043 2.15135 7.11113 1.99824C6.82132 1.70078 6.51834 1.39457 6.21975 1.11898C5.76747 0.677159 5.23616 0.445312 4.67411 0.445312C4.11645 0.445312 3.58074 0.677159 3.1109 1.12335L1.46865 2.7594C0.871469 3.35432 0.533359 4.07611 0.463103 4.91163C0.379673 5.95712 0.572879 7.06824 1.07346 8.41119C1.84189 10.4891 3.00112 12.4182 4.72241 14.4786ZM1.53452 5.00349C1.58721 4.42169 1.81115 3.93613 2.23269 3.51618L3.86616 1.88888C4.12084 1.64391 4.40186 1.51705 4.67411 1.51705C4.94196 1.51705 5.2142 1.64391 5.46449 1.89763C5.75869 2.16885 6.03533 2.45319 6.33392 2.75502C6.48321 2.90813 6.6369 3.06124 6.79059 3.21872L8.09911 4.5223C8.37136 4.79352 8.51187 5.06911 8.51187 5.34033C8.51187 5.61154 8.37136 5.88713 8.09911 6.15835C7.96299 6.29396 7.82687 6.43394 7.69075 6.56955C7.28238 6.98075 6.90036 7.37007 6.47882 7.7419C6.47004 7.75065 6.46565 7.75502 6.45687 7.76377C6.09241 8.12685 6.1495 8.47243 6.23732 8.7349C6.24171 8.74803 6.2461 8.75677 6.25049 8.7699C6.5886 9.57917 7.05844 10.3491 7.79174 11.2677C9.10905 12.8863 10.4966 14.1417 12.0247 15.1085C12.2135 15.231 12.4155 15.3272 12.6043 15.4234C12.78 15.5109 12.9424 15.594 13.0873 15.6859C13.1049 15.6947 13.1181 15.7034 13.1356 15.7122C13.2805 15.7865 13.4211 15.8215 13.5616 15.8215C13.9128 15.8215 14.1412 15.5984 14.2158 15.5241L15.8581 13.888C16.1128 13.6343 16.3894 13.4987 16.6616 13.4987C16.9954 13.4987 17.2676 13.7043 17.4388 13.888L20.0866 16.5214C20.6136 17.0464 20.6092 17.615 20.0735 18.1706C19.889 18.3675 19.6958 18.5556 19.4895 18.7524C19.1821 19.0499 18.8615 19.3561 18.5717 19.7017C18.0668 20.2441 17.4652 20.4978 16.688 20.4978C16.6133 20.4978 16.5343 20.4934 16.4596 20.4891C15.0194 20.3972 13.6801 19.8373 12.6746 19.3605C9.94335 18.0437 7.54584 16.1758 5.5567 13.8049C3.91885 11.8408 2.8167 10.0122 2.08779 8.05249C1.63551 6.84951 1.46426 5.88276 1.53452 5.00349Z" fill="white" stroke="white" stroke-width="0.2"/>
                                </svg>
                                </div>
                                <div class="evolt-header-meta">
                                    <a href="tel:<?php echo esc_attr($h_phone_link); ?>"><?php echo esc_attr($h_phone); ?></a>
                                    <label><?php echo esc_attr($h_phone_label); ?></label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($h_address_label) || !empty($h_address_link) || !empty($h_address)) : ?>
                            <div class="evolt-header-info-item">
                                <div class="evolt-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                    <path d="M22.923 21.7782H5.07652C4.49644 21.7775 3.9403 21.5444 3.53014 21.13C3.11997 20.7156 2.88928 20.1538 2.88867 19.5678V8.43311C2.88928 7.84709 3.11997 7.28524 3.53014 6.87084C3.9403 6.45644 4.49644 6.22333 5.07652 6.22266H22.923C23.5031 6.22333 24.0593 6.45644 24.4694 6.87084C24.8796 7.28524 25.1103 7.84709 25.1109 8.43311V19.5678C25.1103 20.1538 24.8796 20.7156 24.4694 21.13C24.0593 21.5444 23.5031 21.7775 22.923 21.7782ZM5.07652 7.06747C4.71814 7.06786 4.37455 7.21187 4.12115 7.4679C3.86776 7.72393 3.72526 8.07106 3.72493 8.43311V19.5678C3.72526 19.9298 3.86776 20.2769 4.12115 20.533C4.37455 20.789 4.71814 20.933 5.07652 20.9334H22.923C23.2814 20.933 23.625 20.789 23.8784 20.533C24.1318 20.2769 24.2743 19.9298 24.2746 19.5678V8.43311C24.2743 8.07106 24.1318 7.72393 23.8784 7.4679C23.625 7.21187 23.2814 7.06786 22.923 7.06747H5.07652Z" fill="white" stroke="white" stroke-width="0.5"/>
                                    <path d="M13.9992 16.4862C13.8973 16.4863 13.7988 16.4487 13.7224 16.3806L3.64551 7.39435L4.1989 6.76074L13.9992 15.5012L23.7999 6.7618L24.3533 7.39541L14.2764 16.3817C14.1998 16.4496 14.1011 16.4868 13.9992 16.4862Z" fill="white" stroke="white" stroke-width="0.5"/>
                                    <path d="M3.41895 20.4521L10.1885 12.66L10.8173 13.2176L4.04781 21.0097L3.41895 20.4521Z" fill="white" stroke="white" stroke-width="0.5"/>
                                    <path d="M17.2041 13.209L17.833 12.6514L24.6026 20.4437L23.9738 21.0013L17.2041 13.209Z" fill="white" stroke="white" stroke-width="0.5"/>
                                </svg>
                                </div>
                                <div class="evolt-header-meta">
                                    <a href="<?php echo esc_url($h_address_link); ?>"><?php echo esc_attr($h_address); ?></a>
                                    <label><?php echo esc_attr($h_address_label); ?></label>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- <div class="evolt-header-right">
                        <?php /* if(!empty($h_btn_text)) : ?>
                            <div class="evolt-header-button">
                                <a class="btn btn-gradient" href="<?php echo esc_url(get_permalink($h_btn_link)); ?>"><?php echo esc_attr($h_btn_text); ?></a>
                            </div>
                        <?php endif; */ ?>
                    </div> -->
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
                        <div class="evolt-header-shop-icons">
                            <?php if($wishlist_icon && class_exists('WPCleverWoosw')) : 
                                $woosw_id = get_option( 'woosw_page_id' );
                                ?>
                                <div class="icon-item">
                                    <a class="evolt-woosw-btn" href="<?php echo esc_url(get_permalink($woosw_id)); ?>"></a>
                                    <i class="flaticon-love"></i>
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
                            
                            <div class="icon-item evolt-header-user">
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