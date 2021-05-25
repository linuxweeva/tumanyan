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
        $sections = Section::all();
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
        $book = Book::create( $input );
        return redirect() -> route( 'sections.index' );
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
        return redirect() -> route( 'sections.index' );
    }

    public function delete( $id ) {
        Section::find( $id ) -> delete();
        return redirect() -> back();
    }
}
