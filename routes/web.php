<?php

use App\Http\Controllers\Alumni\DashboardController as AlumniDashboard;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;

Route::get('/', [LandingPageController::class, 'index']);

Route::get('/dashboard', function () {
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('alumni.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:alumni'])->group(function () {
    Route::get('/alumni/dashboard', [AlumniDashboard::class, 'index'])->name('alumni.dashboard');
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
