<?php

use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index',);
});


Route::get('/about', function () {
    return view('pages.about',);
});

Route::get('/contact', function () {
    return view('pages.contact',);
});

Route::get('/get-involved', function () {
    return view('pages.get_involved',);
});

Route::post('/donate_form', [DonationController::class ,'store'])->name('donate.submit');
Route::post('/contact_form', [DonationController::class ,'contactSubmit'])->name('contact.submit');

Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';