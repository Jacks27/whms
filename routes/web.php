<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\RegisterController;
// Welcome Route

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
    Route::resource('doctor', DoctorController::class);
    Route::resource('booking', AppointmentController::class);
    Route::resource('schedule', ScheduleController::class);
    Route::get('schedule/search', [AppointmentController::class, 'search'])->name('search');
    Route::resource('/user', RegisterController::class);
    Route::post('/assign-role', [RegisterController::class,'assignRole'])->name('user.assignRole');
    Route::post('/user/revoke-role', [RegisterController::class,'revokeRole'])->name('user.revokeRole');
});
