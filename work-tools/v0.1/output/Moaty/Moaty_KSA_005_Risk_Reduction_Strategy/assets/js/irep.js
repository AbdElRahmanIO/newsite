var HLV = HLV || {};

HLV = {
	veevaLinks: function() {
		// Look for data-jumpto attribute (added by Grunt task) and set localStorage item
		$('a[data-jumpto]').on('click',function(e) {
			e.preventDefault();
			e.stopPropagation();
			localStorage.setItem('jumpto', $(this).data('jumpto'));
			window.location = $(this).attr('href');
		});
	},
	jumpTo: function(slideN) {
		// This may need adjusting depending on which version of CLI you are using
		CLI.Slides.cRealX = parseInt(slideN);
		var scrollX =- CLI.Slides.oScroller.pageWidth * (CLI.Slides.cRealX-1); // -1 because of zero index
		CLI.Slides.oScroller.currentPage = CLI.Slides.cPageX = parseInt(CLI.Slides.cRealX-1); // -1 because of zero index
		CLI.Slides.oScroller.scrollTo(scrollX,0);
		// Unset jumpto
		localStorage.removeItem('jumpto');
	},
	init: function () {
		var jumpToSlide = localStorage.getItem('jumpto');
		
		this.veevaLinks();

		if(jumpToSlide) {
			// Wait for page to render
			setTimeout(function() {
				HLV.jumpTo(jumpToSlide);
			},250);
		}

		if($('#Slides article').length) {

			$('#Slides article').first().bind('swipeRight', function(e) {
				window.location = 'veeva:prevSlide()';
			});

			$('#Slides article').last().bind('swipeLeft', function(e) {
				window.location = 'veeva:nextSlide()';
			});
		}
	}
}, $(function() {
	HLV.init();
});