<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
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
Route::view('/', 'welcome');

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protected Routes
Route::middleware('auth')->prefix('whms')->group(function () {
    Route::get('profile/create', [UserProfileController::class, 'create'])->name('profile.create');
    Route::resource('profile', UserProfileController::class)->except(['create']);
    Route::resource('department', DepartmentController::class);

});
