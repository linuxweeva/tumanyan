<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function __construct() {
        $this -> middleware( 'admin' );
    }
    public function index() {
        $sections = Section::whereDeleted( 0 )->get();
        $data = [
            'sections' => $sections,
        ];
        return view( 'admin.sections.index' , $data );
    }
    public function create() {
        return view( 'admin.sections.create' );
    }
    public function store(Request $request) {
        $input = $request -> except( '_token' );
        $section = Section::create( $input );
        return redirect() -> route( 'sections.index' ) -> withStatus( __( 'Success' ) );
    }
    public function edit(Section $section)  {
        $data = [
            'section' => $section
        ];
        return view( 'admin.sections.edit' , $data );
    }

    public function update(Request $request, Section $section) {
        $input = $request -> except( '_token' , '_method' );
        $id = $request -> id;
        $book = Section::findOrFail( $id ) -> update( $input );
        return redirect() -> route( 'sections.index' ) -> withStatus( __( 'Success' ) );
    }

    public function delete( $id ) {
        Section::find( $id ) -> update([ 'deleted' => 1 ]);
        return redirect() -> back() -> withStatus( __( 'Success' ) );
    }
}
