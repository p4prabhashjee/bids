<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\ContactUsSubjectController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuctiontypeController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BidvalueController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\BidrequestController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ProductWishController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.homepage');
// });
Route::get('/', [HomepageController::class,'homepage'])->name('homepage');
Route::get('contact-us', [HomepageController::class,'contactus'])->name('contact-us');
Route::get('privacy-policy', [HomepageController::class,'privacy'])->name('privacy-policy');
Route::get('terms-conditions', [HomepageController::class,'terms'])->name('terms-conditions');
Route::get('about-us', [HomepageController::class,'about'])->name('about-us');


Route::get('products-list', [HomepageController::class,'productlist'])->name('products-list');
Route::get('/projects/{auction_type_slug}', [HomepageController::class,'projectByAuctionType'])->name('projects.by_auction_type');
Route::get('/products/{slug}', [HomepageController::class,'productsByProject'])->name('productsByProject');
// based on categorys
Route::get('/category/{categories_slug}', [HomepageController::class,'projectByCategory'])->name('projectByCategory');

Route::get('/productsdetail/{slug}', [HomepageController::class,'productsdetail'])->name('productsdetail');
Route::get('signin', [HomepageController::class,'login'])->name('signin');
Route::post('loggedin', [HomepageController::class,'loggedin'])->name('loggedin');
Route::get('register', [HomepageController::class,'registration'])->name('register');
Route::post('registration', [HomepageController::class,'register'])->name('registration');
Route::post('verify-otp', [HomepageController::class,'verifyOTP'])->name('verify-otp');
Route::get('/sendOtpForgetPassword', [HomepageController::class, 'sendOtpForgetPassword'])->name('sendOtpForgetPassword');
Route::get('/verifyOtpForgetPassword', [HomepageController::class, 'verifyOtpForgetPassword'])->name('verifyOtpForgetPassword');
Route::get('/updateNewPassword', [HomepageController::class, 'updateNewPassword'])->name('updateNewPassword');
Route::post('/subscribe', [HomepageController::class, 'subscribe'])->name('subscribe');
Route::post('/contactus', [HomepageController::class, 'contacstus'])->name('contactus');


// Route::get('/login/google', [SocialController::class,'redirectToGoogle']);
// Route::get('/login/google/callback', [SocialController::class,'handleGoogleCallback']);
// user Authenticated
Route::group(['middleware' => 'auth'],function(){
    Route::post('/validate-current-password', [DashboardController::class, 'validateCurrentPassword']);
    Route::get('/userdashboard', [DashboardController::class, 'userdashboard'])->name('userdashboard');
    Route::post('/profileupdate',[DashboardController::class,'profileupdate'])->name('profileupdate');
    Route::get('/logout',[DashboardController::class,'logout']);
    Route::get('/changepassword',[DashboardController::class,'changepassword']);
    Route::post('/change-password',[DashboardController::class,'changePass'])->name('change-password');
    Route::get('/useraddress',[DashboardController::class,'useraddress'])->name('useraddress');
    Route::post('adduseraddress', [DashboardController::class, 'adduseraddress'])->name('adduseraddress');
    Route::get('/addressesdelete/{id}', [DashboardController::class,'delete'])->name('addresses.delete');
    Route::post('/addresses/update/{id}', [DashboardController::class,'update'])->name('addressesupdate');
    Route::get('/getwishlist',[DashboardController::class,'getwishlist'])->name('getwishlist');
    Route::post('/wishlist/add', [ProductWishController::class,'addToWishlist'])->name('addToWishlist');
    Route::post('/wishlist/remove', [ProductWishController::class,'removeFromWishlist'])->name('removeFromWishlist');
    Route::post('/store-bid-request', [DashboardController::class, 'bidstore'])->name('store.bid.request');


});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// admin 
Route::middleware(['user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('get-categories/{auction}', [ProductController::class,'getcategories'])->name('get-categories');
Route::get('get-project/{auction}', [ProductController::class,'getprojects'])->name('get-project');

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('contact-us', ContactUsController::class);
    Route::resource('contact-us-subjects', ContactUsSubjectController::class);
    Route::resource('pages', PageController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::resource('auctiontypes', AuctiontypeController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::resource('bidvalues', BidvalueController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('news', NewsController::class);
    Route::resource('bidrequests', BidrequestController::class);
    Route::post('update-status', [BidrequestController::class, 'updateStatus'])->name('bidrequests.updateStatus');

    
});

require __DIR__.'/auth.php';