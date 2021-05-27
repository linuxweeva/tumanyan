<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct() {
        $this -> middleware( 'admin' );
    }
    public function index() {
        $authors = Author::all();
        $data = [
            'authors' => $authors,
        ];
        return view( 'admin.authors.index' , $data );
    }
    public function create() {
        return view( 'admin.authors.create' );
    }
    public function store(Request $request) {
        $input = $request -> except( '_token' );
        $author = Author::create( $input );
        return redirect() -> route( 'authors.index' ) -> withStatus( __( 'Success' ) );
    }
    public function edit(Author $author)  {
        $data = [
            'author' => $author
        ];
        return view( 'admin.authors.edit' , $data );
    }

    public function update(Request $request, Author $author) {
        $input = $request -> except( '_token' , '_method' );
        $id = $request -> id;
        $author = Author::findOrFail( $id ) -> update( $input );
        return redirect() -> route( 'authors.index' ) -> withStatus( __( 'Success' ) );
    }

    public function delete( $id ) {
        Author::find( $id ) -> delete();
        return redirect() -> back() -> withStatus( __( 'Success' ) );
    }
}
