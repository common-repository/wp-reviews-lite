jQuery(window).load(function(){
	jQuery('.review-slider-item-wrapper').flexslider({
		animation: 'slide',
		slideshowSpeed: 8000,
		smoothHeight: true,
		animationLoop: true,
		prevText: '',
		nextText: '',
		start: function() {
			function rsSlider(){
				jQuery('.review-slider-item-wrapper').removeClass('rs-loading');
			}
			setTimeout(rsSlider, 2000);
		}
	});
});