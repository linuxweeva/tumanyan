<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Favorite;
use App\Helpers\Helper;
use Illuminate\Auth\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    public function getCreatedAttribute() {
        return date( env( 'DATE_SHOW_FORMAT' , 'Y-m-d H' ) , strtotime( $this -> created_at ) );
    }
    public function favorites() {
        return $this -> hasMany( Favorite::class , 'user_id' , 'id' );
    }
    public function getFavoritesListAttribute() {
        return $this -> favorites() -> pluck( 'book_id' ) -> toArray();
    }
    public function hasFavorite( $bookId ) {
        return in_array( $bookId , $this -> favoritesList );
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function sendPasswordResetNotification( $token ) {
    //     Helper::sendResetPasswordEmail( $token , $token );
    // }
    // public function sendEmailVerificationNotification() {
    //     dd(new VerifyEmail($this));
    //     $this -> notify( new VerifyEmail );
    // }

}
