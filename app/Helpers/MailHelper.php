<?php

namespace App\Helpers;
use Mailgun\Mailgun;

class MailHelper {
    public static function send ( $contact ) {
        $message = self::generateMessage( $contact );
        $mg = Mailgun::create( env( 'MAILGUN_KEY' ) , 'https://api.eu.mailgun.net' );
        $res = $mg->messages()->send( env( 'MAILGUN_DOMAIN' ) , [
            'from'    => env( 'MAILGUN_FROM' ),
            'to'      => env( 'MAILGUN_TO' ) ,
            'subject' => "Request from stockvideos.org contact page",
            'html'    => $message,
            'v:order_id' => (string) 30
        ]);
    }
	public static function reset_password( $data , $token = null ) {
		dd($data,$token);
	}
}