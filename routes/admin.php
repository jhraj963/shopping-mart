<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

// Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');
// Route::get('/check', function(){
// echo "admin route";
// });

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('/admin/home', [AdminController::class, 'admin'])->name('admin.home');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/password/change', [AdminController::class, 'passwordChange'])->name('admin.password.change');
    Route::post('/admin/password/update', [AdminController::class, 'passwordUpdate'])->name('admin.password.update');

    //Category Route List

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    });

    //Blog Route List

    Route::group(['prefix' => 'blog-category'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('admin.blog.category');
        Route::post('/store', [BlogController::class, 'store'])->name('blog.category.store');
        Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.category.delete');
        Route::get('/edit/{id}', [BlogController::class, 'edit']);
        Route::post('/update', [BlogController::class, 'update'])->name('blog.category.update');
    });

    // Global Route
    Route::get('/get-child-category/{id}', [CategoryController::class, 'GetChildCategory']);

    //Product Route List

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('store.product');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update', [ProductController::class, 'update'])->name('update.product');
        Route::get('/active-featured/{id}', [ProductController::class, 'activefeatured']);
        Route::get('/not-featured/{id}', [ProductController::class, 'notfeatured']);
        Route::get('/active-deal/{id}', [ProductController::class, 'activedeal']);
        Route::get('/not-deal/{id}', [ProductController::class, 'notdeal']);
        Route::get('/active-status/{id}', [ProductController::class, 'activestatus']);
        Route::get('/not-status/{id}', [ProductController::class, 'notstatus']);
    });

    //Coupon Route List

    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('coupon.index');
        Route::post('/store', [CouponController::class, 'store'])->name('store.coupon');
        Route::delete('/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
        Route::get('/edit/{id}', [CouponController::class, 'edit']);
        Route::post('/update', [CouponController::class, 'update'])->name('coupon.update');
    });

    //Campaign Product Route List

    Route::group(['prefix' => 'campaign-product'], function () {
        Route::get('/{campaign_id}', [CampaignController::class, 'campaignProduct'])->name('campaign.product');
        Route::get('/add/{id}/{campaign_id}', [CampaignController::class, 'ProductAddToCampaign'])->name('add.product.to.campaign');
        Route::get('/list/{campaign_id}', [CampaignController::class, 'ProductListCampaign'])->name('campaign.product.list');
        Route::get('/remove/{id}', [CampaignController::class, 'RemoveProduct'])->name('remove.product.to.campaign');
        // Route::post('/update', [CampaignController::class, 'update'])->name('campaign.update');
    });

    //Campaign Route List

    Route::group(['prefix' => 'campaign'], function () {
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
        Route::get('/delete/{id}', [CampaignController::class, 'destroy'])->name('campaign.delete');
        Route::get('/edit/{id}', [CampaignController::class, 'edit']);
        Route::post('/update', [CampaignController::class, 'update'])->name('campaign.update');
    });

    //Order Route List

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('/view/admin/{id}', [OrderController::class, 'view']);
        Route::get('/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');
        Route::get('/admin/edit/{id}', [OrderController::class, 'edit']);
        Route::post('/update/order/status', [OrderController::class, 'update'])->name('update.order.status');
    });

    //Warehouse Route List

    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
        Route::post('/store', [WarehouseController::class, 'store'])->name('warehouse.store');
        Route::get('/delete/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.delete');
        Route::get('/edit/{id}', [WarehouseController::class, 'edit']);
        Route::post('/update', [WarehouseController::class, 'update'])->name('warehouse.update');
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

    //Brand Route List
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
        Route::get('/edit/{id}', [BrandController::class, 'edit']);
        Route::post('/update', [BrandController::class, 'update'])->name('brand.update');
    });

    //Settings Route List
    Route::group(['prefix' => 'setting'], function () {
        //SEO Setting
        Route::group(['prefix' => 'seo'], function () {
            Route::get('/', [SettingController::class, 'seo'])->name('seo.setting');
            Route::post('/update/{id}', [SettingController::class, 'update'])->name('seo.setting.update');
        });

        //SMTP Setting
        Route::group(['prefix' => 'smtp'], function () {
            Route::get('/', [SettingController::class, 'smtp'])->name('smtp.setting');
            Route::post('/update/{id}', [SettingController::class, 'smtpUpdate'])->name('smtp.setting.update');
        });

        //Website Setting
        Route::group(['prefix' => 'website'], function () {
            Route::get('/', [SettingController::class, 'website'])->name('website.setting');
            Route::post('/update/{id}', [SettingController::class, 'websiteUpdate'])->name('website.setting.update');
        });

        //Payment Gateway
        Route::group(['prefix' => 'payment-gateway'], function () {
            Route::get('/', [SettingController::class, 'PaymentGateway'])->name('payment.gateway');
            Route::post('/update-aamarpay', [SettingController::class, 'AamarpayUpdate'])->name('update.aamarpay');
            Route::post('/update-surjopay', [SettingController::class, 'SurjopayUpdate'])->name('update.surjopay');
            Route::post('/update-ssl', [SettingController::class, 'SslUpdate'])->name('update.ssl');
        });

        //Page Setting
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', [PageController::class, 'index'])->name('page.index');
            Route::get('/create', [PageController::class, 'create'])->name('create.page');
            Route::post('/store', [PageController::class, 'store'])->name('page.store');
            Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
            Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
        });

        //Pickup Point
        Route::group(['prefix' => 'pickup'], function () {
            Route::get('/', [PickupController::class, 'index'])->name('pickup.index');
            Route::post('/store', [PickupController::class, 'store'])->name('store.pickup');
            Route::delete('/delete/{id}', [PickupController::class, 'destroy'])->name('pickup.delete');
            Route::get('/edit/{id}', [PickupController::class, 'edit']);
            Route::post('/update', [PickupController::class, 'update'])->name('pickup.update');
        });

        //Ticket
        Route::group(['prefix' => 'ticket'], function () {
            Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
            Route::get('/ticket/show/{id}', [TicketController::class, 'show'])->name('admin.ticket.show');
            Route::post('/ticket/reply', [TicketController::class, 'ReplyTicket'])->name('admin.store.reply');
            Route::get('/ticket/close/{id}', [TicketController::class, 'CloseTicket'])->name('admin.close.ticket');
            Route::delete('/delete/{id}', [TicketController::class, 'destroy'])->name('admin.ticket.delete');
            // Route::get('/edit/{id}', [TicketController::class, 'edit']);
            // Route::post('/update', [TicketController::class, 'update'])->name('pickup.update');
        });

        //Ticket
        Route::group(['prefix' => 'report'], function () {
            Route::get('/order', [OrderController::class, 'ReportIndex'])->name('order.report.index');
            Route::get('/order/print', [OrderController::class, 'ReportOrderPrint'])->name('report.order.print');
        });

        // User Role
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', 'RoleController@index')->name('manage.role');
            Route::get('/create', 'RoleController@create')->name('create.role');
            Route::post('/store', 'RoleController@store')->name('store.role');
            Route::get('/delete/{id}', 'RoleController@destroy')->name('role.delete');
            Route::get('/edit/{id}', 'RoleController@edit')->name('role.edit');
            Route::post('/update', 'RoleController@update')->name('update.role');
        });
    });

});
