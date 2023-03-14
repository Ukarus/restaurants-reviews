<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewsController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/{restaurant}/reviews', [HomeController::class, 'show'])->name('reviews.index');
Route::post('/reviews/store', [ReviewsController::class, 'store'])->name('reviews.store');
