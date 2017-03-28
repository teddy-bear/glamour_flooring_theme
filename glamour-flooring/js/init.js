/**
 * Main init file
 *
 *
 */


(function ($) {

    /* ================= Configure functions  =================  */

    // Enhance Contact Form 7 plugin behavior to fit theme design.
    function cf7_extra() {
        // Hide status message by click.
        $('.wpcf7-response-output').on('click', function () {
            $(this).hide(300);
        });

        // Hide notifications by click.
        $('.wpcf7-form-control-wrap').each(function () {
            $(this).on('click', function () {
                $(this).find('.wpcf7-form-control').focus().next().remove();
            })
        })
    }

    cf7_extra();

    // Youtube video close after finish.
    function onPlayerStateChange(event) {
        switch (event.data) {
            case YT.PlayerState.ENDED:
                $.magnificPopup.close();
                break;
        }
    }

    // Show drop down on first menu click.
    function preventMenuAction() {
        if ($(window).width() > 767) {
            $('.touch .menu-item-has-children > a').one('click', function (e) {
                e.preventDefault();
            })
        }
    }

    preventMenuAction();

    // Parallax effect for header image and text on the home page.
    function scrollBanner() {
        $(window).scroll(function () {
            var scrollPos = $(this).scrollTop();
            //console.log(scrollPos);
            $('.row-parallax-top .block').css({
                'top': (scrollPos / 2) + 'px',
                'opacity': 1 - (scrollPos / 600)
            });
            $('.row-parallax-top').css({
                'background-position': 'center ' + (-scrollPos / 9) + 'px'
            });
            $('.row-parallax-top .wrapper').css({
                'background-position': '90% ' + (220 + scrollPos / 5) + 'px'
                //'bottom': (-scrollPos / 4) + 'px'
            });
        });
    }

    //scrollBanner();

    /**
     * Disable auto scroll for location map.
     */
    function preventGoogleMapScroll() {
        var map_wrapper = $('.block-map');
        $('.block-map iframe').addClass('scrolloff');
        map_wrapper.on('click', function () {
            $('.block-map iframe').removeClass('scrolloff'); // set the pointer events true on click
        });
        map_wrapper.mouseleave(function () {
            $('.block-map iframe').addClass('scrolloff');
        });
    }

    preventGoogleMapScroll();

    // Smooth scroll for anchor links (used on home slider).
    function anchor_links() {
        $('.caption-wrap').append('<div class="slider-arrow"><a href="#content-start"></a></div>');
        $(".slider-arrow a").click(function () {
            var res = $(this).attr('href').split('#');

            // set top offset if necessary.
            // var headerH = $('.site-header').outerHeight();

            if (res.length) {
                var targetOffset = $('#' + res[1]).offset().top;
                $('html,body')
                    .animate({scrollTop: targetOffset}, 700);
                return false;
            }
            return false;
        });
    }

    anchor_links();


    // Accordion for tabs.
    function tabs_accordion() {
        // Keep first tab open by default.
        $('.accordion .item:eq(0)').addClass('act').find('.wrap-info').slideToggle(300);
        // Toggle on click.
        $('.accordion .title').on('click', function () {
            // Show/hide clicked tab.
            $(this).parent().toggleClass('act').find('.wrap-info').slideToggle(300);
            // Collapse neighbor tabs.
            $(this).parent().siblings().removeClass('act').find('.wrap-info').slideUp(300);
        });
    }

    //tabs_accordion();

    function portfolioFiltering() {
        // Filter handler.
        $('.portfolio-filter span').on('click', function () {
            $('.portfolio-filter span').removeClass('active');
            $(this).addClass('active');
            var active_location = $(this).data('category');
            var items = $('.portfolio-blocks .item');
            // Debug.
            //console.log(active_location);
            //console.log(parent_category);
            // Removed animation since we have transition & content area glitches.
            //items.fadeOut(300);
            //$('.' + active_location).delay(300).fadeIn(300);
            items.hide();
            $('.' + active_location).show();
        });

        // Emulate click on first tab (all).
        $('.portfolio-filter li:first-child span').trigger('click');
    }

    portfolioFiltering();

    // Show secondary header on page scroll.
    function stickyHeader() {
        var header_offset = $('.site-header').height() + 30;
        $(window).scroll(function () {
            if ($(window).scrollTop() > header_offset && !(
                    $('.site-header').hasClass('sticky')
                )) {
                $('.site-header').addClass('sticky');
            }
            else {
                if ($(window).scrollTop() < header_offset) {
                    $('.site-header').removeClass('sticky');
                }
            }

        });
    }

    stickyHeader();

    $(document).ready(function () {

        /* ================= Custom theme scripts  =================  */

        // Titles structure for decor styling.
        /*$('h2,h3,h4').each(function () {
         $(this).wrapInner('<span></span>');
         });*/

        // Product type custom taxonomy select & brands on mobile select.
        $('.custom_product_type select, select.wooc_sclist').on('change', function () {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });

        // Mobile slider touch icon.
        $('.flexslider').append('<div class="touch-indicator visible-xs"></div>');

        /* ================= Initialize external plugins  ================ */

        // Popup form.
        $('a[href="#popup-form"]').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function () {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });

        // Images gallery.
        $(".gallery").magnificPopup({
            delegate: 'a.item',
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        // Portfolio gallery carousel (on single page).
        $('.portfolio-gallery').owlCarousel({
            items: 1,
            lazyLoad: true,
            dots: false,
            nav: true,
            rewind: false,
            autoplay: false,
            autoplayTimeout: 5000,
            loop: true
        });

        // Testimonials carousel.
        $('.home .testimonials-items').owlCarousel({
            items: 1,
            lazyLoad: true,
            dots: true,
            nav: true,
            rewind: false,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: false,
            loop: true,
            //stagePadding: 30,
            smartSpeed: 450
            //animateIn: 'slideInUp',
            //animateOut: 'slideInDown'
        });

        // On scroll animations.
        var wow = new WOW(
            {
                boxClass: 'wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset: 100,          // distance to the element when triggering the animation (default is 0)
                mobile: false,       // trigger animations on mobile devices (default is true)
                live: true,       // act on asynchronously loaded content (default is true)
                callback: function (box) {
                    // the callback is fired every time an animation is started
                    // the argument that is passed in is the DOM node being animated
                },
                scrollContainer: null // optional scroll container selector, otherwise use window
            }
        );
        wow.init();

        // Equal height for blocks.
        $('.match, .row-content-bottom .block, .featured-blocks .block .text, .red-icons .block .text, ul.products .product_item_title').matchHeight();
        $('ul.products .custom-attributes').matchHeight();

        // Scripts for mobile devices.
        if ($(window).width() < 768) {
            // Mobile menu.
            // $('nav#menu_mobile').mmenu();
            $('#primary').slicknav({
                label: '',
                duration: 600,
                prependTo: '.row-mobile.visible-xs',
                closedSymbol: '&#9656;',
                openedSymbol: '&#9662;',
                allowParentLinks: true
            });

        }
        // Scripts for non mobile
        else {

            // Default Menu dropdown.
            $('.nav-primary ul.main-menu').superfish({
                animation: false,
                animationOut: false
            });

            // Forbid click event for phone links
            $('a[href^="tel:"]').on('click', function (e) {
                e.preventDefault();
            });

        }

        //$("#menu_mobile.nav-primary .menu-item a").addClass("mobilehover");
        $('.touch a').bind('touchstart', function () {
            $("a").addClass("hover");
        });

    });


    $(window).load(function () {
        $('body').addClass('loaded');
        // Hide touch indicator.
        setTimeout(function () {
            $('.flexslider .touch-indicator').addClass('disabled');
        }, 4500);
    });

    // Window resize
    $(window).resize(function () {
    });

    // Window scroll actions.
    $(window).scroll(function () {

    });


    // Orientation change
    /*window.addEventListener("orientationchange", function () {
     });*/

})(jQuery);
