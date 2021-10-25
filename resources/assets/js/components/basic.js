// require('../modules/jquery.magnific-popup.min');
require('../modules/jquery.magnific-popup.min.js');

$(document).ready(function(){
	
	$('.magnific').magnificPopup({
		type: 'image',
		gallery: {
            enabled: true,
        }
	});

	$('.btn_mobile_menu').on('click', function(){
		$(this).toggleClass('opened');
		$('header .mobile_menu_wrapper').slideToggle();
	});
	
});