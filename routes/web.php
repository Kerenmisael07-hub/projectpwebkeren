<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\HomeSettingsController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('home');

Route::middleware(['auth', 'user.verified', 'no-cache'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
});

Route::middleware(['auth', 'admin', 'no-cache'])->group(function () {
    Route::get('/setting-home', [HomeSettingsController::class, 'edit'])->name('home-settings.edit');
    Route::put('/setting-home', [HomeSettingsController::class, 'update'])->name('home-settings.update');

    Route::resource('kendaraan', KendaraanController::class)->except(['index', 'show']);
    Route::resource('customers', CustomerController::class)->except(['show']);
    Route::resource('rentals', RentalController::class)->except(['show']);
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');

    Route::get('/rentals/{rental}/bukti-sewa', [RentalController::class, 'buktiSewa'])->name('rentals.buktiSewa');
    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/laporan/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
