<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AiRecommendationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\WeatherRecommendationController;
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



Route::get('/', function () {
    return redirect()->route('dashboard.index');
});
// ai recommendation
Route::get('/recommendations', [RecommendationController::class, 'getAiRecommendations']);
Route::get('/ai_recommendations', [RecommendationController::class, 'index'])->name('ai_recommendations');


// weather recommendation
Route::get('/recommendations-weather', [WeatherRecommendationController::class, 'show'])->name('weather');

/////////////////////// orders logic
Route::get('/orders', [OrderController::class, 'index'])->name("order.index");
Route::get('/orders/create', [OrderController::class, 'create'])->name("orders.create");
Route::post('/orders', [OrderController::class, 'store']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('order.delete');
////////////////////////////////////////////////////////////////////////////////
// dashboard
Route::get('/analytics', [DashboardController::class, 'index'])->name('dashboard.index');

// product
Route::post('/admin/update-prices', [ProductController::class, 'updatePrices'])->name('updatePrices');
Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');


