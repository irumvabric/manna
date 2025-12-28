<?php
// routes/admin.php

use App\Http\Controllers\Admin\BeneficiaryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Placeholder routes – replace with real controllers when ready
    Route::get('/donators', [App\Http\Controllers\Admin\DonatorController::class, 'index'])->name('donators.index');
    Route::post('/donators', [App\Http\Controllers\Admin\DonatorController::class, 'store'])->name('donators.store');
    Route::put('/donators/{donator}', [App\Http\Controllers\Admin\DonatorController::class, 'update'])->name('donators.update');
    Route::delete('/donators/{donator}', [App\Http\Controllers\Admin\DonatorController::class, 'destroy'])->name('donators.destroy');

    Route::get('/donations', [App\Http\Controllers\Admin\DonationController::class, 'index'])->name('donations.index');
    Route::post('/donations', [App\Http\Controllers\Admin\DonationController::class, 'storeManual'])->name('donations.store-manual');
    Route::put('/donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'update'])->name('donations.update');
    Route::delete('/donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'destroy'])->name('donations.destroy');

    Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiaries.index');
    Route::post('/beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');
    Route::put('/beneficiaries/{beneficiary}', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');
    Route::delete('/beneficiaries/{beneficiary}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');

    Route::get('/reports/export/{type}', [App\Http\Controllers\Admin\ReportController::class, 'export'])->name('reports.export');
    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');

    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
});
