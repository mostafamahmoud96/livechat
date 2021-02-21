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

Route::middleware('auth:api')->group(function () {
    Route::post('messages','App\Http\Controllers\MessageController@store');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login','App\Http\Controllers\ApiAuthController@login');
    Route::post('register','App\Http\Controllers\ApiAuthController@register');
    Route::post('logout','App\Http\Controllers\ApiAuthController@logout')->middleware('auth:sanctum');
    Route::get('fcm','App\Http\Controllers\UserController@index');
    Route::get('notification','App\Http\Controllers\UserController@sendNotifications');
    Route::post('token', 'App\Http\Controllers\FCMController@index');
    Route::get('home', 'App\Http\Controllers\FCMController@show');
    Route::post('/save-token', 'App\Http\Controllers\UserController@saveToken')->name('save-token');
    Route::post('/send-notification','App\Http\Controllers\NotificationController@send')->name('send.notification');
});

Route::post('conversations','App\Http\Controllers\ConversationController@store')->middleware('auth:sanctum');
Route::get('conversations','App\Http\Controllers\ConversationController@index')->middleware('auth:sanctum');