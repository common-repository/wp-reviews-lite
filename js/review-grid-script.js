jQuery(window).load(function(){
	jQuery('.review-grid-item-wrapper').removeClass('review-grid-loading');
	jQuery('.review-grid-inner').isotope({
		layoutMode: 'packery',
	    itemSelector: '.review-grid-item',
	    packery: {
	    	columnWidth: '.review-grid-item'
		},
		percentPosition: true
	});
});