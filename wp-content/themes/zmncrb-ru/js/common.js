$(function() {
	// Custom JS

	// site-map navigator
	$(document).ready(function(){
		$("#site-map-toggle-button").on('click', function(){
			$("#site-map").toggleClass("active");
		});
	});
	

	// nav-menu
	$(document).ready(function(){
		$setInterval = 200;
		$('#nav-menu li').hover(function(){
			if($('.sub-menu:hidden')){$(this).children('#nav-menu > li > a').css({'background-color' : '#fff', 'color' : '#000'})};
			$(this).find('.sub-menu').stop(false, true).fadeIn($setInterval);
		}, function(){
			if($('.sub-menu:hidden')){$(this).children('#nav-menu > li > a').css({'background-color' : '#2A3140', 'color' : '#fff'})};
			$(this).children('#nav-menu > li > .sub-menu').fadeOut($setInterval);
		});
	});
});

	
	// nice-scroll plugin 
	$(document).ready(function(){
		$(function() {  
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


	// Number animate
		var triggerStartNum = function(){
			// include-inform num... animation
			var showStat = false;
			if (!showStat){
			setTimeout(function(){
				$('#informNum1').animateNumber({ number: 91 });
				$('#informNum2').animateNumber({ number: 260 });
				$('#informNum3').animateNumber({ number: 60 });
				$('#informNum4').animateNumber({ number: 40 });
				$('#informNum5').animateNumber({ number: 2 });
				$('#informNum6').animateNumber({ number: 16 });
			}, 100); 
			showStat = true;
		}
	};


	// PageScroll2id plugin
	(function($){
		$(window).on("load",function(){
			$("a[rel='m_PageScroll2id']").mPageScroll2id();
		});
	})(jQuery);


// (function($){
// 	$(window).on("load",function(){
// 		$('body').mCustomScrollbar({
// 			theme: 'minimal'
// 		});
// 	});
// })(jQuery);

	// Scroll trigger JS pkugin
	document.addEventListener('DOMContentLoaded', function(){
		var trigger = new ScrollTrigger({
			offset: {
			  x: 0,
			  y: 20
			},
			addHeight: true
		  },);
		}, document.body, window);


	$(document).ready(function(){
		$('.autoplay').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 5000,
		  });
		});	