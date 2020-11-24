<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleProductController;
use App\Http\Controllers\UserController;
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

Route::get('', function () {
    return view('welcome');
});

Route::get('login', [UserController::class, "login"])->name('login');
Route::post('auth', [UserController::class, "auth"])->name('auth');

Route::get('change-password', [UserController::class, "setUserChangePassword"])->name('set_user_change_password');
Route::post('change-password', [UserController::class, "userRequestChangePassword"])->name('user_request_change_password');
Route::get('change-password/{token}', [UserController::class, "changePassword"])->name('change_password');
Route::post('change-password/{token}', [UserController::class, "updatePassword"])->name('update_password');

Route::middleware(['authenticator'])->group(function () {
    Route::resource('complaint', ComplaintController::class);
    Route::resource('sale', SaleController::class);
    Route::get('sale/{sale}/confirm', [SaleController::class, "confirm"])->name('sale_confirm');
    Route::post('sale/{sale}/pay', [SaleController::class, "pay"])->name('sale_pay');
    Route::resource('sale.sale-product', SaleProductController::class)->shallow();

    Route::get('your-user', [UserController::class, "editUser"])->name('your_user');
    Route::post('logout', [UserController::class, "logout"])->name('logout');
    Route::get('home', [HomeController::class, "home"])->name('home');
    Route::resource('user', UserController::class);

    Route::resource('client', ClientController::class);

    Route::middleware(['is.manager'])->group(function () {
        Route::resource('manager', ManagerController::class);
        Route::resource('product', ProductController::class);
        Route::post('product-stock-add', [ProductController::class, "stockAdd"])->name('product_stock_add');
        Route::get('active-users', [UserController::class, 'activeUsers'])->name('active_users');
    });

    Route::post('keep-token-alive', function () {
        return 'Token must have been valid, and the session expiration has been extended.'; //https://stackoverflow.com/q/31449434/470749
    });
});
