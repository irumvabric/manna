<?php
// routes/admin.php

use App\Http\Controllers\Admin\BeneficiaryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
   
    // Admin Only
    Route::middleware(['isAdmin'])->group(function() {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Management
        Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

        // Donators Management
        Route::get('/donators', [App\Http\Controllers\Admin\DonatorController::class, 'index'])->name('donators.index');
        Route::post('/donators', [App\Http\Controllers\Admin\DonatorController::class, 'store'])->name('donators.store');
        Route::put('/donators/{donator}', [App\Http\Controllers\Admin\DonatorController::class, 'update'])->name('donators.update');
        Route::delete('/donators/{donator}', [App\Http\Controllers\Admin\DonatorController::class, 'destroy'])->name('donators.destroy');

        // Donations Management
        Route::get('/donations', [App\Http\Controllers\Admin\DonationController::class, 'index'])->name('donations.index');
        Route::post('/donations', [App\Http\Controllers\Admin\DonationController::class, 'storeManual'])->name('donations.store-manual');
        Route::put('/donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'update'])->name('donations.update');
        Route::delete('/donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'destroy'])->name('donations.destroy');

        // Beneficiaries Management
        Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiaries.index');
        Route::post('/beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');
        Route::put('/beneficiaries/{beneficiary}', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');
        Route::delete('/beneficiaries/{beneficiary}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');

        // Reports
        Route::get('/reports/export/{type}', [App\Http\Controllers\Admin\ReportController::class, 'export'])->name('reports.export');
        Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');

        // Settings
        Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

        // Expenses
        Route::get('/beneficiaries/{beneficiary}/expenses', [App\Http\Controllers\Admin\ExpenseController::class, 'index'])->name('beneficiaries.expenses.index');
        Route::post('/beneficiaries/{beneficiary}/expenses', [App\Http\Controllers\Admin\ExpenseController::class, 'store'])->name('beneficiaries.expenses.store');
        Route::put('/expenses/{expense}', [App\Http\Controllers\Admin\ExpenseController::class, 'update'])->name('expenses.update');
        Route::delete('/expenses/{expense}', [App\Http\Controllers\Admin\ExpenseController::class, 'destroy'])->name('expenses.destroy');
    });

    // Donator Only
    Route::middleware(['isDonator'])->group(function() {
        Route::get('/donator/dashboard', [\App\Http\Controllers\Donator\DashboardController::class, 'index'])->name('donator.dashboard');
        Route::get('/mydonations', [App\Http\Controllers\Admin\DonationController::class, 'index'])->name('donations.mydonations');
    });

    // Blogger Only
    Route::middleware(['isBlogger'])->group(function() {
        Route::get('/blogger/dashboard', [\App\Http\Controllers\Blogger\DashboardController::class, 'index'])->name('blogger.dashboard');
        Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class)->names('blogs');
    });
});
