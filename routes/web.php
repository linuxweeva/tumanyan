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


Route::middleware([ 'locale' ])->group(function () {
	Route::get( '/' , [ HomeController::class , 'index' ]);
	Route::get('/dashboard', function () {
	    return view('dashboard');
	})->middleware(['auth'])->name('dashboard');
	Route::get( '/contact' , [ StaticController::class , 'contact' ]) -> name( 'contact' );
	Route::get( '/home' , [ HomeController::class , 'index' ]) -> name( 'home' );
	Route::get( '/set-locale/{locale}' , [ LocaleController::class , 'set' ]) -> name( 'setLocale' );
	Auth::routes();
});