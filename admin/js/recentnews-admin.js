(function( $ ) {
	'use strict';

	(function() {
		tinymce.PluginManager.add('recentnews_button', function( ed, url ) {
			ed.addButton( 'recentnews_button', {
				text: '[__]',
				tooltip: 'Add Recent Posts shortcode',
				onclick: function() {
					ed.windowManager.open( {
						title: 'Insert Recent Post shortcode',
						body: [{
							type: 'textbox',
							name: 'count',
							label: 'How many posts?'
						}],
						onsubmit: function( e ) {
							var count = e.data.count, shortcode;
							if (parseInt(count)) {
								shortcode = '[recentnews count="' + parseInt(count) + '"/]';
							} else {
								shortcode = '[recentnews /]';
							}
							ed.execCommand('mceInsertContent', 0, shortcode);
						}
					});
				}
			});
		});
	})();

})( jQuery );
