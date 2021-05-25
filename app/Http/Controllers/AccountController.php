<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this -> middleware( 'auth' );
    }


    public function index () {
        $user = Auth::user();
        $data = [
            'user' => $user
        ];
        return view( 'account.index' , $data );
    }
    public function updateAccount ( Request $req ) {
        $user = Auth::user();
        $updateData = $req -> only([
            'name' ,
            'last_name',
            'phone',
            'email',
            'password'
        ]);
        if ( $updateData[ 'password' ] === $user -> password ) unset( $updateData[ 'password' ] );
        User::whereId( $user -> id ) -> update( $updateData );
        return redirect() -> route( 'account' );
        return $this -> index();
        return view( 'account.index' );
    }

    public function library () {
        return view( 'account.library' );
    }

    public function refill () {
        return redirect( 'https://www.inecobank.am/hy/Individual' );
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
