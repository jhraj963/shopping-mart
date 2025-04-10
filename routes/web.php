<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;

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

// All Frontend Routes

Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {

    Route::get('/', [IndexController::class, 'index']);

});