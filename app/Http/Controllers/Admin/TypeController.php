<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct() {
        $this -> middleware( 'admin' );
    }
    public function index() {
        $types = Type::all();
        $data = [
            'types' => $types,
        ];
        return view( 'admin.types.index' , $data );
    }
    public function create() {
        return view( 'admin.types.create' );
    }
    public function store(Request $request) {
        $input = $request -> except( '_token' );
        $book = Book::create( $input );
        return redirect() -> route( 'types.index' );
    }
    public function edit(Type $type)  {
        $data = [
            'type' => $type
        ];
        return view( 'admin.types.edit' , $data );
    }

    public function update(Request $request, Type $type) {
        $input = $request -> except( '_token' , '_method' );
        $id = $request -> id;
        $book = Type::findOrFail( $id ) -> update( $input );
        return redirect() -> route( 'types.index' );
    }

    public function delete( $id ) {
        Type::find( $id ) -> delete();
        return redirect() -> back();
    }
}
