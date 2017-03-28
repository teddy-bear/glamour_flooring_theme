(
  function ($) {

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

    // Show drop down on first menu click.
    function preventMenuAction() {
      if ($(window).width() > 767) {
        $('.touch .menu-item-has-children > a').one('click', function (e) {
          e.preventDefault();
        })
      }
    }

    preventMenuAction();

    // Vacancies presentation mode.
    function toggleView() {
      $('.display-mode .block-view').on('click', function () {
        $('.display-mode span').removeClass('active');
        $(this).addClass('active');
        $('.vacancies-blocks').attr('class', 'vacancies-blocks row');
      });
      $('.display-mode .list-view').on('click', function () {
        $('.display-mode span').removeClass('active');
        $(this).addClass('active');
        $('.vacancies-blocks').attr('class', 'vacancies-blocks list-view');
      })
    }

    toggleView();

    // Show secondary header on page scroll.
    function stickyHeader() {
      var header_offset = 140;
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

    // Parallax effect for header image and text on the home page.
    function scrollBanner() {
      $(window).scroll(function () {
        var scrollPos = $(this).scrollTop();
        // console.log(scrollPos);
        $('.header-parallax .container').css({
          'top': (
                   scrollPos / 2
                 ) + 'px',
          'opacity': 1 - (
            scrollPos / 600
          )
        });
        $('.header-parallax').css({
          'background-position': 'center ' + (
            -scrollPos / 9
          ) + 'px'
        });
      });
    }

    scrollBanner();

    $(document).ready(function () {


      /* ================= Custom theme scripts  =================  */

      // Mobile slider touch icon.
      $('.flexslider').append('<div class="touch-indicator visible-xs"></div>');

      // Main menu structure
      //$('.flexslider').append('<div class="touch-indicator visible-xs"></div>');

      /* ================= Initialize external plugins  ================ */

      // Images gallery.
      $(".gallery").lightGallery({
        selector: 'a'
      });

      // Testimonials carousel.
      $('.testimonials-items').owlCarousel({
        items: 1,
        lazyLoad: true,
        dots: true,
        nav: false,
        rewind: false,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        loop: true,
        //stagePadding: 30,
        smartSpeed: 450,
        animateIn: 'flipInX',
        animateOut: 'slideOutDown'
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
      $('.match').matchHeight();

      // Scripts for mobile devices.
      if ($(window).width() < 768) {
        // Mobile menu.
        $('nav#menu_mobile').mmenu();

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
    window.addEventListener("orientationchange", function () {
    });

  }
)(jQuery);
