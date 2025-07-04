<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SpphController;
use App\Http\Controllers\KategoriPenyetujuController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route login TANPA middleware guest
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Route register TANPA middleware guest
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    Route::get('/spph/create', [SpphController::class, 'create'])->name('spph.create');
    Route::post('/spph', [SpphController::class, 'store'])->name('spph.store');
    Route::get('/spph/overview', [SpphController::class, 'overview'])->name('spph.overview');
    Route::get('/spph/{id}', [App\Http\Controllers\SpphController::class, 'show'])->name('spph.show');
    Route::get('/sph/overview', function () {
        return view('sph.overview');
    })->name('sph.overview');
});