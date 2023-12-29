<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::post('login', 'App\Http\Controllers\API\UserController@login');
Route::post('register', 'App\Http\Controllers\API\UserController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('addFeedback', 'App\Http\Controllers\FeedbackController@store');
    Route::post('addComment', 'App\Http\Controllers\CommentController@store');
    Route::get('getFeedback', 'App\Http\Controllers\FeedbackController@index');

    Route::resource('items', 'App\Http\Controllers\ItemsController');
    Route::post(
        '/dynamic-items',
        'App\Http\Controllers\ItemDetailsController@store'
    );
});
