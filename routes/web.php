<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\CheckoutController;

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
    Route::POST('/addtocart', [CartController::class, 'AddToCartQV'])->name('add.to.cart.quickview');
    Route::get('/cartproduct/remove/{rowId}', [CartController::class, 'RemoveProduct']);
    Route::get('/cartproduct/updateqty/{rowId}/{qty}', [CartController::class, 'UpdateQty']);
    Route::get('/cartproduct/updatecolor/{rowId}/{color}', [CartController::class, 'UpdateColor']);
    Route::get('/cartproduct/updatesize/{rowId}/{size}', [CartController::class, 'UpdateSize']);

    //Cart
    Route::get('/all-cart', [CartController::class, 'AllCart'])->name('all.cart');
    Route::get('/my-cart', [CartController::class, 'MyCart'])->name('cart');
    Route::get('/cart/empty', [CartController::class, 'EmptyCart'])->name('cart.empty');

    //Checkout
    Route::get('/checkout', [CheckoutController::class, 'Checkout'])->name('checkout');

    //Coupon
    Route::post('/apply/coupon', [CheckoutController::class, 'ApplyCoupon'])->name('apply.coupon');
    Route::get('/remove/coupon', [CheckoutController::class, 'RemoveCoupon'])->name('remove.coupon');

    //Order
    Route::post('/order/place', [CheckoutController::class, 'OrderPlace'])->name('order.place');

    //Order Tracking
    Route::get('/order/tracking', [IndexController::class, 'OrderTracking'])->name('order.tracking');
    Route::post('/order/check', [IndexController::class, 'CheckOrder'])->name('check.order');

    // // AamarPay Payment Gateway
    // Route::get('payment',[CheckoutController::class,'payment'])->name('payment');
    Route::post('success',[CheckoutController::class,'success'])->name('success');
    Route::post('fail',[CheckoutController::class,'fail'])->name('fail');
    Route::get('cancel',[CheckoutController::class,'cancel'])->name('cancel');
    // Route::post('success', [CheckoutController::class, 'success'])->name('success');
    // Route::post('fail', [CheckoutController::class, 'fail'])->name('fail');
    // Route::get('cancel', [CheckoutController::class, 'cancel'])->name('cancel');

    //Product Review
    Route::post('/store/review', [ReviewController::class, 'store'])->name('store.review');

    //Review For Website As A Customer
    Route::get('/write/review', [ReviewController::class, 'write'])->name('write.review');
    Route::post('/store/website/review', [ReviewController::class, 'StoreWebsiteReview'])->name('store.website.review');

    // Customer Profile Setting
    Route::get('/home/setting', [ProfileController::class, 'CustomerSetting'])->name('customer.setting');

    // Customer Order
    Route::get('/my/order', [ProfileController::class, 'MyOrder'])->name('my.order');
    Route::get('/view/order/{id}', [ProfileController::class, 'ViewOrder'])->name('view.order');

    // Open Ticket
    Route::get('/open/ticket', [ProfileController::class, 'Ticket'])->name('open.ticket');
    Route::get('/new/ticket', [ProfileController::class, 'NewTicket'])->name('new.ticket');
    Route::post('/store/ticket', [ProfileController::class, 'StoreTicket'])->name('store.ticket');
    Route::get('/show/ticket/{id}', [ProfileController::class, 'ShowTicket'])->name('show.ticket');
    Route::post('/reply/ticket/', [ProfileController::class, 'ReplyTicket'])->name('reply.ticket');

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

    // NewsLetter
    Route::post('/store/newsletter', [IndexController::class, 'StoreNewsletter'])->name('store.newsletter');

    // Contact
    Route::get('/contact-us', [IndexController::class, 'Contact'])->name('contact');

    // Blog
    Route::get('/our-blog', [IndexController::class, 'Blog'])->name('blog');

    // Campaign Product
    Route::get('/campaign/product/{id}', [IndexController::class, 'CampaignProduct'])->name('frontend.campaign.product');



});

//socialite (For Login With Google, FB & Others)
Route::get('oauth/{driver}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('social.callback');
