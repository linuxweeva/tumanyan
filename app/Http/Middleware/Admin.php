<?php

namespace App\Http\Middleware;

class Admin {

	public function handle ( $request , $next ) {
        if ( auth() -> user() && auth() -> user() -> role === 'admin' ) {
            return $next( $request );
        }
        return redirect() -> route( 'admin.login' );
	}

}