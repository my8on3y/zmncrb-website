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
	$(document).ready(function(){

			window.customFunction = function() {
				$('#lines').animateNumber({ number: 165 });
			};		
	});


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
			toggle: {
			  visible: 'visible',
			  hidden: 'invisible'
			},
			offset: {
			  x: 0,
			  y: 20
			},
			addHeight: true,
			once: true
		  }, document.body, window);
		}, document.body, window);


