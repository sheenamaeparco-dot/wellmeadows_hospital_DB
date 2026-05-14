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

    // Ward & Bed Routes
    Route::get('/ward-bed/scoreboard', [WardBedController::class, 'scoreboard'])->name('ward.scoreboard');
    Route::get('/ward-bed/bed-map', [WardBedController::class, 'bedMap'])->name('ward.bed-map');
    
    
    // Requisitions - View and Submit
    Route::get('/ward-bed/requisitions', [WardBedController::class, 'requisitions'])->name('ward.requisitions');
    Route::post('/ward-bed/requisitions', [WardBedController::class, 'storeRequisition'])->name('ward.requisitions.store');
});
// 1. Patient Records Module
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');

// 2. Staff & Department Module
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');

// 3. Ward & Bed Management Module
Route::get('/wards', [WardBedController::class, 'index'])->name('wards.index');

// 4. Appointment & Treatment Module (Yours)
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

// 5. Billing 
Route::get('/billings', [BillingController::class, 'index'])->name('billings.index');

require __DIR__.'/auth.php';


