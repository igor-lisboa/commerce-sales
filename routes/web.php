<?php

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
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});
