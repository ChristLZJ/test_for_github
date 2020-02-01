(function($) {
	"use strict";
	$('.carousel').carousel({
		interval: 5000
	}).on('slide.bs.carousel', function(e) {
		var nextH = $(e.relatedTarget).outerHeight();
		$(this).find('.active.item').parent().animate({ height: nextH }, 500);
	});

	// Smooth Hash Link Scroll
	$('.smooth-scroll').click(function() {
		if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {

			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});

		$(".projects .col-xs-6").slice(0, 6).show();
		$("#loadmore").on('click', function (e) {
			console.log('test');

			e.preventDefault();
			$(".projects .col-xs-6:hidden").slice(0, 3).slideDown();
			if ($(".projects .col-xs-6:hidden").length === 0) {
				$("#loadmore").fadeOut('slow');
			}
		});



})(jQuery);
