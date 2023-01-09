;(function ($) {

    "use strict";

    /* ===================
     Page reload
     ===================== */
    var scroll_top;
    var window_height;
    var window_width;
    var scroll_status = '';
    var lastScrollTop = 0;
    $(window).on('load', function () {
        $(".evolt-loader").fadeOut("slow");
        window_width = $(window).width();
        evolt_col_offset();
        evolt_header_sticky();
        evolt_scroll_to_top();
        evolt_quantity_icon();
        evolt_footer_fixed();
        evolt_mouse_move();
        setTimeout(function(){
            $('body:not(.elementor-editor-active) .evolt-slick-slider').css('height', 'auto');
            $('body:not(.elementor-editor-active) .evolt-slick-slider').css('overflow', 'visible');
            $('body:not(.elementor-editor-active) .evolt-slick-slider').css('opacity', '1');
        }, 100);
    });
    $(window).on('resize', function () {
        window_width = $(window).width();
        evolt_col_offset();
        evolt_footer_fixed();
    });

    $(window).on('scroll', function () {
        scroll_top = $(window).scrollTop();
        window_height = $(window).height();
        window_width = $(window).width();
        if (scroll_top < lastScrollTop) {
            scroll_status = 'up';
        } else {
            scroll_status = 'down';
        }
        lastScrollTop = scroll_top;
        evolt_header_sticky();
        evolt_scroll_to_top();
    });

    $(document).on('click', '.h-btn-search', function () {
        $('.evolt-modal-search').addClass('open').removeClass('remove');
        $('body').addClass('ov-hidden');
        setTimeout(function(){
            $('.evolt-modal-search .search-field').focus();
        },1000);
    });

    $(document).ready(function () {

        /* =================
         Menu Dropdown
         =================== */
        var $menu = $('.evolt-main-navigation');
        $menu.find('.evolt-main-menu li').each(function () {
            var $submenu = $(this).find('> ul.sub-menu');
            if ($submenu.length == 1) {
                $(this).hover(function () {
                    if ($submenu.offset().left + $submenu.width() > $(window).width()) {
                        $submenu.addClass('back');
                    } else if ($submenu.offset().left < 0) {
                        $submenu.addClass('back');
                    }
                }, function () {
                    $submenu.removeClass('back');
                });
            }
        });

        /* =================
         Menu Mobile
         =================== */
        $('.evolt-main-navigation li.menu-item-has-children').append('<span class="evolt-menu-toggle caseicon-angle-arrow-down"></span>');
        $('.evolt-menu-toggle').on('click', function () {
            $(this).toggleClass('toggle-open');
            $(this).parent().find('> .sub-menu').toggleClass('submenu-open');
            $(this).parent().find('> .sub-menu').slideToggle();
        });

        $(".evolt-main-menu li a.is-one-page").on('click', function () {
           $(this).parents('.evolt-header-navigation').removeClass('navigation-open');
           $(this).parents('.evolt-header-main').find('.btn-nav-mobile').removeClass('opened');
        });
        
        $("#evolt-menu-mobile .open-menu").on('click', function () {
            $(this).toggleClass('opened');
            $('.evolt-header-navigation').toggleClass('navigation-open');
            $('.evolt-menu-overlay').toggleClass('active');
        });

        $(".evolt-menu-close").on('click', function () {
            $(this).parents('.evolt-header-navigation').removeClass('navigation-open');
            $('.evolt-menu-overlay').removeClass('active');
            $('#evolt-menu-mobile .open-menu').removeClass('opened');
            $('body').removeClass('ovhidden');
        });

        $(".evolt-menu-overlay").on('click', function () {
            $(this).parents('#evolt-header').find('.evolt-header-navigation').removeClass('navigation-open');
            $(this).removeClass('active');
            $('#evolt-menu-mobile .open-menu').removeClass('opened');
            $('body').removeClass('ovhidden');
        });

        if (window_width < 1199) {
            $('.evolt-main-menu li.menu-item-has-children > a').on("click", function (e) {
                e.preventDefault();
                $(this).parent().find('> .sub-menu, > .children').toggleClass('submenu-open');
                $(this).parent().find('> .sub-menu, > .children').slideToggle();
                $(this).parent().find('> .evolt-menu-toggle').toggleClass('toggle-open');
            });
        }

        /* ===================
         Search Toggle
         ===================== */
        $('.h-btn-form').click(function (e) {
            e.preventDefault();
            $('.evolt-modal-contact-form').removeClass('remove').toggleClass('open');
        });

        setTimeout(function(){
            $('.evolt-close, .evolt-close .evolt-icon-close').click(function (e) {
                e.preventDefault();
                $(this).parents('.evolt-widget-cart-wrap').removeClass('open');
                $(this).parents('.evolt-modal').addClass('remove').removeClass('open');
                $(this).parents('#page').find('.site-overlay').removeClass('open');
                $(this).parents('body').removeClass('ov-hidden');
            });
        }, 300);

        $('.evolt-hidden-sidebar-overlay, .evolt-widget-cart-overlay').click(function (e) {
            e.preventDefault();
            $(this).parent().toggleClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });

        /* Video 16:9 */
        $('.entry-video iframe').each(function () {
            var v_width = $(this).width();

            v_width = v_width / (16 / 9);
            $(this).attr('height', v_width + 35);
        });

        /* Video Light Box */
        $('.evolt-video-button, .btn-video, .slider-video').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        
        /* ====================
         Scroll To Top
         ====================== */
        $('.scroll-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        /* =================
        Add Class
        =================== */
        $('.wpcf7-select').parent().addClass('wpcf7-menu');
        

        /* =================
         The clicked item should be in center in owl carousel
         =================== */
        var $owl_item = $('.owl-active-click');
        $owl_item.children().each(function (index) {
            $(this).attr('data-position', index);
        });
        $(document).on('click', '.owl-active-click .owl-item > div', function () {
            $owl_item.trigger('to.owl.carousel', $(this).data('position'));
        });

        /* Select */
        $('form:not(.wpforms-form) select').each(function () {
            $(this).niceSelect();
        });

        /* Search */
        $('.evolt-modal-close').on('click', function () {
            $(this).parent().removeClass('open').addClass('remove');
            $(this).parents('body').removeClass('ov-hidden');
        });
        $(document).on('click', function (e) {
            if (e.target.className == 'evolt-modal evolt-modal-search open')
                $('.evolt-modal-search').removeClass('open').addClass('remove');
            if (e.target.className == 'evolt-hidden-sidebar open')
                $('.evolt-hidden-sidebar').removeClass('open');
        });

        /* Hidden Sidebar */
        $(".h-btn-sidebar").on('click', function (e) {
            e.preventDefault();
            $('.evolt-hidden-sidebar-wrap').toggleClass('open');
            $(this).parents('body').addClass('ov-hidden');
        });

        $(".evolt-hidden-close").on('click', function (e) {
            e.preventDefault();
            $(this).parents('.evolt-hidden-sidebar-wrap').removeClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });

        /* Cart Sidebar */
        $(".h-btn-cart, .btn-nav-cart").on('click', function (e) {
            e.preventDefault();
            $('.evolt-widget-cart-wrap').toggleClass('open');
            $('.evolt-header-navigation').removeClass('navigation-open');
            $('#evolt-menu-mobile .open-menu').removeClass('opened');
            $('.evolt-menu-overlay').removeClass('active');
            $(this).parents('body').addClass('ov-hidden');
        });

        /* Year Copyright */
        var _year_footer = $(".evolt-footer-year"),
            _year_clone = _year_footer.parents(".site").find('.evolt-year');
        _year_clone.after(_year_footer.clone());
        _year_footer.remove();
        _year_clone.remove();

        /* Comment Reply */
        $('.comment-reply a').append( '<i class="caseicon-angle-arrow-right"></i>' );

        $('.evolt-grid .filter-item').append( '<i></i>' );

        /* Nav Slider */
        setTimeout(function () {
            $('.revslider-initialised').each(function () {
                $(this).find('.evolt-slider-nav .slider-nav-right').on('click', function () {
                    $(this).parents('.revslider-initialised').find('.tp-rightarrow').trigger('click');
                });
                $(this).find('.evolt-slider-nav .slider-nav-left').on('click', function () {
                    $(this).parents('.revslider-initialised').find('.tp-leftarrow').trigger('click');
                });
            });
            $('.evolt-slider-nav').parents('.revslider-initialised').find('.tparrows').addClass('arrow-hidden');
        }, 300);

        /* Icon Form */
        setTimeout(function () {
            $('.input-filled').each(function () {
                var icon_input = $(this).find(".input-icon"),
                    control_wrap = $(this).find('.wpcf7-form-control');
                control_wrap.before(icon_input.clone());
                icon_input.remove();
            });
        }, 200);

        /* Same Height */
        $('.same-height').matchHeight();
        $('.evolt-counter-layout3 .evolt-counter-inner').matchHeight();
        $('.evolt-client-grid1 .grid-item').matchHeight();

        /* Demo Bar */
        $(".choose-demo").on('click', function () {
            $(this).parents('.evolt-demo-bar').toggleClass('active');
        });

        /* Animate Time */
        $('.animate-time').each(function () {
            var eltime = 100;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .grid-item > .wow').each(function (index, obj) {
                $(this).css('animation-delay', eltime + 'ms');
                if (_elt === index) {
                    eltime = 100;
                    _elt = _elt + elt_inner;
                } else {
                    eltime = eltime + 80;
                }
            });
        });

        $('.case-animate-time').each(function () {
            var eltime = 0;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .slide-in-container > .wow').each(function (index, obj) {
                $(this).css('transition-delay', eltime + 'ms');
                if (_elt === index) {
                    eltime = 0;
                    _elt = _elt + elt_inner;
                } else {
                    eltime = eltime + 80;
                }
            });
        });

        /* Showcase */
        $('.evolt-showcase-link').each(function () {
            $(this).hover(function () {
                $(this).parents('.evolt-showcase-image').find('.evolt-showcase-link').removeClass('active');
                $(this).addClass('active');
            });
        });

        /* Page Title Scroll Opacity */
        var fadeStart=140,fadeUntil=440,fading = $('.page-title-inner');
        $(window).bind('scroll', function(){
            var offset = $(document).scrollTop()
                ,opacity=0
            ;
            if( offset<=fadeStart ){
                opacity=1;
            }else if( offset<=fadeUntil ){
                opacity=1-offset/fadeUntil;
            }
            fading.css('opacity',opacity);
        });

        /* Overlay particle */
        setTimeout(function(){
            $('.elementor-section-wrap > .elementor-element').each(function () {
                var _el_particle = $(this).find(".evolt-particle-animate"),
                    _row_particle = _el_particle.parents(".elementor-container");
                _row_particle.before(_el_particle.clone());
                _el_particle.remove();
                
                var _el_bg_animate = $(this).find(".evolt-background-animate"),
                    _row_bg_animate = _el_bg_animate.parents(".elementor-container");
                _row_bg_animate.before(_el_bg_animate.clone());
                _el_bg_animate.remove();

                var _el_text = $(this).find(".evolt-text"),
                    _row_text = _el_text.parents(".elementor-container");
                _row_text.before(_el_text.clone());
                _el_text.remove();
            });
        }, 200);

        /* Mega Menu */
        $('.mega-2-columns').parents('.sub-menu').addClass('evolt-mega-2-columns');
        $('.mega-2-columns').parents('li.megamenu').addClass('evolt-megamenu-columns');

        $('.evolt-topbar-shorttext .evolt-icon-close').on('click', function () {
            $(this).parents('.evolt-topbar-shorttext').hide('slow');
        });

        /* Header User */
        $('.btn-sign-up').on('click', function () {
            $(this).parents('.evolt-modal-content').find('.evolt-user-register').addClass('u-open').removeClass('u-close');
            $(this).parents('.evolt-modal-content').find('.evolt-user-login').addClass('u-close').removeClass('u-open');
        });
        $('.btn-sign-in').on('click', function () {
            $(this).parents('.evolt-modal-content').find('.evolt-user-login').addClass('u-open').removeClass('u-close');
            $(this).parents('.evolt-modal-content').find('.evolt-user-register').addClass('u-close').removeClass('u-open');
        });
        $('.h-btn-user').on('click', function () {
            $('.evolt-user-popup').addClass('open').removeClass('remove');
            $(this).find('.evolt-user-account').toggleClass('active');
        });

        var m_h_mega = $('li.megamenu > .sub-menu > li > .container').outerHeight();
        var w_h_mega = $(window).height();
        var w_h_mega_css = w_h_mega - 100;
        if(m_h_mega > w_h_mega) {
            $('li.megamenu > .sub-menu > li > .container').css('max-height', w_h_mega_css + 'px');
            $('li.megamenu > .sub-menu > li > .container').css('overflow-x', 'scroll');
        }

        /* Blog */
        $( ".evolt-blog-carousel-layout7 .grid-item-inner" ).hover(
          function() {
            $( this ).find('.item--content').slideToggle(200);
          }, function() {
            $( this ).find('.item--content').slideToggle(200);
          }
        );

        /* Point */
        $('.evolt-point-icon').on('click', function () {
            $( this ).parent().find('.evolt-point-meta').toggleClass('active');
        });

    });

    function evolt_header_sticky() {
        var offsetTop = $('#evolt-header-wrap').outerHeight();
        var offsetExtra = $('#evolt-header-wrap').data('offset-sticky');
        var offsetTopAnimation = offsetTop + offsetExtra;
        if($('#evolt-header-wrap').hasClass('is-sticky')) {
            if (scroll_top > offsetTopAnimation) {
                $('#evolt-header').addClass('h-fixed');
            } else {
                $('#evolt-header').removeClass('h-fixed');   
            }
        }

        var h_header_top, h_header_middle, h_header_main;

        if ($('.fixed-height #evolt-header-top').length) { 
            h_header_top = $('.fixed-height #evolt-header-top').outerHeight();
        } else {
            h_header_top = 0;
        }

        if ($('.fixed-height #evolt-header-middle').length) { 
            h_header_middle = $('.fixed-height #evolt-header-middle').outerHeight();
        } else {
            h_header_middle = 0;
        }

        if ($('.fixed-height #evolt-header').length) { 
            h_header_main = $('.fixed-height #evolt-header').outerHeight();
        } else {
            h_header_main = 0;
        }

        var h_header_all = h_header_top + h_header_middle + h_header_main;
        if (window_width > 1200) {
            $('.fixed-height').css({
                'height': h_header_all
            });
        }

        if (window_width > 1200) {
            $('.fixed-height').css({
                'max-height': offsetTop
            });
        }

        if (window_width > 1200) {
            $('.fixed-height-h').css({
                'height': offsetTop
            });
        }

        if (scroll_status == 'up' && scroll_top > 0) {
            $('#evolt-header').addClass('scroll-up');
        } else {
            $('#evolt-header').removeClass('scroll-up');
        }
        if (scroll_status == 'down') {
            $('#evolt-header').addClass('scroll-down');
        } else {
            $('#evolt-header').removeClass('scroll-down');
        }
        if (scroll_status == 'down' && scroll_top > offsetTopAnimation) {
            $('#evolt-header').addClass('scroll-animate');
        } else {
            $('#evolt-header').removeClass('scroll-animate');
        }
    }

    /* ====================
     Mouse Move
     ====================== */
    function evolt_mouse_move() {
        if ($('#evolt-mouse-move').hasClass('evolt-mouse-move')) {
            var follower, init, mouseX, mouseY, positionElement, timer;

            follower = document.getElementById('evolt-mouse-move');

            mouseX = (event) => {
                return event.clientX;
            };

            mouseY = (event) => {
                return event.clientY;
            };

            positionElement = (event) => {
                var mouse;
                mouse = {
                    x: mouseX(event),
                    y: mouseY(event)
                };

                follower.style.top = mouse.y + 'px';
                return follower.style.left = mouse.x + 'px';
            };

            timer = false;

            window.onmousemove = init = (event) => {
                var _event;
                _event = event;
                    return timer = setTimeout(() => {
                    return positionElement(_event);
                }, 0);
            };
        }
    }

    /* =================
     Column Offset
     =================== */
    function evolt_col_offset() {
        var w_vc_row_lg = ($('#content').width() - 1200) / 2;
        if (window_width > 1200) {
            $('body:not(.rtl) .col-offset-left > .elementor-widget-wrap').css('padding-left', w_vc_row_lg + 'px');
            $('body:not(.rtl) .col-offset-right > .elementor-widget-wrap').css('padding-right', w_vc_row_lg + 'px');

            $('.rtl .col-offset-left > .elementor-column-wrap > .elementor-widget-wrap').css('padding-right', w_vc_row_lg + 'px');
            $('.rtl .col-offset-right > .elementor-column-wrap > .elementor-widget-wrap').css('padding-left', w_vc_row_lg + 'px');
        }
    }

    /* =================
     Footer Fixed
     =================== */
    function evolt_footer_fixed() {
        setTimeout(function(){
            var h_footer = $('.fixed-footer .site-footer-custom').outerHeight() - 1;
            $('.fixed-footer .site-content').css('margin-bottom', h_footer + 'px');
        }, 300);
    }

    /* ====================
     Scroll To Top
     ====================== */
    function evolt_scroll_to_top() {
        if (scroll_top < window_height) {
            $('.scroll-top').addClass('off').removeClass('on');
        }
        if (scroll_top > window_height) {
            $('.scroll-top').addClass('on').removeClass('off');
        }
    }

    /* ====================
     WooComerce Quantity
     ====================== */
    function evolt_quantity_icon() {
        $('#content .quantity').append('<span class="quantity-icon"><i class="quantity-down">-</i><i class="quantity-up">+</i></span>');
        $('.quantity-up').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepUp();
        });
        $('.quantity-down').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepDown();
        });
        $('.quantity-icon i').on('click', function () {
            var quantity_number = $(this).parents('.quantity').find('input[type="number"]').val();
            var add_to_cart_button = $(this).parents( ".product, .woocommerce-product-inner" ).find(".add_to_cart_button");
            add_to_cart_button.attr('data-quantity', quantity_number);
            add_to_cart_button.attr("href", "?add-to-cart=" + add_to_cart_button.attr("data-product_id") + "&quantity=" + quantity_number);
        });
        $('.woocommerce-cart-form .actions .button').removeAttr('disabled');
    }

    $( document ).ajaxComplete(function() {
       evolt_quantity_icon();
    });

})(jQuery);
