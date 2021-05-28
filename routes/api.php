<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([ 'prefix' => 'autocomplete' ] , function () {
    Route::get( 'books' , [ Api\OtherController::class , 'books' ]) -> name( 'autocomplete.books' );
    Route::get( 'authors' , [ Api\OtherController::class , 'authors' ]) -> name( 'autocomplete.authors' );
    Route::get( 'sections' , [ Api\OtherController::class , 'sections' ]) -> name( 'autocomplete.sections' );
    Route::get( 'languages' , [ Api\OtherController::class , 'languages' ]) -> name( 'autocomplete.languages' );
    Route::get( 'types' , [ Api\OtherController::class , 'types' ]) -> name( 'autocomplete.types' );
    // Route::get( 'publish_info' , [ Api\OtherController::class , 'publish_info' ]) -> name( 'autocomplete.publish_info' );
});