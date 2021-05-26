<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
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
}
