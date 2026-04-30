<?php

use App\Http\Controllers\Alumni\DashboardController;
use App\Http\Controllers\Alumni\AlumniProfileController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [LandingPageController::class, 'index']);

Route::get('/dashboard', function () {
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('alumni.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:alumni'])->group(function () {
    Route::get('/alumni/dashboard', [DashboardController::class, 'index'])->name('alumni.dashboard');
    Route::get('/alumni/profile', [AlumniProfileController::class, 'edit'])->name('alumni.profile.edit');
    Route::patch('/alumni/profile', [AlumniProfileController::class, 'update'])->name('alumni.profile.update');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function() {
        return "Admin Dashboard - Work in Progress";
    })->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
