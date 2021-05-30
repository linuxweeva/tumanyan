<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\Subscriptions;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function __construct() {
        $this -> middleware( 'admin' );
    }
    public function index () {
        $subscriptions = Subscription::all();
        $messages = Message::orderBy( 'id' , 'DESC' )->take( 5 ) -> get();
        $data = [
            'subscriptions' => $subscriptions,
            'messages' => $messages
        ];
        return view( 'admin.subscriptions.index' , $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editor( Request $req )
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {
        $content = $req -> input( 'content' );
        $message = new Message;
        $message -> content = $content;
        $message -> save();
        $userIds = $req -> input( 'user_ids' );
        $xpl = explode( ',' , $userIds );
        $data = [
            'content' => $content,
        ];
        $userEmails = User::whereIn( 'id' , $xpl ) -> pluck( 'email' ) -> toArray();
        $firstEmail = array_pop( $userEmails );
        Mail::to( $firstEmail ) -> cc( $userEmails ) -> send( new Subscriptions( $data ) );
        // foreach ( $userEmails as $key => $email ) {
        // }
        return redirect() -> route( 'subscriptions.index' ) -> withStatus( __( 'Message sent' ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
