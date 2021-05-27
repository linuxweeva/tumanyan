<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct() {
        $this -> middleware( 'admin' );
    }
    public function index() {
        $languages = Language::all();
        $data = [
            'languages' => $languages,
        ];
        return view( 'admin.languages.index' , $data );
    }
    public function create() {
        return view( 'admin.languages.create' );
    }
    public function store(Request $request) {
        $input = $request -> except( '_token' );
        $language = Language::create( $input );
        return redirect() -> route( 'languages.index' ) -> withStatus( __( 'Success' ) );
    }
    public function edit(Language $language)  {
        $data = [
            'language' => $language
        ];
        return view( 'admin.languages.edit' , $data );
    }

    public function update(Request $request, Language $language) {
        $input = $request -> except( '_token' , '_method' );
        $id = $request -> id;
        $book = Language::findOrFail( $id ) -> update( $input );
        return redirect() -> route( 'languages.index' ) -> withStatus( __( 'Success' ) );
    }

    public function delete( $id ) {
        Language::find( $id ) -> delete();
        return redirect() -> back() -> withStatus( __( 'Success' ) );
    }
}