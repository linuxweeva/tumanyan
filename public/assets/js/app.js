$( function() {
	function initee() {
		handleCarousel();
		formResponsive();
		handleTelInput();
	}
	function handleTelInput() {
		var input = $( '[name="phone"]' );
		if ( ! input || ! input.length ) return;
		var intl;
		var country = $( '[name="lang"]' ).val() || 'am';
		country = country === 'en' ? 'us' : country;
		loadCss( "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css" );
		$.getScripts(
			[
				'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
				"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"
			]
			, function( data, textStatus, jqxhr ) {
		  	intl = intlTelInput( input[ 0 ] , {
				initialCountry: country,
				formatOnDisplay: true,
				hiddenInput: "phone_number",
				utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.min.js"
			});
			setTimeout( function() {
				var mask = $( '[name="phone"]' ).attr( 'placeholder' ).replace( /[0-9]/g , 0 );
				$( '[name="phone"]' ).mask( mask );
			} , 1000 );
		  	input.on( 'change keyup' , function() {
		  		var isValid = intl.isValidNumber();
		  		console.log(isValid)
		  	});
		  	input.closest( 'form' ).on( 'submit' , function( e ) {
		  		if ( ! intl.isValidNumber() && input.val().length ) {
		  			e.preventDefault();
		  			input.addClass( 'is-invalid' );
		  		}
		  	});
		});
	}
	function formResponsive() {
		var form = $( '.account-container form' );
		if ( ! form || ! form.length ) return;
		var width = $( window ).width();
		if ( width < 768 ) return;
		var longest = 0;
		form.find( 'label' ).each(function () {
			var width = $( this ).width();
			if ( width < 20 ) return;
			longest = Math.max( longest , width );	
		});
		form.find( 'label' ).each(function () {
			$( this ).width( longest );
		});
	}
	function handleCarousel() {
		if ( $( '.owl-carousel' ) ) {
			$.getScript( "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js", function( data, textStatus, jqxhr ) {
			  	$( '.owl-carousel' ).owlCarousel({
			        loop: true,
			        center: true,
			        margin: 10,
			        nav: true ,
			        items: 1
			    });
			});
		}
	}
	initee();
});


function loadCss( link ) {
	var rand = parseInt( Math.random() * 1000 );
	$( "head" ).append( "<link id='id_" + rand + "' href='" + link + "' type='text/css' rel='stylesheet' />" );
}

$.getScripts = function( arr , cb ) {
	$.getScript( arr[ 0 ] , function( data, textStatus, jqxhr ) {
		$.getScript( arr[ 1 ] , function( data, textStatus, jqxhr ) {
			cb( data, textStatus, jqxhr );
		});
	});
}