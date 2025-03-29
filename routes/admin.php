<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

// Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');
// Route::get('/check', function(){
// echo "admin route";
// });

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('/admin/home', [AdminController::class, 'admin'])->name('admin.home');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    //Category Route List

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    });

    //Sub Category Route List

    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', [SubcategoryController::class, 'index'])->name('subcategory.index');
        Route::post('/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete');
        Route::get('/edit/{id}', [SubcategoryController::class, 'edit']);
        Route::post('/update', [SubcategoryController::class, 'update'])->name('subcategory.update');
    });

    //Child Category Route List
    Route::group(['prefix' => 'childcategory'], function () {
        Route::get('/', [ChildcategoryController::class, 'index'])->name('childcategory.index');
        Route::post('/store', [ChildcategoryController::class, 'store'])->name('childcategory.store');
        Route::get('/delete/{id}', [ChildcategoryController::class, 'destroy'])->name('childcategory.delete');
        Route::get('/edit/{id}', [ChildcategoryController::class, 'edit']);
        Route::post('/update', [ChildcategoryController::class, 'update'])->name('childcategory.update');
    });

});
