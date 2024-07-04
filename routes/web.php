<?php

use Illuminate\Support\Facades\Route;

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


use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('index_search', [HomeController::class, 'indexProcess'])->name('index-process');

Route::get('search-list', [HomeController::class, 'searchList'])->name('search-list');
Route::post('search-list-process', [HomeController::class, 'searchListProcess'])->name('search-list-process');

Route::get('search-detail', [HomeController::class, 'searchDetail'])->name('search-detail');
Route::get('search-detail2', [HomeController::class, 'searchDetail2'])->name('search-detail2');

// Route::get('search-detail-process', [HomeController::class, 'searchDetailProcess'])->name('search-detail-process');

Route::post('restaurant-process', [HomeController::class, 'restaurantProcess'])->name('restaurant-process');

Route::get('/restaurants', [HomeController::class, 'restaurant'])->name('restaurants');

Route::get('/search-restaurants', [HomeController::class, 'searchRestaurant'])->name('search-restaurants');

Route::get('/chat', [HomeController::class, 'chat'])->name('chat');

Route::get('/chat-grid', [HomeController::class, 'chatGrid'])->name('chat-grid');

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/user_login', [HomeController::class, 'loginProcess'])->name('process');

// Route::get('/login_new', [HomeController::class, 'loginNew'])->name('login');





