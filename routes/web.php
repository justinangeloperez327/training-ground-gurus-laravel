<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AvatarController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Route::view('home', 'home');
Route::redirect('/', 'home');

// Route::view('about', 'about');

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login');
    Route::view('register', 'auth.register');

    Route::post('login', LoginController::class)->name('login');
    Route::post('register', RegisterController::class)->name('register');

    Route::get('about', AboutController::class);
    Route::get('home', [HomeController::class, 'home']);
});

Route::post('logout', LogoutController::class)->name('sign-out')->middleware('auth');

Route::middleware('auth')->group(function() {

    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('avatar', [AvatarController::class, 'upload'])->name('avatar.upload');
    Route::put('avatar{image}', [AvatarController::class, 'update'])->name('avatar.update');

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // Short method using resource
    Route::resource('items', ItemController::class);
    Route::resource('warehouses', WarehouseController::class);

    // Route::resource('stocks', StockController::class);
    Route::get('stocks/{item}', [StockController::class, 'index'])->name('stocks.index');
    Route::get('stocks/{item}/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('stocks/{item}', [StockController::class, 'store'])->name('stocks.store');
    Route::get('stocks/{stock}/edit', [StockController::class, 'edit'])->name('stocks.edit');
    Route::put('stocks/{stock}', [StockController::class, 'update'])->name('stocks.update');
});

Route::view('admin', 'admin')->middleware('admin');

// Long method routing
// Route::get('items', [ItemController::class, 'index']);
// Route::get('items/create', [ItemController::class, 'create']);
// Route::post('items', [ItemController::class, 'store']);
// Route::get('items/{item}', [ItemController::class, 'show']);
// Route::get('items/{item}/edit', [ItemController::class, 'edit']);
// Route::put('items/{item}', [ItemController::class, 'update']);
// Route::delete('items/{item}', [ItemController::class, 'destroy']);

//Limit what is available on controller
// Route::resource('warehouses', WarehouseController::class)->only(['update']);
// Route::resource('warehouses', WarehouseController::class)->except(['index', 'create', 'edit', 'show']);
