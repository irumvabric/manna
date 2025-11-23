<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Donation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/get-involved', function () {
    return view('pages.get_involved');
})->name('get_involved');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/donations', [Donation::class, 'index'])->name('donations.index');
    Route::get('/donators', [Donation::class, 'index'])->name('donators.index');
    // Route::get('contacts', [ContactsController::class, 'index'])->name('contacts.index');
    // Route::get('contacts/{contact}', [ContactsController::class, 'show'])->name('contacts.show');
    // Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
});

Route::get('/dashboard', DashboardController::class . '@index')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
