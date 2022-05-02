/*
Template: Streamit - Responsive Bootstrap 4 Template
Author: iqonicthemes.in
Design and Developed by: iqonicthemes.in
NOTE: This file contains the styling for responsive Template.
*/

/*----------------------------------------------
Index Of Script
------------------------------------------------

:: Sticky Header Animation & Height
:: Back to Top
:: Header Menu Dropdown
:: Slick Slider
:: Owl Carousel
:: Page Loader
:: Mobile Menu Overlay
:: Equal Height of Tab Pane
:: Active Class for Pricing Table
:: Select 2 Dropdown
:: Video Popup
:: Flatpicker
:: Custom File Uploader

------------------------------------------------
Index Of Script
----------------------------------------------*/

(function (jQuery) {
	"use strict";
	$(document).ready(function() {

		function activaTab(pill) {
			$(pill).addClass('active show');
		}

		/*---------------------------------------------------------------------
			Sticky Header Animation & Height
		----------------------------------------------------------------------- */
		function headerHeight() {
			var height = $("#main-header").height();
			$('.iq-height').css('height', height + 'px');
		}
		$(function() {
			var header = $("#main-header"),
				yOffset = 0,
				triggerPoint = 80;

			headerHeight();

			$(window).resize(headerHeight);
			$(window).on('scroll', function() {

				yOffset = $(window).scrollTop();

				if (yOffset >= triggerPoint) {
					header.addClass("menu-sticky animated slideInDown");
				} else {
					header.removeClass("menu-sticky animated slideInDown");
				}

			});
		});
		
		/*---------------------------------------------------------------------
			Back to Top
		---------------------------------------------------------------------*/
		var btn = $('#back-to-top');
		$(window).scroll(function () {
			if ($(window).scrollTop() > 50) {
				btn.addClass('show');
			} else {
				btn.removeClass('show');
			}
		});
		btn.on('click', function (e) {
			e.preventDefault();
			$('html, body').animate({ scrollTop: 0 }, '300');
		});

		/*---------------------------------------------------------------------
			Header Menu Dropdown
		---------------------------------------------------------------------*/
		$('[data-toggle=more-toggle]').on('click', function() {
			$(this).next().toggleClass('show');
		});

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
					$('.navbar-right li').removeClass('iq-show');
					$('.navbar-right li .search-toggle').removeClass('active');
				}

				selector.toggleClass('iq-show');
				mainElement.toggleClass('active');

				e.preventDefault();
			} else if ($(myTargetElement).is('.search-input')) {} else {
				$('.navbar-right li').removeClass('iq-show');
				$('.navbar-right li .search-toggle').removeClass('active');
			}
		});

		/*---------------------------------------------------------------------
			Slick Slider
		----------------------------------------------------------------------- */
		if($('#top-ten-slider').length) {
			$('#top-ten-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '#top-ten-slider-nav',
				responsive: [
				{
					breakpoint: 992,
					settings: {
					asNavFor: false,
					arrows: true,
					nextArrow: '<button class="NextArrow"><i class="ri-arrow-right-s-line"></i></button>',
					prevArrow: '<button class="PreArrow"><i class="ri-arrow-left-s-line"></i></button>',
					}
				}
				]
			});
		}
		
		if($('#top-ten-slider-nav').length) {
			$('#top-ten-slider-nav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '#top-ten-slider',
				dots: false,
				arrows: true,
				infinite: true,
				vertical:true,
				verticalSwiping: true,
				centerMode: false,
				nextArrow:'<button class="NextArrow"><i class="ri-arrow-down-s-line"></i></button>',
				prevArrow:'<button class="PreArrow"><i class="ri-arrow-up-s-line"></i></button>',
				focusOnSelect: true,
				responsive: [		    
					{
					breakpoint: 1200,
					settings: {
						slidesToShow: 2,
					}
					},
					{
						breakpoint: 600,
						settings: {
							asNavFor: false,
						}
					},
				]
			});
		}
			
		if($('#episodes-slider2').length) {
			$('#episodes-slider2').slick({
				dots: false,
				arrows: true,
				infinite: true,
				speed: 300,
				autoplay: false,
				slidesToShow: 4,
				slidesToScroll: 1,
				responsive: [
				{
					breakpoint: 1024,
					settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					dots: true,
					}
				},
				{
					breakpoint: 600,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 480,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					}
				}
				]
			});
		}
		
		if($('#episodes-slider3').length) {
			$('#episodes-slider3').slick({
				dots: false,
				arrows: true,
				infinite: true,
				speed: 300,
				autoplay: false,
				slidesToShow: 4,
				slidesToScroll: 1,
				responsive: [
				{
					breakpoint: 1024,
					settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					dots: true,
					}
				},
				{
					breakpoint: 600,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 480,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					}
				}
				]
			});
		}
			
		if($('#trending-slider').length) {
			$('#trending-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,		 
				arrows: false,
				fade: true,
				asNavFor: '#trending-slider-nav',	
			});
		}
			
		if($('#trending-slider-nav').length) {
			$('#trending-slider-nav').slick({
				slidesToShow: 5,
				slidesToScroll: 1,
				asNavFor: '#trending-slider',
				dots: false,
				arrows: false,
				infinite: true,
				centerMode: true,
				centerPadding:0,
				focusOnSelect: true,
				responsive: [
				{
					breakpoint: 1024,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 600,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}
		
		if($('#tvshows-slider').length) {
			$('#tvshows-slider').slick({
				centerMode: true,
				centerPadding: '200px',
				slidesToShow: 1,
				nextArrow: '<button class="NextArrow"><i class="ri-arrow-right-s-line"></i></button>',
				prevArrow: '<button class="PreArrow"><i class="ri-arrow-left-s-line"></i></button>',
				arrows:true,
				dots:false,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '20px',
							slidesToShow: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '20px',
							slidesToShow: 1
						}
					}
				]
			});
		}
		

		/*---------------------------------------------------------------------
			Owl Carousel
		----------------------------------------------------------------------- */
		if($('.episodes-slider1').length) {
			$('.episodes-slider1').owlCarousel({
				loop:true,
				margin:20,
				nav:true,
				navText: ["<i class='ri-arrow-left-s-line'></i>", "<i class='ri-arrow-right-s-line'></i>"],
				dots:false,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:4
					}
				}
			});
		}

		/*---------------------------------------------------------------------
			Page Loader
		----------------------------------------------------------------------- */
		$("#load").fadeOut();
		$("#loading").delay(0).fadeOut("slow");
		
		$('.widget .fa.fa-angle-down, #main .fa.fa-angle-down').on('click', function () {
			$(this).next('.children, .sub-menu').slideToggle();
		});

		/*---------------------------------------------------------------------
			Mobile Menu Overlay
		----------------------------------------------------------------------- */
		$(document).on("click", function(event){
	    var $trigger = $(".main-header .navbar");
	    if($trigger !== event.target && !$trigger.has(event.target).length){
			$(".main-header .navbar-collapse").collapse('hide');
			$('body').removeClass('nav-open');
	    }            
		});
		$('.c-toggler').on("click", function(){
			$('body').addClass('nav-open');
		}); 

		/*---------------------------------------------------------------------
			Equal Height of Tab Pane
		-----------------------------------------------------------------------*/		
		$('.trending-content').each(function () {			
			var highestBox = 0;			
			$('.tab-pane', this).each(function () {				
				if ($(this).height() > highestBox) {
					highestBox = $(this).height();
				}
			});			 
			$('.tab-pane', this).height(highestBox);
		}); 

		/*---------------------------------------------------------------------
	 		Active Class for Pricing Table
  	 	-----------------------------------------------------------------------*/
		$("#my-table tr th").on("click", function (){
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
		
		/*---------------------------------------------------------------------
			Select 2 Dropdown
		-----------------------------------------------------------------------*/
		if ($('select').hasClass('season-select')){
			$('select').select2({
				theme: 'bootstrap4',
				allowClear: false,
				width: 'resolve'
			});
		}
		if ($('select').hasClass('pro-dropdown')) {			
			$('.pro-dropdown').select2({
				theme: 'bootstrap4',			
				minimumResultsForSearch: Infinity,			
				width: 'resolve'
			});	
			$('#lang').select2({
				theme: 'bootstrap4',
				placeholder: 'Language Preference',
				allowClear: true,
				width: 'resolve'
			});
		}

		/*---------------------------------------------------------------------
			Flatpicker
		-----------------------------------------------------------------------*/
		if ($('.date-input').hasClass('basicFlatpickr')) {
			$('.basicFlatpickr').flatpickr();
		}
		/*---------------------------------------------------------------------
			Custom File Uploader
		-----------------------------------------------------------------------*/
		$(".file-upload").on("change", function () {
			! function (e) {
				if (e.files && e.files[0]) {
					var t = new FileReader;
					t.onload = function (e) {
						$(".profile-pic").attr("src", e.target.result)
					}, t.readAsDataURL(e.files[0])
				}
			}(this)
		}), $(".upload-button").on("click", function () {
			$(".file-upload").click();
		});
	});
})(jQuery);