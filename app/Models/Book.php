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
    protected function getFirstPage ( $path , $id , $type = "full" ) {
        $output_format = env( "PAGE_FORMAT" );
        $prefix = env( "PAGE_PREFIX" );
        $check1 = "{$path}/{$prefix}-0001.{$output_format}";
        $check2 = "{$path}/{$prefix}-001.{$output_format}";
        $check3 = "{$path}/{$prefix}-01.{$output_format}";
        $check4 = "{$path}/{$prefix}-1.{$output_format}";
        if ( file_exists( $check1 ) ) {
            return env( "APP_URL" ) . env( "PDF_PATH_URL" ) . "/{$id}/{$type}/{$prefix}-0001.{$output_format}";
        }
        if ( file_exists( $check2 ) ) {
            return env( "APP_URL" ) . env( "PDF_PATH_URL" ) . "/{$id}/{$type}/{$prefix}-001.{$output_format}";
        }
        if ( file_exists( $check3 ) ) {
            return env( "APP_URL" ) . env( "PDF_PATH_URL" ) . "/{$id}/{$type}/{$prefix}-01.{$output_format}";
        }
        if ( file_exists( $check4 ) ) {
            return env( "APP_URL" ) . env( "PDF_PATH_URL" ) . "/{$id}/{$type}/{$prefix}-1.{$output_format}";
        }
        return "";
    }
    public function getFirstPagesAttribute() {
        $pathFull = env( 'PDF_PATH' ) . "/{$this->id}/full";
        $pathPartial = env( 'PDF_PATH' ) . "/{$this->id}/partial";
        $pageFull = $this -> getFirstPage( $pathFull , $this -> id );
        $pagePartial = $this -> getFirstPage( $pathPartial , $this -> id , 'partial' );
        $res = [ 'full' => $pageFull , 'partial' => $pagePartial ];
        return array_merge( $res , array_values( $res ) );
    }
    public function getFullPagesAttribute() {
        return $this -> getPages( 'full' );
    }
    public function getPartialPagesAttribute() {
        return $this -> getPages( 'partial' );
    }
    protected function getDimensions( $path , $format ) {
        $cmd = "identify -format '%wx%h' {$path}"; // imagemagick
        $res = exec( $cmd );
        $xpl = explode( 'x' , $res );
        if ( $xpl && is_array( $xpl ) && count( $xpl ) > 1 ) {
            return [ 'width' => $xpl[ 0 ] , 'height' => $xpl[ 1 ] ];
        }
        return [ 'width' => 800 , 'height' => 1200 ];
    }
    protected function getPages( $type = 'full' ) {
        $resp = [];
        $format = env( "PAGE_FORMAT" );
        $path = env( 'PDF_PATH' ) . "/{$this->id}/{$type}";
        $glob = glob( "{$path}/*.{$format}" );
        if ( $glob && is_array( $glob ) && count( $glob ) ) {
            $dimensions = $this -> getDimensions( $glob[ 0 ] , $format );
            foreach ( $glob as $key => $file ) {
                $xpl = explode( env( "PDF_PATH" ) , $file );
                if ( is_array( $xpl ) && $xpl[ 1 ] ) {
                    $absolute_url = env( "APP_URL" ) . env( "PDF_PATH_URL" ) . $xpl[ 1 ];
                } else {
                    $absolute_url = "";
                }
                $resp[] = [
                    [
                    'width' => $dimensions[ 'width' ],
                    'height' => $dimensions[ 'height' ],
                    'uri' => $absolute_url
                ]];
            }
        }
        return $resp;
    }
    public function getCreatedAttribute() {
        return date( env( 'DATE_SHOW_FORMAT' , 'Y-m-d H' ) , strtotime( $this -> created_at ) );
    }
    public function getPdfPartialUrlAttribute() {
    	$file = File::where( 'type_id' , $this -> id ) -> whereType( 'partial' ) -> first();
    	if ( $file ) {
    		return $file -> absolute_url;
    	}
    	return '';
    }
    public function getPdfUrlAttribute() {
        $file = File::where( 'type_id' , $this -> id ) -> whereType( 'full' ) -> first();
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
