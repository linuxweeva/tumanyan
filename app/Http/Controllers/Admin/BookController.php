<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Section;
use App\Models\Language;
use App\Models\Type;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware( 'admin' );
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
        $resp[ 'authors' ] = Author::all();
        $resp[ 'sections' ] = Section::all();
        $resp[ 'languages' ] = Language::all();
        $resp[ 'types' ] = Type::all();
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
        $input = $req -> except( '_token' , 'pdf_url' );
        Book::create( $input );
        dd($input);
        return redirect() -> route( 'books.index' );
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
