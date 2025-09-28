<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\WarehouseController;

Route::get('/', function () {
    return view('welcome');
});

// Route::view('home', 'home');
Route::redirect('/', 'home');

// Route::view('about', 'about');

Route::view('login', 'auth.login');
Route::view('register', 'auth.register');

Route::get('home', [HomeController::class, 'home']);
Route::get('about', AboutController::class);

// Route::get('items', [ItemController::class, 'index']);
// Route::get('items/create', [ItemController::class, 'create']);
// Route::post('items', [ItemController::class, 'store']);
// Route::get('items/{item}', [ItemController::class, 'show']);
// Route::get('items/{item}/edit', [ItemController::class, 'edit']);
// Route::put('items/{item}', [ItemController::class, 'update']);
// Route::delete('items/{item}', [ItemController::class, 'destroy']);

Route::resource('items', ItemController::class);
Route::resource('warehouses', WarehouseController::class);
