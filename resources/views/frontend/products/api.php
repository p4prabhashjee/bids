<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\Subscription;

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
Route::get('privacy-policy', [HomeController::class, 'privacy_policy']);
Route::get('terms-conditions', [HomeController::class, 'terms_conditions']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('forgot-password', [UserController::class, 'forgot_password']);
Route::post('match-otp', [UserController::class, 'match_otp']);
Route::post('forgot-match-otp', [UserController::class, 'forgot_match_otp']);
Route::post('resend_otp',[UserController::class, 'resend_otp']);
Route::post('reset-password', [UserController::class, 'reset_password']);
Route::get('notification', [UserController::class, 'notification']);
Route::get('notification_delete', [UserController::class, 'notification_delete']);

Route::middleware('auth:api')->group( function () {
	
	Route::post('home', [HomeController::class, 'index']);
	Route::get('category', [HomeController::class, 'category']);
	Route::get('user-profile', [UserController::class, 'user_profile']);
	Route::post('change-password', [UserController::class, 'change_password']);
	Route::post('edit-profile', [UserController::class, 'update_profile']);
	Route::get('logout', [UserController::class, 'logout']);
	Route::get('delete-account', [UserController::class, 'delete_account']);


	Route::get('faq', [HomeController::class, 'faq']);
	Route::post('chat_gpt', [HomeController::class, 'chat_gpt']);
	Route::get('chat_history', [HomeController::class, 'chat_history']);
	Route::post('descover_detail', [HomeController::class, 'discover_detail']);
	Route::get('subscription_plan', [Subscription::class, 'index']);
	Route::post('buy_plan', [Subscription::class, 'buy_plan']);
	Route::get('my_plan', [Subscription::class, 'my_plan']);
	Route::get('transaction_History', [Subscription::class, 'transaction_History']);
	Route::get('suggestion_category', [HomeController::class, 'suggestion_category']);
	Route::post('suggestion', [HomeController::class, 'suggestion']);
	
});

