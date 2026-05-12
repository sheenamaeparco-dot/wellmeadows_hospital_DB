<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WardBedController; // Imported the new controller here
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::redirect('/home', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Functional Submenu Routes added inside your existing auth middleware group
    Route::get('/ward-bed/reports', [WardBedController::class, 'reports'])->name('ward.reports');
    Route::get('/ward-bed/bed-map', [WardBedController::class, 'bedMap'])->name('ward.bed-map');
    Route::get('/ward-bed/assign-bed', [WardBedController::class, 'assignBed'])->name('ward.assign-bed');
    Route::get('/ward-bed/requisitions', [WardBedController::class, 'requisitions'])->name('ward.requisitions');
});

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

require __DIR__.'/auth.php';

