$(document).ready(function(){
    $('.realisation-products').owlCarousel({
        margin:0,
        nav:true,
        dots:false,
        autoplayTimeout:8000,
        autoplayHoverPause:false,
        responsive:{
        0:{
            items:2
        },
        450:{
            items:3
        },
        650:{
            items:4
        },
        991:{
            items:4
        },
        1200:{
            items:5
        }
    }
    });

    $('.realisation-products-carousel').owlCarousel({
        items:1,
        margin:0,
        nav:true,
        dots:false,
        autoplayTimeout:8000,
        autoplayHoverPause:false,
        navText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"]
    });

    $('.realisation-products .item a').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('.realisation-products .item').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).parent().addClass('current');
		$("#"+tab_id).addClass('current');
    })

    $('.realisation-products .item:first').addClass('current');
    $('.tab-content:first').addClass('current');
});