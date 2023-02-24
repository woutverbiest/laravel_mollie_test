<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [OrderController::class, 'pay'])->name('pay');

Route::get('/order/{id}', [OrderController::class, 'getOrder'])->name('getOrder');
Route::post('/webhook_mollie ',[OrderController::class, 'webhook'])->name('webhook_mollie');
