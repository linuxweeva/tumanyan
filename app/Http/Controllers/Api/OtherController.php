<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\Model;
use App\Models\Author;
use App\Models\Language;
use App\Models\Book;
use App\Models\Type;
use App\Models\Section;

class OtherController extends Controller
{
    const LIMIT = 10;
    protected function filter ( $model , Request $req ) {
        $res = [];
        $query = $req -> input( 'search' , '' );
        $locale = $req -> input( 'locale' , 'am' );
        App::setLocale( $locale );
        $query = strtolower( $query );
        if ( strlen( $query ) ) {
            $res = $model::
                    where( "title_{$locale}" , "LIKE" , "%{$query}%" )->
                    where( 'deleted' , 0 )->
                    limit( self::LIMIT )->
                    get();
            if ( $res -> isEmpty() ) {
                $res = $model::
                        where( 'deleted' , 0 )->
                        orWhere(function ( $dbQuery ) use ( $query ) {
                            $dbQuery->
                            where( 'title_am' , "LIKE" , "%{$query}%" )->
                            where( 'title_ru' , "LIKE" , "%{$query}%" )->
                            where( 'title_en' , "LIKE" , "%{$query}%" );
                        })->
                        limit( self::LIMIT )->
                        get();
            }
        } else {
            // $res = $model::take( self::LIMIT )->get();
        }
        if ( ! count( $res ) ) {
            $res = $model::whereDeleted( 0 )->take( self::LIMIT )->get();
        }
        return $this -> convert( $res , $locale );
    }
    public function authors ( Request $req ) {
        return $this -> filter( Author::class , $req );
    }
    public function languages ( Request $req ) {
        return $this -> filter( Language::class , $req );
    }
    public function sections ( Request $req ) {
        return $this -> filter( Section::class , $req );
    }
    public function books ( Request $req ) {
        return $this -> filter( Book::class , $req );
    }
    public function types ( Request $req ) { // admin only? 
        return $this -> filter( Type::class , $req );
    }
    protected function convert( $res , $locale ) {
        $resp = [
            'items' => [],
        ];
        foreach ( $res as $key => $item ) {
            $resp[ 'items' ][] = [
                'id' => $item -> id,
                'text' => $item -> title,
            ];
        }
        return response() -> json( $resp );
    }
}