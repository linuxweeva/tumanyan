<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Subscriptions extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this -> data = $data;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // return $this -> markdown( 'mail.subscriptions_markdown' )->with( $this -> data );
        return $this -> view( 'mail.subscriptions' )->with([
            'content' => $this -> data[ 'content' ]
        ]) -> subject( env( "SUBSCRIPTION_MAIL_SUBJECT" ) );
    }
}
