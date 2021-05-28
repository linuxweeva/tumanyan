<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/admin.php';


Route::post( '/email.subscribe' , [ OtherController::class , 'emailSubscribe' ]); // do not change, used in js, fixed
Route::middleware([ 'locale' ])->group(function () {
	Route::get( '/' , [ HomeController::class , 'index' ]) -> name( 'home' );
	Route::get( '/books/{id}' , [ HomeController::class , 'book' ]) -> name( 'home.books.show' );
	// Route::get('/dashboard', function () {
	//     return view('dashboard');
	// }) -> middleware([ 'auth' ])->name('dashboard');
	// Route::get( '/contact' , [ StaticController::class , 'contact' ]) -> name( 'contact' );
	Route::get( '/dashboard' , [ HomeController::class , 'dashboard' ]);
	// Route::get( '/home' , [ HomeController::class , 'index' ]) -> name( 'home' );
	Route::get( '/set-locale/{locale}' , [ LocaleController::class , 'set' ]) -> name( 'setLocale' );
	Route::get( '/reading-room' , [ HomeController::class , 'readingRoom' ]) -> name( 'reading.room' );
	Route::get( '/about' , [ StaticController::class , 'about' ]) -> name( 'about' );
	Route::get( '/donation' , [ StaticController::class , 'donation' ]) -> name( 'donation' );
	Auth::routes();
});


Route::middleware([ 'locale' , 'auth' ])->group(function () {
	Route::post( 'favorites.toggle' , [ OtherController::class , 'toggle_favorite' ]);
	Route::get( 'account' , [ AccountController::class , 'index' ]) -> name( 'account' );
	Route::get( 'account.library' , [ AccountController::class , 'library' ]) -> name( 'account.library' );
	
	Route::get( 'account.refill' , [ AccountController::class , 'refill' ]) -> name( 'refill' );
	Route::post( 'account' , [ AccountController::class , 'updateAccount' ]) -> name( 'account.update' );
});