<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DentistController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Client\BookingController as ClientBookingController;
use App\Http\Controllers\Staff\BookingController as StaffBookingController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('dentists', DentistController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('bookings', [ClientBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/create', [ClientBookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [ClientBookingController::class, 'store'])->name('bookings.store');
});

Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('bookings', [StaffBookingController::class, 'index'])->name('bookings.index');
    Route::patch('bookings/{booking}/confirm', [StaffBookingController::class, 'confirm'])->name('bookings.confirm');
});


require __DIR__.'/auth.php';
