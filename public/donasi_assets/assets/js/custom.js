(function ($) {
	'use strict';
	jQuery(document).on('ready', function () {

		// Mean Menu
		jQuery('.mean-menu').meanmenu({
			meanScreenWidth: "991"
		});

		// Preloader
		jQuery(window).on('load', function () {
			$('.preloader').fadeOut();
		});

		// Header Sticky
		$(window).on('scroll', function () {
			if ($(this).scrollTop() > 150) {
				$('.navbar-area').addClass("is-sticky");
			}
			else {
				$('.navbar-area').removeClass("is-sticky");
			}
		});

		// Campaing Wrap
		$('.campaing-wrap').owlCarousel({
			loop: true,
			nav: false,
			autoplay: true,
			autoplayHoverPause: true,
			mouseDrag: true,
			center: false,
			dots: true,
			smartSpeed: 1500,
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 2
				},
				992: {
					items: 3
				},
				1200: {
					items: 3
				}
			}
		});

		// Project Slider
		$('.project-slider').owlCarousel({
			loop: true,
			nav: false,
			autoplay: true,
			autoplayHoverPause: true,
			mouseDrag: true,
			center: false,
			dots: true,
			smartSpeed: 1500,
			margin: 20,
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 3
				},
				992: {
					items: 3
				},
				1200: {
					items: 3
				}
			}
		});

		// Testimonial Wrap
		$('.testimonial-wrap').owlCarousel({
			loop: true,
			nav: false,
			autoplay: true,
			autoplayHoverPause: true,
			mouseDrag: true,
			dots: false,
			smartSpeed: 1500,
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 2
				},
				992: {
					items: 3
				},
				1200: {
					items: 3
				}
			}
		});

		// Partner Wrap
		$('.partner-wrap').owlCarousel({
			loop: true,
			nav: false,
			autoplay: true,
			autoplayHoverPause: true,
			mouseDrag: true,
			center: true,
			margin: 20,
			dots: false,
			smartSpeed: 1500,
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 3
				},
				992: {
					items: 4
				},
				1200: {
					items: 5
				}
			}
		});

		// Go to Top
		// Scroll Event
		$(window).on('scroll', function () {
			var scrolled = $(window).scrollTop();
			if (scrolled > 300) $('.go-top').addClass('active');
			if (scrolled < 300) $('.go-top').removeClass('active');
		});

		// Click Event
		$('.go-top').on('click', function () {
			$("html, body").animate({ scrollTop: "0" }, 500);
		});

		// FAQ Accordion
		$('.accordion').find('.accordion-title').on('click', function () {
			// Adds Active Class
			$(this).toggleClass('active');
			// Expand or Collapse This Panel
			$(this).next().slideToggle('fast');
			// Hide The Other Panels
			$('.accordion-content').not($(this).next()).slideUp('fast');
			// Removes Active Class From Other Titles
			$('.accordion-title').not($(this)).removeClass('active');
		});




		// Odometer 
		$('.odometer').appear(function (e) {
			var odo = $(".odometer");
			odo.each(function () {
				var countNumber = $(this).attr("data-count");
				$(this).html(countNumber);
			});
		});

		// HOME TWO JS

		// Hero Slider
		$('.hero-slider').owlCarousel({
			loop: true,
			margin: 0,
			nav: false,
			mouseDrag: false,
			items: 1,
			dots: true,
			autoHeight: true,
			autoplay: true,
			smartSpeed: 1500,
			autoplayHoverPause: true,
		});

		//Slider Text Animation
		$(".hero-slider-area").on("translate.owl.carousel", function () {
			$(".hero-slider-text span, .hero-slider-text h1, .hero-slider-text .typewrite").removeClass("animated fadeInUp").css("opacity", "0");
			$(".hero-slider-text p").removeClass("animated fadeInDown").css("opacity", "0");
			$(".hero-slider-text a").removeClass("animated fadeInDown").css("opacity", "0");
		});

		$(".hero-slider-area").on("translated.owl.carousel", function () {
			$(".hero-slider-text span, .hero-slider-text h1, .hero-slider-text .typewrite").addClass("animated fadeInUp").css("opacity", "1");
			$(".hero-slider-text p").addClass("animated fadeInDown").css("opacity", "1");
			$(".hero-slider-text a").addClass("animated fadeInDown").css("opacity", "1");
		});

		// Search Popup JS
		$('.close-btn').on('click', function () {
			$('.search-overlay').fadeOut();
			$('.search-btn').show();
			$('.close-btn').removeClass('active');
		});
		$('.search-btn').on('click', function () {
			$(this).hide();
			$('.search-overlay').fadeIn();
			$('.close-btn').addClass('active');
		});

		// Mix JS
		$('#Container').mixItUp();
	});
})(jQuery);


