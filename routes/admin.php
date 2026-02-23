<?php
// routes/admin.php

use App\Http\Controllers\Admin\BeneficiaryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DonatorController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BloggerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
   
    // Admin Only
    Route::middleware(['isAdmin'])->group(function() {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Donators Management
        Route::get('/donators', [DonatorController::class, 'index'])->name('donators.index');
        Route::post('/donators', [DonatorController::class, 'store'])->name('donators.store');
        Route::put('/donators/{donator}', [DonatorController::class, 'update'])->name('donators.update');
        Route::delete('/donators/{donator}', [DonatorController::class, 'destroy'])->name('donators.destroy');

        // Donations Management
        Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
        Route::post('/donations', [DonationController::class, 'storeManual'])->name('donations.store-manual');
        Route::put('/donations/{donation}', [DonationController::class, 'update'])->name('donations.update');
        Route::delete('/donations/{donation}', [DonationController::class, 'destroy'])->name('donations.destroy');

        // Beneficiaries Management
        Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiaries.index');
        Route::post('/beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');
        Route::put('/beneficiaries/{beneficiary}', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');
        Route::delete('/beneficiaries/{beneficiary}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');

        // Reports
        Route::get('/reports/export/{type}', [ReportController::class, 'export'])->name('reports.export');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

        // Expenses
        Route::get('/beneficiaries/{beneficiary}/expenses', [ExpenseController::class, 'index'])->name('beneficiaries.expenses.index');
        Route::post('/beneficiaries/{beneficiary}/expenses', [ExpenseController::class, 'store'])->name('beneficiaries.expenses.store');
        Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

         Route::resource('blogs', BlogController::class)->names('blogs');
    });

    // Donator Only
    Route::middleware(['isDonator'])->group(function() {
        Route::get('/donator/dashboard', [DonatorController::class, 'index'])->name('donator.dashboard');
        Route::get('/mydonations', [DonationController::class, 'index'])->name('donations.mydonations');
    });

    // Blogger Only
    Route::middleware(['isBlogger'])->group(function() {
        Route::get('/blogger/dashboard', [BlogController::class, 'index'])->name('blogger.dashboard');
        Route::resource('blogs', BlogController::class)->names('blogs');
    });
});
