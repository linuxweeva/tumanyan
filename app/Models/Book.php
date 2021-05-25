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
