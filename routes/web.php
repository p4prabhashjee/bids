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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/google', [SocialController::class,'redirectToGoogle']);
Route::get('/login/google/callback', [SocialController::class,'handleGoogleCallback']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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



});

require __DIR__.'/auth.php';