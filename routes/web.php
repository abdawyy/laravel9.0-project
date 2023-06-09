<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\TemplateController;
use Illuminate\Foundation\Exceptions\RegisterErrorViewPaths;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', 'App\Http\Controllers\TemplateController@test');

// Route::get('/about',function(){
//     return view('pages.about');
// });


// /*Route::get('/contact', function(){

//    return view('contact');
// });*/
// Route::get('/contact', function()
// {
//    return view('pages.contact');
// });
// /*Route::get('/home', function()
// {
//    return view('pages.home');
// });*/
// Route::get('/sign-in',function()
// {
//     return view('pages.signin');
// });
// Route::get('/sign-up',function()
// {
//     return view('pages.signout');
// });
// Route::get('/catalog',function()
// {
//     return view('pages.catalog');
// });
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
// //Route::put('/articles/{article}', 'ArticlesController@update');
Route::get('/', function () {
    return view('welcome');
});
// all listings
Route::get('/home', [ListingController::class,'index']);




//show create form
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');



//LISINTINGS

//single listings
Route::get('/listings/{listing}',[ListingController::class,'show']);
//show edit Data
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');
// store Listing data
Route::post('/listings',[ListingController::class,'store'])->middleware('auth');
// update Listing
Route::put('/listings/{listing}' ,[ListingController::class,'update'])->middleware('auth');
// delete Listing
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');
// Manage Listings
Route::get('/listings-manage',[ListingController::class,'manage'])->middleware('auth');


//Show Register/create form
Route::get('/register',[UserController::class,'create'])->middleware('guest');

// Create New User
Route::post('/users',[UserController::class,'store']);
// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
// Show Login Form
Route::get('/login', [UserController::class,'login'])->name('login')->middleware('guest');
//Log In User
Route::post('/users/authenticate',[UserController::class,'Authenticate']);

/*Route::get('/layout', function () {
     return view('layout');
 });
/*Route::get('/listing',function() {
    return view('listing');
});
Route::get('/listing', function () {
    return view('listing',[
'heading' => 'Latest Listing',
'listing'=> Listing::all()
]);
});*/
















// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

















