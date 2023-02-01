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




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


#################################### Admin Routes ##########################################
Route::group(['middleware'=>['auth', 'verified'], 'prefix' => 'admin'], function(){
    
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/set-status', 'App\Http\Controllers\AjaxController@setStatus');

    Route::post('/data', 'App\Http\Controllers\AjaxController@getData');

  ################################## Admin Login Routes ##################################
    Route::get('', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
  
  ################################## /Admin Login Routes #################################  
    
  ################################## Admin Master Routes##################################
    Route::group(['prefix' => 'master'], function(){

    ################################ Brands Routes ######################################
        Route::group(['prefix' => 'brand'], function(){
            Route::get('', 'App\Http\Controllers\Admin\BrandController@index');
            Route::get('/create', 'App\Http\Controllers\Admin\BrandController@create');
            Route::get('/edit', 'App\Http\Controllers\Admin\BrandController@edit');
            Route::post('/store', 'App\Http\Controllers\Admin\BrandController@store');
        }); 

    ################################ /Brands Routes #####################################

    ################################ Category Routes ####################################
        Route::group(['prefix' => 'category'], function(){
            Route::get('', 'App\Http\Controllers\Admin\CategoryController@index');
            Route::get('/create', 'App\Http\Controllers\Admin\CategoryController@create');
            Route::get('/edit', 'App\Http\Controllers\Admin\CategoryController@edit');
            Route::post('/store', 'App\Http\Controllers\Admin\CategoryController@store');
        }); 

    ################################ /Category Routes ###################################

    ################################ Sub Category Routes ################################
        Route::group(['prefix' => 'sub-category'], function(){
            Route::get('', 'App\Http\Controllers\Admin\SubCategoryController@index');
            Route::get('/create', 'App\Http\Controllers\Admin\SubCategoryController@create');
            Route::get('/edit', 'App\Http\Controllers\Admin\SubCategoryController@edit');
            Route::post('/store', 'App\Http\Controllers\Admin\SubCategoryController@store');
        }); 

    ################################ /Sub Category Routes ###############################

    ################################ Banners Routes #####################################
        Route::group(['prefix' => 'banner'], function(){
            Route::get('', 'App\Http\Controllers\Admin\BannerController@index');
            Route::get('/create', 'App\Http\Controllers\Admin\BannerController@create');
            Route::get('/edit', 'App\Http\Controllers\Admin\BannerController@edit');
            Route::post('/store', 'App\Http\Controllers\Admin\BannerController@store');
        }); 

    ################################ /Banners Routes ####################################

    ################################ Delivery-Option Routes #############################
        Route::group(['prefix' => 'delivery-option'], function(){
            Route::get('', 'App\Http\Controllers\Admin\DeliveryOptionController@index');
            Route::get('/create', 'App\Http\Controllers\Admin\DeliveryOptionController@create');
            Route::get('/edit', 'App\Http\Controllers\Admin\DeliveryOptionController@edit');
            Route::post('/store', 'App\Http\Controllers\Admin\DeliveryOptionController@store');
        }); 

    ################################ /Delivery-Option Routes #############################

    


    });   

  ################################## /Admin Master Routes ################################

  ################################## Product Routes ######################################
    Route::group(['prefix' => 'product'], function(){
        Route::get('', 'App\Http\Controllers\Admin\ProductController@index');
        Route::get('/create', 'App\Http\Controllers\Admin\ProductController@create');
        Route::get('/edit', 'App\Http\Controllers\Admin\ProductController@edit');
        Route::post('/store', 'App\Http\Controllers\Admin\ProductController@store');
        Route::get('/product-image', 'App\Http\Controllers\Admin\ProductController@GetImageData');
    }); 

  ################################# / Product Routes  ####################################


  ################################## User Routes ######################################
    Route::group(['prefix' => 'user'], function(){
        Route::get('', 'App\Http\Controllers\Admin\UserController@index');
        Route::get('/create', 'App\Http\Controllers\Admin\UserController@create');
        Route::get('/edit', 'App\Http\Controllers\Admin\UserController@edit');
        Route::post('/store', 'App\Http\Controllers\Admin\UserController@store');
        
    }); 

  ################################# / User Routes  ####################################

  ################################## Logs Routes ######################################
    Route::group(['prefix' => 'logs'], function(){
        Route::get('', 'App\Http\Controllers\Admin\LogController@index');
        Route::post('/log-data', 'App\Http\Controllers\Admin\LogController@getLogData');
        
    }); 

  ################################# / Logs Routes  ####################################


  ################################## Role Routes ######################################
    Route::group(['prefix' => 'role'], function(){
        Route::get('', 'App\Http\Controllers\Admin\RoleController@index');
        Route::get('/create', 'App\Http\Controllers\Admin\RoleController@create');
        Route::get('/edit', 'App\Http\Controllers\Admin\RoleController@edit');
        Route::post('/store', 'App\Http\Controllers\Admin\RoleController@store');
        
    }); 

  ################################# / Role Routes  ####################################


  ################################## Permission Routes ##################################
    Route::group(['prefix' => 'permission'], function(){
        Route::get('', 'App\Http\Controllers\Admin\UserPermissionController@index');
        Route::get('/create', 'App\Http\Controllers\Admin\UserPermissionController@create');
        Route::get('/edit', 'App\Http\Controllers\Admin\UserPermissionController@edit');
        Route::post('/store', 'App\Http\Controllers\Admin\UserPermissionController@store');
        
    }); 

  ################################# / Permission Routes  ####################################

  ################################## Order Routes ######################################
    Route::group(['prefix' => 'order'], function(){
        Route::get('', 'App\Http\Controllers\Admin\OrderController@index');
        Route::post('/order-data', 'App\Http\Controllers\Admin\OrderController@getOrderData');
        Route::post('/update-order-status', 'App\Http\Controllers\Admin\OrderController@updateOrderStatus');

        Route::get('/download-csv', 'App\Http\Controllers\Admin\OrderController@downloadOrderCsv');
    }); 

  ################################# / Order Routes  ####################################

});
#################################### /Admin Routes #########################################


Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

#################################### Frontend Routes #######################################

Route::get('/', 'App\Http\Controllers\WelcomeController@getWelcomeView');

Route::get('/product/{productId}', 'App\Http\Controllers\ProductController@getProductDetails');

Route::get('/cart', function () {return view('cart');});

Route::post('/get-cart-view', 'App\Http\Controllers\AjaxController@getCartView');

Route::post('/get-order-view', 'App\Http\Controllers\AjaxController@getOrderView');

Route::post('/store-orders', 'App\Http\Controllers\OrderController@storeOrder');

Route::get('/edit-orders', 'App\Http\Controllers\OrderController@editOrder');

Route::get('/order', function () {return view('order');});

Route::post('/orders', 'App\Http\Controllers\OrderController@getOrderDetails');


Route::post('/order-details', 'App\Http\Controllers\OrderController@getOrderDetails');

Route::get('/thank-you', function () {return view('thank-you');});

Route::post('/payment', 'App\Http\Controllers\PaymentController@storePayment');

Route::get('/search', 'App\Http\Controllers\AjaxController@searchProduct');

Route::get('/send-mail', 'App\Http\Controllers\AjaxController@sendMail');


Route::get('/{categoryId}', 'App\Http\Controllers\ProductController@getProductByCategory');


#################################### /Frontend Routes ######################################



Auth::routes();
