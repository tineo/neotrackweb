<?php

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::resource('tracking', 'TrackingController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('tienda', 'TiendaController',
    ['only' => ['index', 'store','create', 'update', 'destroy', 'show']]);