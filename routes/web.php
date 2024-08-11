<?php

use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/login/password-request', function () {
    return view('auth.step2resetpasscode');
})->name('password.request');

//Register 
Route::get('/register/terms&conditions', function () {
    return view('auth.terms&conditions');
})->name('terms.conditions');

//Register OTP
Route::get('/verify-account', [App\Http\Controllers\HomeController::class, 'verifyaccount'])->name('verifyAccount');
Route::post('/verifyotp', [App\Http\Controllers\HomeController::class, 'useractivation'])->name('verifyotp');

//Register Users
Route::group(['middleware' => RedirectIfAuthenticated::class], function () {
    
    Route::get('/register/seller', [RegisterController::class, 'showSellerRegistrationForm'])->name('register.seller');
    Route::post('/register/seller', [RegisterController::class, 'registerSeller'])->name('register.seller.submit');

    Route::get('/register/buyer', [RegisterController::class, 'showBuyerRegistrationForm'])->name('register.buyer');
    Route::post('/register/buyer', [RegisterController::class, 'registerBuyer'])->name('register.buyer.submit');

    Route::get('/register/admin', [RegisterController::class, 'showAdminRegistrationForm'])->name('register.admin');
    Route::post('/register/admin', [RegisterController::class, 'registerAdmin'])->name('register.admin.submit');
});


//Menus

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/about', function () {
    return view('about');
})->name('about');


//Route artisan with search
Route::get('/artisan', [ArtisanController::class, 'index'])->name('artisan');
Route::post('/artisan', [ArtisanController::class, 'search'])->name('search');


//Events
Route::group(['prefix'=> 'create_event'], function(){

    Route::get('/events', [EventController::class, 'index'])->name('events');

    Route::get('/events/form', function () {
        return view('Event.CreateEvents');
    })->name('create.event.form');

    Route::post('/events/submit', [EventController::class, 'create'])->name('create.event.submit');

    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');

    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');

    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

});

// Buyer Events Route
Route::get('/buyerevents', [EventController::class, 'showBuyerEvents'])->name('Event.BuyerEvents');

// Create Event
Route::get('/CreateEvents', function () {
    return view('Event.CreateEvents');
})->name('events.try');

//Community Visitor
Route::get('/community/guess', function () {
    return view('community-visitor');
})->name('community.visitor');

// Community Forum
Route::group(['prefix'=> 'community'], function(){

    Route::get('/', [CommunityController::class, 'index'])->name('community.index');
    
    Route::post('/posts', [CommunityController::class, 'storePost'])->name('community.storePost');
    
    Route::get('/data', [CommunityController::class, 'PostData']);
    
    Route::post('/posts/{post}/comment', [CommunityController::class, 'comment'])->name('community.comment');
    
    Route::post('/community/{post}/like', [CommunityController::class, 'like'])->name('community.like');
    
    // Editing and deleting posts
    Route::get('/posts/{post}/edit', [CommunityController::class, 'editPost'])->name('community.editPost');
    Route::put('/posts/{post}', [CommunityController::class, 'updatePost'])->name('community.updatePost');
    Route::delete('/posts/{post}', [CommunityController::class, 'deletePost'])->name('community.deletePost');
    
    // Editing and deleting comments
    Route::get('/comments/{comment}/edit', [CommunityController::class, 'editComment'])->name('community.editComment');
    Route::put('/comments/{comment}', [CommunityController::class, 'updateComment'])->name('community.updateComment');
    Route::delete('/comments/{comment}', [CommunityController::class, 'deleteComment'])->name('community.deleteComment');
    });


//Seller 

// Route to show the seller profile
Route::get('/profile/seller/{user}', [SellerController::class, 'show'])->name('seller.profile');

// Route to handle calculating total price
Route::post('/profile/seller/order', [SellerController::class, 'calculateTotalPrice'])->name('products.calculateTotalPrice');

//Seller Add Product
// Route::get('/profile/seller', [ProductController::class, 'index'])->name('products.index'); //recheck later baka hindi tama route
Route::get('/profile/seller', [ProductController::class, 'index'])->name('products-seller.index'); //pinaltan ko dalhin sa admin
Route::post('/profile/seller', [ProductController::class, 'search'])->name('products-search');
// Route::get('/basePath', [ProductController::class, 'basePath'])->name('products.index'); 

Route::get('/profile/seller/product/create', [ProductController::class, 'create'])->name('products-seller.create'); 
Route::post('/profile/seller/store', [ProductController::class, 'store'])->name('products-seller.store'); //add item button

Route::get('/profile/seller/{product}/edit', [ProductController::class, 'edit'])->name('products-seller.edit'); //recheck later for edit  , eto ung edit button
Route::put('/profile/seller/{product}', [ProductController::class, 'update'])->name('products-seller.update'); //recheck later for edit  , eto ung save button

//Delete
// Route::resource('/profile/seller/products', ProductController::class);
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products-seller.destroy'); //recheck later for edit  , eto ung save button

Route::post('/upload', [ProductController::class, 'upload'])->name('upload');

//Buyer
Route::get('/profile/buyer', function () {
    return view('profile.profile-buyer');
})->name('profile-buyer');