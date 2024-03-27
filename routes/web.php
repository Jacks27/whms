<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionsController;
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
    Route::resource('/role', RoleController::class);
    Route::resource('/permissions', PermissionsController::class);
    Route::resource('/users', RegisterController::class);
    Route::get('schedule/search', [AppointmentController::class, 'search'])->name('search');
    Route::post('profile/assign', [UserProfileController::class,'roleAssign'])->name('profile.roleAssign');
    Route::post('profile/revoke', [UserProfileController::class,'roleRevoke'])->name('profile.roleRevoke');
    Route::get('permissions/filter',[PermissionsController::class,'filter'])->name('permissions.filter');
});
