$(document).ready(function(){
	
	$('.project-slider').owlCarousel({
	  	loop:true,
	    margin:0,
	    nav:false,
		autoplay:true,
		dots:false,
		autoplayTimeout:8000,
		autoplayHoverPause:false,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn',		
		navText: ["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	});
	
});