<?php

namespace App\Http\Middleware;

class Locale {

	public function handle ( $request , $next ) {
	    \App::setLocale( $request -> session() -> get( 'locale' , env( 'DEFAULT_LOCALE') ) );
	    // \App::setLocale( session( 'locale' ) );
	    return $next( $request );
	}

}