( function( $ ){
	wp.customize('magazinepress_options_main_nav_background',function( value ) {
		value.bind(function(to) {
			$('#header').css('background-color', to ? '#' + to : '' );
		});
	});
	wp.customize( 'some_setting', function( value ) {
		value.bind( function( to ) {
			$( '#top' ).html( to );
		} );
	} );
	wp.customize( 'themename_color_scheme', function( value ) {
		value.bind( function( to ) {
			$( '#access' ).css('background-color', to );
		} );
	} );
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			$( '#leftcol' ).html( to );
		} );
	} );

} )( jQuery )
