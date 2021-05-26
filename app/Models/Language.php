<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getCreatedAttribute() {
        return date( env( 'DATE_SHOW_FORMAT' , 'Y-m-d H' ) , strtotime( $this -> created_at ) );
    }
    public function getTitleAttribute() {
    	$locale = \App::currentLocale();
    	switch( $locale ) {
    		case "en":
    			return $this -> title_en;
    		case "am":
    			return $this -> title_am;
    		case "ru":
    			return $this -> title_ru;
    	}
    	return $this -> title_am;
    }
}
