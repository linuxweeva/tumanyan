<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use App\Helpers\PdfHelper;
use App\Models\Book;

class HomeController extends Controller
{
    const LIMIT = 10;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function filter( $req ) {
            // $books = Book::orderBy( 'id' , "DESC" ) -> paginate( self::LIMIT );
            // return $books;
        $filters = $req -> only([
            // 'book_id',
            'section_id',
            'author_id',
            'language_id',
            'publish_info',
        ]);
        $filtered = false;
        $books = new Book;
        if ( count( $filters ) ) {
            foreach ( $filters as $key => $val ) {
                if ( $val && strlen( $val ) ) {
                    $filtered = true;
                    if ( in_array( $key , [ 'section_id' , 'author_id' , 'language_id' ]) ) {
                        $books = $books -> where( $key , $val );
                    } else {
                        $val = strtolower( $val );
                        $books = $books -> 
                        where(function ( $query ) use ( $val ) {
                            $query->
                            where( 'publish_info_am' , "LIKE" , "%{$val}%" )->
                            orWhere( 'publish_info_ru' , "LIKE" , "%{$val}%" )->
                            orWhere( 'publish_info_en' , "LIKE" , "%{$val}%" );
                        });
                    }
                }
            }
        }
        if ( $req -> has( 'favorite' ) && $req -> input( 'favorite' ) == 'true' && Auth::check() ) {
            $filtered = true;
            $books = $books -> whereIn( 'id' , Auth::user() -> favoritesList );
        }
        if ( $filtered ) {
            $books = $books -> orderBy( 'id' , 'DESC' ) -> paginate( self::LIMIT );
        }
        if ( ! $filtered ) {
            $books = Book::orderBy( 'id' , "DESC" ) -> paginate( self::LIMIT );
        }
        if ( $filtered && ! count( $books ) ) {
            $books = [];
        }
        return $books;
    }
    public function book( $id ) {
        $data = [
            'book' => Book::findOrFail( $id ),
        ];
        return view( 'books.show' , $data );
    }
    public function index( Request $req ) {
        $books = $this -> filter( $req );
        $data = [
            'books' => $books
        ];
        return view( 'home' , $data );
    }
    public function dashboard()
    {
        return redirect() -> route( 'home' );
    }
}
