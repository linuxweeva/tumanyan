<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Section;
use App\Models\Language;
use App\Models\Type;
use App\Models\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this -> middleware( 'admin' );
    }
    public function index()
    {
        $books = Book::all();
        $data = [
            'books' => $books,
        ];
        return view( 'admin.books.index' , $data );
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function getMoreData() {
        $resp = [];
        $resp[ 'authors' ] = Author::whereDeleted( 0 )->get();
        $resp[ 'sections' ] = Section::whereDeleted( 0 )->get();
        $resp[ 'languages' ] = Language::whereDeleted( 0 )->get();
        $resp[ 'types' ] = Type::whereDeleted( 0 )->get();
        $resp[ 'generatedId' ] = rand( 455425 , 2355553535353 );
        return $resp;
    }
    public function create()
    {
        $data = $this -> getMoreData();
        return view( 'admin.books.create' , $data );
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req ) {
        // CHECK IF ID EXISTS MOVE FILES ID AND NEW RECORD ID
        $input = $req -> except( 'id' , '_token' , 'pdf_url' , 'pdf_partial_url' , 'image_url' );
        $tmpId = $req -> id;
        $input[ 'price' ] = $input[ 'price' ] ?? 0;
        $book = Book::create( $input );
        $bookId = $book -> id;
        File::where( 'type_id' , $tmpId ) -> update([ 'type_id' => $bookId ]);
        $uploadPath = env( 'PDF_PATH' );
        $cmd = "mv ${uploadPath}/${tmpId} ${uploadPath}/${bookId}";
        $res = exec( $cmd );
        return redirect() -> route( 'books.index' ) -> withStatus( __( 'Success' ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this -> getMoreData();
        $data[ 'book' ] = Book::findOrFail( $id );
        return view( 'admin.books.edit' , $data );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $input = $req -> except( 'id' , '_token' , 'pdf_url' , 'pdf_partial_url' , '_method' , 'image_url' );
        $id = $req -> id;
        $input[ 'price' ] = $input[ 'price' ] ?? 0;
        $book = Book::findOrFail( $id ) -> update( $input );
        // File::where( 'type_id' , $tmpId ) -> update([ 'type_id' => $book -> id ]);
        return redirect() -> route( 'books.index' ) -> withStatus( __( 'Success' ) );
        dd($req->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        Book::find( $id )->delete();
        return redirect() -> back() -> withStatus( __( 'Success' ) );
    }
}
