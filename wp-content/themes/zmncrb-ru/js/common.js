$(function () {
	// Custom JS

	// site-map navigator
	$(document).ready(function () {
		$("#site-map").hover(function () {
			$("#site-map").addClass("active")
		}, function () {
			$("#site-map").removeClass("active")
		});


		// nav-menu
		$(document).ready(function () {
			$setInterval = 100;
			$('#nav-menu li').hover(function () {
				if ($('.sub-menu:hidden')) {
					$(this).children('#nav-menu > li > a').css({
						'background-color': '#fff',
						'color': '#000'
					})
				};
				$(this).find('.sub-menu').stop(false, true).css({
					'display': 'block'
				});
			}, function () {
				if ($('.sub-menu:hidden')) {
					$(this).children('#nav-menu > li > a').css({
						'background-color': 'transparent',
						'color': '#fff'
					})
				};
				$(this).children('#nav-menu > li > .sub-menu').css({
					'display': 'none'
				});
			});
		});
	});


	// nice-scroll plugin 
	$(document).ready(function () {
		$(function () {
			$("body").niceScroll({
				zindex: "auto",
				scrollspeed: 200,
				horizrailenabled: true,
				oneaxismousemode: false,
				cursoropacitymin: 0,
				cursoropacitymax: 0.3
			});
		});
	});

	// PageScroll2id plugin
	(function ($) {
		$(window).on("load", function () {
			$("a[rel='m_PageScroll2id']").mPageScroll2id();
		});
	})(jQuery);


	(function ($) {
		$(window).on("load", function () {
			$('#doc_query_list').mCustomScrollbar({
				theme: 'dark-thick'
			});
		});
	})(jQuery);

	// carousel slick
	$(document).ready(function () {
		$('.main-central-slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 7000
		});
	});
});

// Scroll trigger JS pkugin
document.addEventListener('DOMContentLoaded', function () {
	var trigger = new ScrollTrigger({
		offset: {
			x: 0,
			y: 20
		},
		addHeight: true
	}, );
}, document.body, window);



function triggerStartNum() {
	// include-inform num... animation
	var showStat = false;
	if (!showStat) {
		setTimeout(function () {
			$('#informNum1').animateNumber({
				number: 91
			});
			$('#informNum2').animateNumber({
				number: 260
			});
			$('#informNum3').animateNumber({
				number: 60
			});
			$('#informNum4').animateNumber({
				number: 40
			});
			$('#informNum5').animateNumber({
				number: 2
			});
			$('#informNum6').animateNumber({
				number: 16
			});
		}, 100);
		showStat = true;
	}
};

	//animate.css
	$(document).ready(function(){
		$('.inform-slider-block').addClass('animated fadeInLeft');
		$('.slide_1 h1').addClass('animated fadeIn delay-1s');
		$('.inform-slider-block, .slide_1 h1').css({'visibility' : 'visible'});
});


