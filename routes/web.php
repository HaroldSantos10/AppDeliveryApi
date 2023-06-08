<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\FeaturedController;
use App\Http\Controllers\FeaturedDishController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', categoryController::class)->middleware('auth');
Route::resource('restaurants', restaurantController::class)->middleware('auth');
Route::resource('dishes', dishController::class)->middleware('auth');
Route::resource('featureds', featuredController::class)->middleware('auth');
Route::resource('featured-dishes', featuredDishController::class)->middleware('auth');