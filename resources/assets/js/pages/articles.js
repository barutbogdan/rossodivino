$(document).ready(function(){
    $('.blog-carousel').owlCarousel({
        margin:20,
        nav:true,
        dots:false,
        autoplayTimeout:8000,
        autoplayHoverPause:false,
        navText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            450:{
                items:2
            },
            650:{
                items:3
            },
            991:{
                items:2
            },
            1240:{
                items:3
            }
        }
    });
	
});