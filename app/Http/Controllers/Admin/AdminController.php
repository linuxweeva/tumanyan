<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home () {
        return view( 'admin.home' );
    }
    public function loginView () {
        return view( 'admin.login' );
    }
    public function users () {
        $users = User::where( 'id' , '!=' , Auth::user() -> id ) -> get();
        $data = [
            'users' => $users
        ];
        return view( 'admin.users' , $data );
    }
    public function login ( Request $req ) {
        $userCheckRole = User::whereEmail( $req -> email ) -> whereRole( 'admin' ) -> first();
        if ( null === $userCheckRole ) {
            return redirect() -> route( 'login' );
        }
        $credentials = $req -> only( 'email' , 'password' );
        if ( Auth::attempt( $credentials ) ) {
            return redirect( '/admin' );
        } else {
            return redirect() -> back() -> withInput( $req -> all() ) -> withErrors([
                'password' => __( 'Incorrect password' )
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
