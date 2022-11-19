<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/admin', [App\Http\Controllers\Auth\AdminAuthController::class, 'index'])->name('admin');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function (){
    // Dashboard
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Room Type
    Route::prefix('roomtype')->controller(App\Http\Controllers\Admin\RoomtypeController::class)->group(function (){
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
        Route::get('/edit/{roomtype}', 'edit');
        Route::put('/edit/{roomtype}', 'update');
    });

    // Facility
    Route::prefix('facility')->controller(App\Http\Controllers\Admin\FacilityController::class)->group(function (){
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
        Route::get('/edit/{facility}', 'edit');
        Route::put('/edit/{facility}', 'update');
    });

    // Room
    Route::prefix('room')->controller(App\Http\Controllers\Admin\RoomController::class)->group(function (){
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
        Route::get('/edit/{room}', 'edit');
        Route::put('/edit/{room}', 'update');
    });

    // User
    Route::prefix('user')->controller(App\Http\Controllers\Admin\UserController::class)->group(function (){
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
        Route::get('/edit/{user}', 'edit');
        Route::put('/edit/{user}', 'update');
        Route::get('/changepassword/{user}', 'changePassword');
    });
});




