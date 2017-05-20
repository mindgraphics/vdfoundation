/* Theme Customizer enhancements for a better user experience.
Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );


	// Header background image
	wp.customize( 'header_image', function( value ) {
		value.bind( function( to ) {
			$( ".site-header-bg" ).css( 'background-image', 'url(' + to + ')' );
		} );
	} );


	// Header background opacity
	wp.customize( 'vdproduction_bg_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.site-header .background-effect' ).css( 'opacity', to );
		} );
	} );


	// Header title color
	wp.customize( 'vdproduction_title_color', function( value ) {
		value.bind( function( to ) {
			$( '.hero-title h2' ).css( 'color', to );
		} );
	} );


	// Header subtitle color
	wp.customize( 'vdproduction_subtitle_color', function( value ) {
		value.bind( function( to ) {
			$( '.hero-title h3, .hero-title p' ).css( 'color', to );
		} );
	} );


	// Homepage header button
	wp.customize( 'vdproduction_header_button_one_text', function( value ) {
		value.bind( function( to ) {

			var buttonTitle = $( '.hero-title .button-one' ).attr( 'title' );

			if ( to ) {
				$( '.hero-title .button-one' ).text( to );
			} else {
				$( '.hero-title .button-one' ).text( buttonTitle );;
			}

		} );
	} );


	// Homepage header button two
	wp.customize( 'vdproduction_header_button_two_text', function( value ) {
		value.bind( function( to ) {

			var buttonTwoTitle = $( '.hero-title .button-two' ).attr( 'title' );

			if ( to ) {
				$( '.hero-title .button-two' ).text( to );
			} else {
				$( '.hero-title .button-two' ).text( buttonTwoTitle );
			}

		} );
	} );


	// Homepage header button one color
	wp.customize( 'vdproduction_header_button_one_color', function( value ) {
		value.bind( function( to ) {
			$( '.button-one' ).css( 'background', to );
		} );
	} );


	// Homepage header button two color
	wp.customize( 'vdproduction_header_button_two_color', function( value ) {
		value.bind( function( to ) {
			$( '.button-two' ).css( 'background', to );
		} );
	} );


	// Header nav color
	wp.customize( 'vdproduction_nav_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation a' ).css( 'color', to );
		} );
	} );


	// Header and footer background color
	wp.customize( 'vdproduction_header_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header, .site-footer' ).css( 'background', to );
		} );
	} );

} )( jQuery );
