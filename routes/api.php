<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegistrationApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'API'], function () {
    Route::post('registration', [RegistrationApiController::class, 'register']);
    Route::post('verifyOTP', [RegistrationApiController::class, 'verifyOTP']);
    Route::post('login', [RegistrationApiController::class, 'login']);
    Route::post('resendcode', [RegistrationApiController::class, 'resendcode']);
    Route::post('forgotpassword', [RegistrationApiController::class, 'forgotpassword']);
    Route::post('resetpassword', [RegistrationApiController::class,'resetpassword']);
    Route::post('changepassword', [RegistrationApiController::class, 'changepassword']);
    // add edit and delete user address
    Route::post('adduseraddress', [RegistrationApiController::class, 'adduseraddress']);
    Route::post('edituseraddress/{addressId}', [RegistrationApiController::class, 'editUserAddress']);
    Route::post('removeuseraddrss/{addressId}', [RegistrationApiController::class, 'removeuseraddrss']);
    // profile update api.
    Route::post('profileupdate', [RegistrationApiController::class, 'profileupdate']);
    Route::get('profiledetail', [RegistrationApiController::class, 'profiledetail']);
 
});

