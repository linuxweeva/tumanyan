<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\Author;
use App\Models\Section;
use App\Models\Language;
use App\Models\Type;


class Book extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getTitleAttribute() {
        $locale = \App::currentLocale();
        switch( $locale ) {
            case "en":
                $resp = $this -> title_en;
                break;
            case "am":
                $resp = $this -> title_am;
                break;
            case "ru":
                $resp = $this -> title_ru;
                break;
        }
        if ( strlen( $resp ) > 1 ) return $resp;
        return $this -> title_am;
    }
    public function getPdfAvailablettribute() {
        return File::where( 'type_id' , $this -> id ) -> whereType( 'pdf' ) -> first() -> absolute_url;
    }
    public function getCreatedAttribute() {
        return date( env( 'DATE_SHOW_FORMAT' , 'Y-m-d H' ) , strtotime( $this -> created_at ) );
    }
    public function getPdfPartialUrlAttribute() {
    	$file = File::where( 'type_id' , $this -> id ) -> whereType( 'pdf_partial' ) -> first();
    	if ( $file ) {
    		return $file -> absolute_url;
    	}
    	return '';
    }
    public function getPdfUrlAttribute() {
        $file = File::where( 'type_id' , $this -> id ) -> whereType( 'pdf' ) -> first();
        if ( $file ) {
            return $file -> absolute_url;
        }
        return '';
    }
    public function getImageUrlAttribute() {
        $file = File::where( 'type_id' , $this -> id ) -> whereType( 'image' ) -> first();
        if ( $file ) {
            return $file -> absolute_url;
        }
        return '';
    }
    public function files(){
        return $this -> hasMany( File::class , 'id' , 'type_id' );
    }
    public function author(){
        return $this -> hasOne( Author::class , 'id' , 'author_id' );
    }
    public function type(){
        return $this -> hasOne( Type::class , 'id' , 'type_id' );
    }
    public function section(){
        return $this -> hasOne( Section::class , 'id' , 'section_id' );
    }
    public function language(){
        return $this -> hasOne( Language::class , 'id' , 'language_id' );
    }

}
