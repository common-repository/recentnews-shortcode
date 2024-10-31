(function( $ ) {
	'use strict';

	$(function() {
		$(".recentnews_title").on('click',function(){
			$('.recentnews_excerpt').each(function(){

				if($(this).is(':visible')) {
					$(this).hide();
				}
			});
			var $excerpt = $(this).next('.recentnews_excerpt');
			$excerpt.toggle();
		});
	});

})( jQuery );

