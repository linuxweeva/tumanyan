<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use Auth;

Route::group([ 'prefix' => 'admin', 'middleware' => [ 'locale' , 'guest' ] ] , function () {
	Route::get( 'log-in' , [ AdminController::class , 'loginView' ]) -> name( 'admin.login' );
	Route::post( 'log-in' , [ AdminController::class , 'login' ]) -> name( 'admin.login' );
});
Route::group([ 'prefix' => 'admin', 'middleware' => [ 'admin' , 'locale' ] ] , function () {
	Route::get( '/' , [ AdminController::class , 'home' ]) -> name( 'admin.home' );
	// OTHER
	Route::post( '/upload-pdf' , [ FileController::class , 'uploadPdf' ]) -> name( 'admin.uploadPdf' );
	Route::get( 'translations' , [ TranslationController::class , 'index' ]) -> name( 'admin.translations' );
	Route::post( 'translations' , [ TranslationController::class , 'update' ]);
	// OTHER
	// RESOURCES
	Route::resource( 'users' , UserController::class );
	Route::resource( 'books' , BookController::class );
	Route::resource( 'authors' , AuthorController::class );
	Route::resource( 'types' , TypeController::class );
	Route::resource( 'languages' , LanguageController::class );
	Route::resource( 'sections' , SectionController::class );
	Route::resource( 'subscriptions' , SubscriptionController::class );
	// RESOURCES
	// CUSTOM DELETE ROUTES
	Route::get( '/users.delete/{id}' , [ UserController::class , 'delete' ]) -> name( 'users.delete' );
	Route::get( '/books.delete/{id}' , [ BookController::class , 'delete' ]) -> name( 'books.delete' );
	Route::get( '/authors.delete/{id}' , [ AuthorController::class , 'delete' ]) -> name( 'authors.delete' );
	Route::get( '/types.delete/{id}' , [ TypeController::class , 'delete' ]) -> name( 'types.delete' );
	Route::get( '/languages.delete/{id}' , [ LanguageController::class , 'delete' ]) -> name( 'languages.delete' );
	Route::get( '/sections.delete/{id}' , [ SectionController::class , 'delete' ]) -> name( 'sections.delete' );
	// CUSTOM DELETE ROUTES
	// CUSTOM ROUTES
	// CUSTOM ROUTES
});