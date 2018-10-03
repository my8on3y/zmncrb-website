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

	

