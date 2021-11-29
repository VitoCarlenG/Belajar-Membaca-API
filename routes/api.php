<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('latihan', 'Api\LatihanController@index');
    Route::get('latihan/{id}', 'Api\LatihanController@show');
    Route::post('latihan', 'Api\LatihanController@store');
    Route::put('latihan/{id}', 'Api\LatihanController@update');
    Route::delete('latihan/{id}', 'Api\LatihanController@destroy');

    Route::get('note', 'Api\NoteController@index');
    Route::get('note/{id}', 'Api\NoteController@show');
    Route::post('note', 'Api\NoteController@store');
    Route::put('note/{id}', 'Api\NoteController@update');
    Route::delete('note/{id}', 'Api\NoteController@destroy');
});