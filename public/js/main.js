'use strict';

$(window).on('load', function(){
	/*Preloader*/
	$(".loader").fadeOut();
	$("#preloader").delay(400).fadeOut("slow");
});

(function ($) {
	
/*toggle nav-switch section*/
$('.nav-switch').on('click',function(event) {
		$(this).toggleClass('active');
		$('.nav-wrap').slideToggle(400);
		event.preventDefault();
});

/*set background image for section*/
$('.set-bg').each(function() {
	var bg = $(this).data('setbg');
	$(this).css('background-image', 'url('+ bg + ')');
});

/*News carousel */

$('.news-sliders').owlCarousel ({
	loop:true,
	nav:false,
	dots:false,
	margin:128,
	center:true,
	items:1,
	mouseDrag: true,
	animateIn: 'fadeInRight',
	animateOut: 'fadeOutLeft',
	autoplay:true
});
	
})(jQuery);



