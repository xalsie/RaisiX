/*
Template: raisix - Responsive Bootstrap 4 Admin Dashboard Template
Author: iqonicthemes.in
Design and Developed by: iqonicthemes.in
NOTE: This file contains the styling for responsive Template.
*/

/*----------------------------------------------
Index Of Script
------------------------------------------------

:: Tooltip
:: Magnific Popup
:: Ripple Effect
:: Sidebar Widget
:: Page FAQ
:: Page Loader
:: Owl Carousel
:: Search input
:: Scrollbar
:: Counter
:: slick
:: Progress Bar
:: Page Menu
:: Wow Animation
:: Form Validation
:: Active Class for Pricing Table
:: Flatpicker
:: Scroll up menu
:: Checkout
:: Datatables
:: image-upload
:: video
:: button

------------------------------------------------
Index Of Script
----------------------------------------------*/

(function(jQuery) {
    "use strict";
    $(document).ready(function() {

        /*---------------------------------------------------------------------
        Tooltip
        -----------------------------------------------------------------------*/
        $('[data-toggle="popover"]').popover();
        $('[data-toggle="tooltip"]').tooltip();

        /*---------------------------------------------------------------------
        Magnific Popup
        -----------------------------------------------------------------------*/
        $('.popup-gallery').magnificPopup({
            delegate: 'a.popup-img',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                }
            }
        });
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });


        /*---------------------------------------------------------------------
        Ripple Effect
        -----------------------------------------------------------------------*/
        $(document).on('click', ".iq-waves-effect", function(e) {
            // Remove any old one
            $('.ripple').remove();
            // Setup
            let posX = $(this).offset().left,
                posY = $(this).offset().top,
                buttonWidth = $(this).width(),
                buttonHeight = $(this).height();

            // Add the element
            $(this).prepend("<span class='ripple'></span>");


            // Make it round!
            if (buttonWidth >= buttonHeight) {
                buttonHeight = buttonWidth;
            } else {
                buttonWidth = buttonHeight;
            }

            // Get the center of the element
            let x = e.pageX - posX - buttonWidth / 2;
            let y = e.pageY - posY - buttonHeight / 2;


            // Add the ripples CSS and start the animation
            $(".ripple").css({
                width: buttonWidth,
                height: buttonHeight,
                top: y + 'px',
                left: x + 'px'
            }).addClass("rippleEffect");
        });

       /*---------------------------------------------------------------------
        Sidebar Widget
        -----------------------------------------------------------------------*/
       
        $(document).on("click", '.iq-menu > li > a', function() {
            $('.iq-menu > li > a').parent().removeClass('active');
            $(this).parent().addClass('active');
        });
       
        /*---------------------------------------------------------------------
        Page FAQ
        -----------------------------------------------------------------------*/
        $('.iq-accordion .iq-accordion-block .accordion-details').hide();
        $('.iq-accordion .iq-accordion-block:first').addClass('accordion-active').children().slideDown('slow');
        $(document).on("click", '.iq-accordion .iq-accordion-block', function() {
            if ($(this).children('div.accordion-details ').is(':hidden')) {
                $('.iq-accordion .iq-accordion-block').removeClass('accordion-active').children('div.accordion-details ').slideUp('slow');
                $(this).toggleClass('accordion-active').children('div.accordion-details ').slideDown('slow');
            }
        });
        
        /*---------------------------------------------------------------------
        Page Loader
        -----------------------------------------------------------------------*/
        $("#load").fadeOut();
        $("#loading").delay().fadeOut("");

        

       /*---------------------------------------------------------------------
       Owl Carousel
       -----------------------------------------------------------------------*/
        $('.owl-carousel').each(function() {
            let jQuerycarousel = $(this);
            jQuerycarousel.owlCarousel({
                items: jQuerycarousel.data("items"),
                loop: jQuerycarousel.data("loop"),
                margin: jQuerycarousel.data("margin"),
                nav: jQuerycarousel.data("nav"),
                dots: jQuerycarousel.data("dots"),
                autoplay: jQuerycarousel.data("autoplay"),
                autoplayTimeout: jQuerycarousel.data("autoplay-timeout"),
                navText: ["<i class='fa fa-angle-left fa-2x'></i>", "<i class='fa fa-angle-right fa-2x'></i>"],
                responsiveClass: true,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: jQuerycarousel.data("items-mobile-sm"),
                        nav: false,
                        dots: true
                    },
                    // breakpoint from 480 up
                    480: {
                        items: jQuerycarousel.data("items-mobile"),
                        nav: false,
                        dots: true
                    },
                    // breakpoint from 786 up
                    786: {
                        items: jQuerycarousel.data("items-tab")
                    },
                    // breakpoint from 1023 up
                    1023: {
                        items: jQuerycarousel.data("items-laptop")
                    },
                    1199: {
                        items: jQuerycarousel.data("items")
                    }
                }
            });
        });

        /*---------------------------------------------------------------------
        Search input
        -----------------------------------------------------------------------*/
        $(document).on('click', function(e) {
            let myTargetElement = e.target;
            let selector, mainElement;
            if ($(myTargetElement).hasClass('search-toggle') || $(myTargetElement).parent().hasClass('search-toggle') || $(myTargetElement).parent().parent().hasClass('search-toggle')) {
                if ($(myTargetElement).hasClass('search-toggle')) {
                    selector = $(myTargetElement).parent();
                    mainElement = $(myTargetElement);
                } else if ($(myTargetElement).parent().hasClass('search-toggle')) {
                    selector = $(myTargetElement).parent().parent();
                    mainElement = $(myTargetElement).parent();
                } else if ($(myTargetElement).parent().parent().hasClass('search-toggle')) {
                    selector = $(myTargetElement).parent().parent().parent();
                    mainElement = $(myTargetElement).parent().parent();
                }
                if (!mainElement.hasClass('active') && $(".navbar-list li").find('.active')) {
                    $('.navbar-list li').removeClass('iq-show');
                    $('.navbar-list li .search-toggle').removeClass('active');
                }

                selector.toggleClass('iq-show');
                mainElement.toggleClass('active');

                e.preventDefault();
            } else if ($(myTargetElement).is('.search-input')) {} else {
                $('.navbar-list li').removeClass('iq-show');
                $('.navbar-list li .search-toggle').removeClass('active');
            }
        });

        /*---------------------------------------------------------------------
        Scrollbar
        -----------------------------------------------------------------------*/
        let Scrollbar = window.Scrollbar;
        if ($('#sidebar-scrollbar').length) {
            Scrollbar.init(document.querySelector('#sidebar-scrollbar'), options);
        }
        let Scrollbar1 = window.Scrollbar;
        if ($('#right-sidebar-scrollbar').length) {
            Scrollbar1.init(document.querySelector('#right-sidebar-scrollbar'), options);
        }



        /*---------------------------------------------------------------------
        Counter
        -----------------------------------------------------------------------*/
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });

        /*---------------------------------------------------------------------
        slick
        -----------------------------------------------------------------------*/
        $('.slick-slider').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 9,
            slidesToScroll: 1,
            focusOnSelect: true,
            responsive: [{
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '30',
                    slidesToShow: 3
                }
            }, {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '15',
                    slidesToShow: 1
                }
            }],
            nextArrow: '<a href="#" class="ri-arrow-left-s-line left"></a>',
            prevArrow: '<a href="#" class="ri-arrow-right-s-line right"></a>',
        });
      
        $('.top-rated-item').slick({
            slidesToShow: 4,
            speed: 300,
            slidesToScroll: 1,
            focusOnSelect: true,
             appendArrows: $('#top-rated-item-slick-arrow'),
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3
                }
            },{
                breakpoint: 798,
                settings: {
                    slidesToShow: 2
                }
            },{
                breakpoint: 480,
                settings: {
                    arrows: false,
                    autoplay:true,
                    slidesToShow: 1
                }
            }],
        });

        $('#newrealease-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: true,
          centerPadding: false,
          variableWidth: true ,
          infinite: true,
          focusOnSelect: true,
          autoplay: false,
          slidesToShow: 7,
          slidesToScroll: 1,
          
          
        });

       $("#newrealease-slider .slick-active.slick-center").prev('.slick-active').addClass('temp');
        $("#newrealease-slider .slick-active.temp").prev().addClass('temp-1');
        $("#newrealease-slider .slick-active.temp-1").prev().addClass('temp-2');

         $("#newrealease-slider .slick-active.slick-center").next('.slick-active').addClass('temp-next');
        $("#newrealease-slider .slick-active.temp-next").next().addClass('temp-next-1');
        $("#newrealease-slider .slick-active.temp-next-1").next().addClass('temp-next-2');

         $("#newrealease-slider").on("afterChange", function (){
          var slick_index = $(".slick-active.slick-center").data('slick-index');
          
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-1)+'"]').addClass('temp');
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-2)+'"]').addClass('temp-1');
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-3)+'"]').addClass('temp-2');

          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+1))+'"]').addClass('temp-next');
          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+2))+'"]').addClass('temp-next-1');
          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+3))+'"]').addClass('temp-next-2');


        });

        $("#newrealease-slider").on("beforeChange", function (){
          var slick_index = $(".slick-active.slick-center").data('slick-index');
          
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-1)+'"]').removeClass('temp');
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-2)+'"]').removeClass('temp-1');
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-3)+'"]').removeClass('temp-2');

          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+1))+'"]').removeClass('temp-next');
          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+2))+'"]').removeClass('temp-next-1');
          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+3))+'"]').removeClass('temp-next-2');

        });

        $('#favorites-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: false,
          autoplay: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('#similar-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: false,
          autoplay: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('#single-similar-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: false,
          autoplay: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('#trendy-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: false,
          autoplay: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('#description-slider').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '#description-slider-nav'
        });

        $('#description-slider-nav').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          asNavFor: '#description-slider',
          dots: false,
          arrows: false,
          infinite: true,
          vertical: true,
          centerMode: false,
          focusOnSelect: true
        });

       /*---------------------------------------------------------------------
      Select 2 Dropdown
    -----------------------------------------------------------------------*/


   if ($('select').hasClass('season-select')) {

        $('select').select2({
          theme: 'bootstrap4',
          allowClear: false 
        });
      }
   


        /*---------------------------------------------------------------------
        Progress Bar
        -----------------------------------------------------------------------*/
        $('.iq-progress-bar > span').each(function() {
            let progressBar = $(this);
            let width = $(this).data('percent');
            progressBar.css({
                'transition': 'width 2s'
            });

            setTimeout(function() {
                progressBar.appear(function() {
                    progressBar.css('width', width + '%');
                });
            }, 100);
        });


        /*---------------------------------------------------------------------
        Page Menu
        -----------------------------------------------------------------------*/
        $(document).on('click', '.wrapper-menu', function() {
            $(this).toggleClass('open');
        });

        $(document).on('click', ".wrapper-menu", function() {
            $("body").toggleClass("sidebar-main");
        });
        


        /*---------------------------------------------------------------------
        Wow Animation
        -----------------------------------------------------------------------*/
        let wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        wow.init();


        
        /*---------------------------------------------------------------------
        Form Validation
        -----------------------------------------------------------------------*/

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);

      /*---------------------------------------------------------------------
       Active Class for Pricing Table
       -----------------------------------------------------------------------*/
      $("#my-table tr th").click(function () {
        $('#my-table tr th').children().removeClass('active');
        $(this).children().addClass('active');
        $("#my-table td").each(function () {
          if ($(this).hasClass('active')) {
            $(this).removeClass('active')
          }
        });
        var col = $(this).index();
        $("#my-table tr td:nth-child(" + parseInt(col + 1) + ")").addClass('active');
      });

        /*------------------------------------------------------------------
        Flatpicker
        * -----------------------------------------------------------------*/
      if ($('.date-input').hasClass('basicFlatpickr')) {
          $('.basicFlatpickr').flatpickr();
          $('#inputTime').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
          });
          $('#inputDatetime').flatpickr({
            enableTime: true
          });
          $('#inputWeek').flatpickr({            
            weekNumbers: true
          });          
      }
        
        /*---------------------------------------------------------------------
           Scroll up menu
        -----------------------------------------------------------------------*/
        var position = $(window).scrollTop();
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            //  console.log(scroll);
            
            if(scroll < position) {
                 $('.tab-menu-horizontal').addClass('menu-up');
                 $('.tab-menu-horizontal').removeClass('menu-down');
            } 
            else {
                $('.tab-menu-horizontal').addClass('menu-down');
                $('.tab-menu-horizontal').removeClass('menu-up');
            }
            if(scroll == 0)
            {
                $('.tab-menu-horizontal').removeClass('menu-up');
                $('.tab-menu-horizontal').removeClass('menu-down');
            }
            position = scroll;
        });


        /*---------------------------------------------------------------------
           checkout
        -----------------------------------------------------------------------*/
        $(document).ready(function(){
            $('#place-order').click(function(){
                $('#cart').removeClass('show');
                $('#address').addClass('show');
            });
            $('#deliver-address').click(function(){
                $('#address').removeClass('show');
                $('#payment').addClass('show');
            });
        });

      /*---------------------------------------------------------------------
      image-upload
      -----------------------------------------------------------------------*/

      $('.form_gallery-upload').on('change', function() {
          var length = $(this).get(0).files.length;
          var galleryLabel  = $(this).attr('data-name');

          if( length > 1 ){
            $(galleryLabel).text(length + " files selected");
          } else {
            $(galleryLabel).text($(this)[0].files[0].name);
          }
        });

 /*---------------------------------------------------------------------
    video
      -----------------------------------------------------------------------*/
      $(document).ready(function(){
      $('.form_video-upload input').change(function () {
        $('.form_video-upload p').text(this.files.length + " file(s) selected");
      });
    });
        /*---------------------------------------------------------------------
        Button 
        -----------------------------------------------------------------------*/

        $('.qty-btn').on('click',function(){
          var id = $(this).attr('id');

          var val = parseInt($('#quantity').val());

          if(id == 'btn-minus')
          {
            if(val != 0)
            {
              $('#quantity').val(val-1);
            }
            else
            {
              $('#quantity').val(0);
            }

          }
          else
          {
            $('#quantity').val(val+1);
          }
        });

        
    });

})(jQuery);