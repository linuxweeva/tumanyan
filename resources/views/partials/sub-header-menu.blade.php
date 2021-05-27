<div>
	<div class="d-flex row justify-content-center mb-2 mb-md-0">
		<a href="/" class="btn btn-primary mx-md-2 mx-2 col-3 col-md my-1 my-md-3">{{ __( "Home" ) }}</a>
		<a href="{{ route( 'reading.room' ) }}" class="btn btn-primary mx-md-2 mx-2 col-3 col-md my-1 my-md-3">{{ __( "Reading room" ) }}</a>
		<a target="_blank" href="http://www.toumanian.am/{{ App::isLocale( 'am' ) ? 'arm' : App::currentLocale() }}" class="btn btn-primary mx-md-2 mx-2 col-3 col-md my-1 my-md-3">{{ __( "Museum" ) }}</a>
		<a href="{{ route( 'about' ) }}" class="btn btn-primary mx-md-2 mx-2 col-3 col-md my-1 my-md-3">{{ __( "About us" ) }}</a>
		<a href="{{ route( 'donation' ) }}" class="btn btn-primary mx-md-2 mx-2 col-3 col-md my-1 my-md-3">{{ __( "Donation" ) }}</a>
		<a target="_blank" href="http://www.toumanian.am/{{ App::isLocale( 'am' ) ? 'arm' : App::currentLocale() }}/contact" class="btn btn-primary mx-md-2 mx-2 col-3 col-md my-1 my-md-3">{{ __( "Contact us" ) }}</a>
	</div>
</div>