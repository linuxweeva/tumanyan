<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Favorite;
use App\Models\Book;
use Auth;

class OtherController extends Controller
{
    //
    public function toggle_favorite ( Request $req ) {
		$validated = $req -> validate([
			'id' => 'required|numeric',
		]);
		$book = Book::findOrFail( $req -> id );
		$bookId = $req -> input( 'id' );
		$data = [
			'user_id' => auth() -> user() -> id,
			'book_id' => $bookId,
		];
		$record = Favorite::where( $data ) -> first();
		if ( $record !== null ) {
			$record -> delete();
		} else {
			Favorite::create( $data );
		}
		return response() -> json([ 'status' => 'success' ] , 200 );
    }
    public function emailSubscribe ( Request $req ) {
		$validated = $req -> validate([
			'email' => 'required|email|max:255|min:5',
		]);
    	$email = $validated[ 'email' ];
    	if ( null === Subscription::whereEmail( $email ) -> first() ) {
	    	$subscription = new Subscription;
	    	$subscription -> email = $email;
	    	if ( Auth::check() ) {
	    		$userId = auth() -> user() -> id;
	    		if ( Subscription::whereUserId( $userId ) -> count() > 3 ) { // no adequate user wants to subscribe with all of his emails
	    			exit;
	    		}
	    		$subscription -> user_id = $userId;
	    	}
	    	$subscription -> save();
    	}
    	return response() -> json([ 'status' => 'success' ]);
    }
}
