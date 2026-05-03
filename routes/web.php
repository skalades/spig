<?php

use App\Http\Controllers\Alumni\DashboardController;
use App\Http\Controllers\Alumni\AlumniProfileController;
use App\Http\Controllers\Alumni\AlumniDirectoryController;
use App\Http\Controllers\Alumni\FeedController;
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
    Route::get('/alumni/map-data', [DashboardController::class, 'mapData'])->name('alumni.map-data');
    Route::get('/alumni/directory', [AlumniDirectoryController::class, 'index'])->name('alumni.directory');
    Route::get('/alumni/directory/{id}', [AlumniDirectoryController::class, 'show'])->name('alumni.directory.show');
    Route::get('/alumni/profile', [AlumniProfileController::class, 'edit'])->name('alumni.profile.edit');
    Route::patch('/alumni/profile', [AlumniProfileController::class, 'update'])->name('alumni.profile.update');

    Route::middleware(['verified_alumni'])->group(function () {
        Route::get('/alumni/feed', [FeedController::class, 'index'])->name('alumni.feed');
        
        // Business Directory
        Route::get('/alumni/business', \App\Livewire\Business\DirectoryIndex::class)->name('alumni.business.index');
        Route::get('/alumni/business/register', \App\Livewire\Business\RegistrationForm::class)->name('alumni.business.register');
        Route::get('/alumni/my-business', \App\Livewire\Business\ManageCompany::class)->name('alumni.business.manage');
        Route::get('/alumni/business/{slug}', \App\Livewire\Business\CompanyDetail::class)->name('alumni.business.detail');

        // Career Hub
        Route::get('/alumni/jobs', \App\Livewire\Career\JobBoard::class)->name('alumni.jobs.index');
        Route::get('/alumni/jobs/create', \App\Livewire\Career\CreateJob::class)->name('alumni.jobs.create');
        Route::get('/alumni/jobs/{slug}', \App\Livewire\Career\JobDetail::class)->name('alumni.jobs.show');
    });
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', \App\Livewire\Admin\ReportIndex::class)->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
