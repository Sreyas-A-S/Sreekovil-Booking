<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TempleController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\SettingController;

Route::get('/', [PublicController::class, 'home'])->name('public.home');
Route::get('/temples', [PublicController::class, 'templeIndex'])->name('public.temple.index');
Route::get('/temples/{temple}', [PublicController::class, 'templeShow'])->name('public.temple.show');
Route::get('/hotels/{hotel}', [PublicController::class, 'hotelShow'])->name('public.hotel.show');
Route::get('/search/suggestions', [PublicController::class, 'searchSuggestions'])->name('public.search.suggestions');

Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('temples', TempleController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('songs', SongController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
