<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, "login"])->name('login');
Route::post('/auth', [UserController::class, "auth"])->name('auth');
Route::post('/register', [UserController::class, "store"])->name('register');

Route::middleware(['authenticator'])->group(function () {
    Route::post('/logout', [UserController::class, "logout"])->name('logout');
    Route::get('/home', [HomeController::class, "home"])->name('home');

    Route::post('/manager', [ManagerController::class, "store"])->name('manager_register');

    Route::post('keep-token-alive', function () {
        return 'Token must have been valid, and the session expiration has been extended.'; //https://stackoverflow.com/q/31449434/470749
    });
});
