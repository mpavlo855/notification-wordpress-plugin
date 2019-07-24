(function($) {

	var __ = wp.i18n.__;

	$( document ).ready( function() {

		// Copy the url

		var merge_tag_clipboard = new Clipboard( '#notification-story code' );

		merge_tag_clipboard.on( 'success', function(e) {

		    var $code     = $( e.trigger ),
			    copy_text = $code.find( 'span' ).text();

			$code.find( 'span' ).text( __( 'Copied', 'notification' ) );

			setTimeout( function() {
				$code.find( 'span' ).text( copy_text );
			}, 800 );

		} );

	} );

})(jQuery);
