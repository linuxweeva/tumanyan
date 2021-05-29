<?php

namespace App\Helpers;
use App\Models\File;

class Helper {
	public static function sendResetPasswordEmail( $data , $token = null ) {
		dd($data,$token);
	}
}