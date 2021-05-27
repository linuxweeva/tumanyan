<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function __construct() {
        $this -> middleware( 'admin' );
    }
    public function index () {
        $users = User::where( 'id' , '!=' , Auth::user() -> id ) -> get();
        $data = [
            'users' => $users
        ];
        return view( 'admin.users.index' , $data );
    }
    public function create() {
        return view( 'admin.users.create' );
    }
    public function store(Request $request) {
        $input = $request -> except( '_token' );
        $user = User::create( $input );
        return redirect() -> route( 'users.index' ) -> withStatus( __( 'Success' ) );
    }
    public function edit(User $user)  {
        $data = [
            'user' => $user
        ];
        return view( 'admin.users.edit' , $data );
    }

    public function update(Request $request, User $user) {
        $input = $request -> except( '_token' , '_method' );
        $id = $request -> id;
        $book = User::findOrFail( $id ) -> update( $input );
        return redirect() -> route( 'users.index' ) -> withStatus( __( 'Success' ) );
    }

    public function delete( $id ) {
        User::find( $id ) -> delete();
        return redirect() -> back() -> withStatus( __( 'Success' ) );
    }
}
