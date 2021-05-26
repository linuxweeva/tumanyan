<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function filter( $req ) {
        $books = Book::all();
        // FILTER
        return $books;
    }
    public function book( $id ) {
        $data = [
            'book' => Book::findOrFail( $id ),
        ];
        return view( 'books.show' , $data );
    }
    public function index( Request $req ) {
        $books = $this -> filter( $req );
        $data = [
            'books' => $books
        ];
        return view( 'home' , $data );
    }
    public function dashboard()
    {
        return redirect() -> route( 'home' );
    }
}
