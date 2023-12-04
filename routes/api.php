<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegistrationApiController;
use App\Http\Controllers\Api\ProductApiController;



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
    // country list
    Route::get('countries', [RegistrationApiController::class, 'countries']);
    Route::post('statesliist', [RegistrationApiController::class, 'statesliist']);
    Route::post('citiesliist', [RegistrationApiController::class, 'citiesliist']);
    Route::post('registration', [RegistrationApiController::class, 'register']);
    Route::post('verifyOTP', [RegistrationApiController::class, 'verifyOTP']);
    Route::post('login', [RegistrationApiController::class, 'login']);
    Route::post('resendcode', [RegistrationApiController::class, 'resendcode']);
    Route::post('forgotpassword', [RegistrationApiController::class, 'forgotpassword']);
    Route::post('resetpassword', [RegistrationApiController::class,'resetpassword']);
    Route::post('changepassword', [RegistrationApiController::class, 'changepassword']);
    // add edit and delete user address
    Route::post('adduseraddress', [RegistrationApiController::class, 'adduseraddress']);
    Route::post('edituseraddress', [RegistrationApiController::class, 'editUserAddress']);
    Route::post('removeuseraddrss', [RegistrationApiController::class, 'removeuseraddrss']);
    Route::get('myaddress', [RegistrationApiController::class, 'getUserAddresses']);

    Route::post('user/notify', [RegistrationApiController::class, 'toggleNotifyOn']);
    // profile update api.
    Route::post('profileupdate', [RegistrationApiController::class, 'profileupdate']);
    Route::get('profiledetail', [RegistrationApiController::class, 'profiledetail']);
    // homepage api.
    Route::post('homepage', [ProductApiController::class, 'homepage']);
    Route::post('categories', [ProductApiController::class, 'categories']);
    Route::post('productlistbasedproject', [ProductApiController::class, 'productlistbasedproject']);
    Route::post('projectlistbasedauction', [ProductApiController::class, 'projectlistbasedauction']);
    Route::post('projectlistbasedcategory', [ProductApiController::class, 'projectlistbasedcategory']);




    Route::post('productdetail', [ProductApiController::class, 'getProductDetail']);
     // wishlist related api 
    Route::post('addtowishlist', [ProductApiController::class,'addOrRemoveFromWishlist']);
    Route::get('myWishlist', [ProductApiController::class,'myWishlist']);
    // help support

    Route::post('help-support', [ProductApiController::class, 'helpsupport']);
    Route::post('bidrequest', [ProductApiController::class, 'bidrequest']);


    


 
});

