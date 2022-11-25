<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/contact', [LandingController::class, 'send'])->name('contact');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'create'])->name('register');
Route::get('verify', [VerificationController::class, ''])->name('verify');
Route::post('payment/callback', [DepositController::class, 'callback'])->name('payment-callback');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// AUTH Middleware
Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    // Deposit
    Route::get('deposit/add', [DepositController::class, 'create'])->name('deposit-add');
    Route::post('deposit/add', [DepositController::class, 'store'])->name('deposit-add');
    Route::get('deposit/history', [DepositController::class, 'index'])->name('deposit-history');
    // Service
    Route::get('service/grab', [ServiceController::class, 'create'])->name('service-grab');
    Route::post('service/grab', [ServiceController::class, 'store'])->name('service-grab');
    Route::get('service/list', [ServiceController::class, 'index'])->name('service-list');
    Route::get('service/category/{id}', [ServiceController::class, 'servicePerCategoy'])->name('service-category');
    // Order
    Route::get('order/new', [OrderController::class, 'create'])->name('order-new');
    Route::post('order/new', [OrderController::class, 'store'])->name('order-new');
    Route::get('order/history', [OrderController::class, 'index'])->name('order-history');
    // User
    Route::get('order/new', [OrderController::class, 'create'])->name('order-new');
    Route::post('order/new', [OrderController::class, 'store'])->name('order-new');
    Route::get('user/list', [UserController::class, 'index'])->name('user-list');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile/update', [UserController::class, 'updateProfile'])->name('profile-update');
    Route::post('profile/password', [UserController::class, 'updatePassword'])->name('profile-password');

    // // Route Components    
    // Route::get('home', [StaterkitController::class, 'home'])->name('home');
    // Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
    // Route::get('layouts/boxed', [StaterkitController::class, 'layout_boxed'])->name('layout-boxed');
    // Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
    // Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
    // Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');

    // locale Route
    Route::get('lang/{locale}', [LanguageController::class, 'swap']);
});
