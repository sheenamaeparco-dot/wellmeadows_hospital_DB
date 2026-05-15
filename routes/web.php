<?php
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WardBedController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::redirect('/home', '/dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
// 1. Patient Records Module
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');

// 2. Staff & Department Module (Lovely)
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/management', [StaffController::class, 'management'])->name('staff.management');
Route::get('/staff/departments', [StaffController::class, 'departments'])->name('staff.departments');
Route::get('/staff/schedules', [StaffController::class, 'schedules'])->name('staff.schedules');

// 3. Ward & Bed Management Module
Route::get('/ward', [WardBedController::class, 'index'])->name('ward.index');
Route::get('/ward/bed-map', [WardBedController::class, 'bedmap'])->name('ward.bedmap');
Route::get('/ward/requisitions', [WardBedController::class, 'requisitions'])->name('ward.requisitions');

// 4. Appointment & Treatment Module (Yours)
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

// 5. Billing
Route::get('/billings', [BillingController::class, 'index'])->name('billings.index');

require __DIR__.'/auth.php';


