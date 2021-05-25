<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use Auth;

Route::get( 'admin/log-in' , [ AdminController::class , 'loginView' ]) -> name( 'admin.login' );
Route::post( 'admin/log-in' , [ AdminController::class , 'login' ]) -> name( 'admin.login' );
Route::group([ 'prefix' => 'admin', 'middleware' => [ 'admin' ] ] , function () {
	Route::get( '/' , [ AdminController::class , 'home' ]) -> name( 'admin.home' );
	Route::get( '/users' , [ AdminController::class , 'users' ]) -> name( 'admin.users' );
	Route::resource( 'books' , BookController::class);
	Route::get( '/books.delete/{id}' , [ BookController::class , 'delete' ]) -> name( 'books.delete' );
	Route::post( '/upload-pdf' , [ FileController::class , 'uploadPdf' ]) -> name( 'admin.uploadPdf' );
});