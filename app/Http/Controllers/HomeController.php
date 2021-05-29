<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use Route;
use App\Helpers\PdfHelper;
use App\Models\Book;
use App\Models\Section;
use App\Models\Language;
use App\Models\Author;

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
    protected function getFilterDetails ( $key , $val ) {
        switch( $key ) {
            case ( 'section_id' ):
                $section = Section::find( $val );
                if ( null !== $section ) {
                    return $section;
                } else {
                    return Section::whereDeleted( 0 )->first();                    
                }
                break;
            case ( 'author_id' ):
                $author = Author::find( $val );
                if ( null !== $author ) {
                    return $author;
                } else {
                    return Author::whereDeleted( 0 )->first();                    
                }
                break;
            case ( 'language_id' ):
                $language = Language::find( $val );
                if ( null !== $language ) {
                    return $language;
                } else {
                    return Language::whereDeleted( 0 )->first();                    
                }
                break;
            default:
                return [];
        }
    }
    protected function filter( $req ) {
            // $books = Book::orderBy( 'id' , "DESC" ) -> paginate( self::LIMIT );
            // return $books;
        $filtersResp = [];
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
                        $filtersResp[ $key ] = $this -> getFilterDetails( $key , $val );
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
        if ( ( \Route::currentRouteName() === 'account.library' || ( $req -> has( 'favorite' ) && $req -> input( 'favorite' ) == 'true' ) ) && Auth::check() ) {
            // $filtersResp[ 'favorite' ] = 'true'; // no need
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
        return [ $books , $filtersResp ];
    }
    public function book( $id ) {
        $data = [
            'book' => Book::findOrFail( $id ),
        ];
        return view( 'books.show' , $data );
    }
    public function index( Request $req ) {
        $resp = $this -> filter( $req );
        $books = $resp[ 0 ];
        $filters = $resp[ 1 ];
        $data = [
            'books' => $books,
            'filters' => $filters
        ];
        return view( 'home' , $data );
    }
    public function account_library( Request $req ) {
        $resp = $this -> filter( $req );
        $books = $resp[ 0 ];
        $filters = $resp[ 1 ];
        $data = [
            'books' => $books,
            'filters' => $filters
        ];
        return view( 'account.library' , $data );
    }
    public function dashboard()
    {
        return redirect() -> route( 'home' );
    }
}
