<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ProfileController;

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

Route::get('/login', function(){
    return redirect()->to('/');
})->name('login');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

// All Frontend Routes

Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {

    Route::get('/', [IndexController::class, 'index']);
    Route::get('/product-details/{slug}', [IndexController::class, 'ProductDetails'])->name('product.details');
    //Quick View
    Route::get('/product-quick-view/{id}', [IndexController::class, 'ProductQuickView']);

    //Add to Cart On Quick View
    Route::post('/addtocart', [CartController::class, 'AddToCartQV'])->name('add.to.cart.quickview');
    Route::get('/cartproduct/remove/{rowId}', [CartController::class, 'RemoveProduct']);
    Route::get('/cartproduct/updateqty/{rowId}/{qty}', [CartController::class, 'UpdateQty']);
    Route::get('/cartproduct/updatecolor/{rowId}/{color}', [CartController::class, 'UpdateColor']);
    Route::get('/cartproduct/updatesize/{rowId}/{size}', [CartController::class, 'UpdateSize']);

    //Cart
    Route::get('/all-cart', [CartController::class, 'AllCart'])->name('all.cart');
    Route::get('/my-cart', [CartController::class, 'MyCart'])->name('cart');
    Route::get('/cart/empty', [CartController::class, 'EmptyCart'])->name('cart.empty');

    //Product Review
    Route::post('/store/review', [ReviewController::class, 'store'])->name('store.review');

    //Review For Website As A Customer
    Route::get('/write/review', [ReviewController::class, 'write'])->name('write.review');
    Route::post('/store/website/review', [ReviewController::class, 'StoreWebsiteReview'])->name('store.website.review');

    // Customer Profile Setting
    Route::get('/home/setting', [ProfileController::class, 'CustomerSetting'])->name('customer.setting');

    // Customer Change Password
    Route::post('/home/password/update', [ProfileController::class, 'PasswordChange'])->name('customer.password.change');

    //Product Wishlist
    Route::get('/add/wishlist/{id}', [CartController::class, 'AddWishlist'])->name('add.wishlist');
    Route::get('/wishlist', [CartController::class, 'MyWishlist'])->name('wishlist');
    Route::get('/clear/wishlist', [CartController::class, 'ClearWishlist'])->name('clear.wishlist');
    Route::get('/wishlist/product/delete/{id}', [CartController::class, 'WishlistProductDelete'])->name('wishlistproduct.delete');

    // Category Wise Product
    Route::get('/cateogry/product/{id}', [IndexController::class, 'CategoryWiseProduct'])->name('categorywise.product');

    // Category Wise Product
    Route::get('/subcateogry/product/{id}', [IndexController::class, 'SubcategoryWiseProduct'])->name('subcategorywise.product');

    // Category Wise Product
    Route::get('/childcateogry/product/{id}', [IndexController::class, 'ChildcategoryWiseProduct'])->name('childcategorywise.product');

    // Brand Wise Product
    Route::get('/brand/product/{id}', [IndexController::class, 'BrandWiseProduct'])->name('brandwise.product');

    // Page View
    Route::get('/page/{page_slug}', [IndexController::class, 'ViewPage'])->name('view.page');

});
