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


    
});

Route::post('conversations','App\Http\Controllers\ConversationController@store')->middleware('auth:sanctum');
Route::get('conversations','App\Http\Controllers\ConversationController@index')->middleware('auth:sanctum');


// <!-- The core Firebase JS SDK is always required and must be listed first -->
// <script src="https://www.gstatic.com/firebasejs/8.2.8/firebase-app.js"></script>

// <!-- TODO: Add SDKs for Firebase products that you want to use
//      https://firebase.google.com/docs/web/setup#available-libraries -->
// <script src="https://www.gstatic.com/firebasejs/8.2.8/firebase-analytics.js"></script>

// <script>
//   // Your web app's Firebase configuration
//   // For Firebase JS SDK v7.20.0 and later, measurementId is optional
//   var firebaseConfig = {
//     apiKey: "AIzaSyCi__UdANWo7bDvTFCGOEtXvMIoDSxscZg",
//     authDomain: "live-chat-4014a.firebaseapp.com",
//     projectId: "live-chat-4014a",
//     storageBucket: "live-chat-4014a.appspot.com",
//     messagingSenderId: "357072404378",
//     appId: "1:357072404378:web:2f0b4b73e3d4b9a0ea4423",
//     measurementId: "G-NG59Q52QD7"
//   };
//   // Initialize Firebase
//   firebase.initializeApp(firebaseConfig);
//   firebase.analytics();
// </script>
//AAAAUyMsf5o:APA91bESJLSyDnb50jKJ7V6NA9ojkboCb_Q31mQoS3FbjS2Maed4F0GfHSX9SGj-aN0SpG9rHJxKfW14XCCZIw1reyXfEM032KdZnx8ZNc5pBLZFq80WNG7qbQ_f8uK7ShSYy92PKQeI	
