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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('articles', 'ArticleController@index');
//Route::get('articles/{article}', 'ArticleController@show');
//Route::post('articles', 'ArticleController@store');
//Route::put('articles/{article}', 'ArticleController@update');
//Route::delete('articles/{article}', 'ArticleController@destroy');
Route::resource('articles', 'ArticleController')->middleware('App\Http\Middleware\CheckTest');

Route::post('users', 'UserController@store');
Route::get('users', 'UserController@index')
    ->middleware('App\Http\Middleware\VerifyJWTToken')
    ->middleware('App\Http\Middleware\IsAdmin');
Route::get('users/{id}', 'UserController@show')
    ->middleware('App\Http\Middleware\VerifyJWTToken')
    ->middleware('App\Http\Middleware\IsAdmin');

Route::get('auth/logout', 'AuthenticationController@logout')
    ->middleware('App\Http\Middleware\VerifyJWTToken');
Route::post('auth/login', 'AuthenticationController@login');

Route::resource('products', 'ProductController');

Route::get('upload', 'UploadController@index');
Route::post('upload', 'UploadController@store');
Route::delete('upload', 'UploadController@destroy');
