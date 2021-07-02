$(document).ready(function(){
	$('.about-us .tabs li').on('click', function(){
		$(this).addClass('active').siblings().removeClass('active');
		var trigger = $(this).attr('data-tab');
		$('.about-us .txt').each(function(index, value){
			if($(value).attr('data-area') == trigger){
				$(value).removeClass('d-none');
			} else{
				$(value).addClass('d-none');
			}
		});
	});
});