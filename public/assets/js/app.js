var API = {
	email_subscribe: '/email.subscribe',
	favorites_toggle: '/favorites.toggle',
}
$( function() {
	function initee() {
		handleFavorites();
		handleCarousel();
		formResponsive();
		handleTelInput();
		handleEmailSubscription();
	}
	function handleFavorites () {
		// var container = $( '.book-home-page-list-container' );
		var el = $( '.fa-star' );
		if ( ! el || ! el.length ) return;
		// if ( ! container || ! container.length ) return;
		el.on( 'click' , function() {
			$( this ).toggleClass( 'text-warning text-secondary' );
			// FILTERS
			var parentForm = $( this ).closest( 'form' );
			if ( ! parentForm || ! parentForm.length ) return;
			var filterActive = $( this ).hasClass( 'text-warning' ) ? 'true' : 'false';
			parentForm.find( 'input[name="favorite"]' ).val( filterActive );
			// FILTERS
		});
		// container.on( 'click' , '.toggle-favorite' , function() {
		$( '.book-home-page-list-wrapper' ).on( 'click' , function ( e ) {
			if ( $( e.target ).is( '.toggle-favorite' ) ) {
				e.preventDefault();
				var that = $( e.target );
				var id = that.data( 'id' );
				if ( ! id ) return;
				$.post( API.favorites_toggle , { id: id } ).done(function( res ) {
					// that.toggleClass( 'text-warning text-secondary' );
				})
				.fail(function( err ) {
					Alert( translate( "There was an error" ) );
				})
				.always( function() {
					that.toggleClass( 'rotated' );
				});
			}
		});
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


function handleEmailSubscription() {
	var subscriptionForm = $( '#email_subscription_form' );
	var saveEmail = function( subscriptionForm ) {
		subscriptionForm.find( 'input' ).attr( 'disabled' , true );
		var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
		var emailVal = subscriptionForm.find( 'input' ).val();
		var isValidEmail = reg.test( emailVal );
		if ( ! isValidEmail ) {
			subscriptionForm.find( 'input' ).attr( 'disabled' , false );
			Alert( translate( "There was an error" ) );
			return;
		};
		$.post( API.email_subscribe , { email: emailVal }).done(function( res ) {
			subscriptionForm.find( 'input' ).val( '' );
			subscriptionForm.find( 'input' ).attr( 'disabled' , true );
			subscriptionForm.off( 'click keydown' );
			Alert( translate( 'email.thanks' ) , 'success' );
		})
		.fail(function( res ) {
			subscriptionForm.find( 'input' ).attr( 'disabled' , false );
			Alert( translate( "There was an error" ) );
		})
	}
	subscriptionForm.on( 'click' , 'button' , function() {
		saveEmail( subscriptionForm );
	});
	subscriptionForm.on( 'keydown' , 'input' , function( e ) {
		if ( e.which == 13 ) {
			saveEmail( subscriptionForm );
		}
	});
}
