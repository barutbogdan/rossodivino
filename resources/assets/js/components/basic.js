// require('../modules/jquery.magnific-popup.min');
require('../modules/jquery.magnific-popup.min.js');

$(document).ready(function(){
	
	$('.magnific').magnificPopup({
		type: 'image',
		gallery: {
            enabled: true,
        }
	});
	
	$(window).on('scroll', function(){
		var scroll = $(window).scrollTop();
		var top_header = $('header .top-header').outerHeight();
		if(scroll > top_header){
			$('header').addClass('fix');
		} else{
			$('header').removeClass('fix');
		}
	});
	

	if($(window).width() > 991) {
		$('.inner-wrap').mCustomScrollbar();
		// if($('.inner-wrap').outerHeight() > 710) {
		// 	$(this).addClass('is-changed');
		// }
	}


	$('.btn-scroll-top').on('click', function(){
	 	$("html, body").animate({ scrollTop: 0 }, "slow");
	});
	
	$('header .hamburger').on('click', function(){
		$('header nav').addClass('active');
	});
	
	$('nav .fa').click(function(){
		$('nav .dropdown').slideToggle();
	});
	$('.close-menu').click(function(){
		$('nav').removeClass('active');
	});

	var url = window.location.href;
	
	if(url.indexOf("/nl") >= 0){
		$('.lang li').each(function(index, value){
			if($(value).find('a').attr('title') == 'NL'){
				$(value).addClass('active');
			} else{
				$(value).removeClass('active');
			}
		});
	} else {
		$('.languages li').each(function(index, value){
			if($(value).find('a').attr('title') == 'FR'){
				$(value).addClass('active');
			}
		});
	}
	
	$('.testimonials-slider').owlCarousel({
		items: 1,
	  	loop:true,
	    margin:30,
	    nav:false,
		autoplay:true,
		autoplayTimeout:8000,
		autoplayHoverPause:false,		
		navText: ["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"],
	});
	
	$(window).ready(function(){
		$('.main-content').addClass('active');
		//$('.main-inner').addClass('active');
	});
	$('.back-content').click(function() {
		$('.main-content').removeClass('active');
		//$('.main-inner').removeClass('active');
		
	});

	//popup formular
	$('.main-btn-aside, .contact-formular').click(function(){
		$('.contact-popup-formular').addClass('active');
	})
	$('.close-pop').click(function(){
		$('.contact-popup-formular').removeClass('active');
	})
	//end popup formular

	//alert();
});