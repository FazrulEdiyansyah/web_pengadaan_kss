<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SpphController;
use App\Http\Controllers\KategoriPenyetujuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ApprovalController;

Route::get('/', function () {
    return view('welcome');
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Approver Management
    Route::get('/approver-management', [AdminController::class, 'approverManagement'])->name('approver.management');
    Route::post('/make-approver', [AdminController::class, 'makeApprover'])->name('make.approver');
    Route::post('/remove-approver', [AdminController::class, 'removeApprover'])->name('remove.approver');
    
    // Vendor Management
    Route::get('/vendor-management', [AdminController::class, 'vendorManagement'])->name('vendor.management');
    Route::post('/vendor', [AdminController::class, 'storeVendor'])->name('vendor.store');
    Route::put('/vendor/{id}', [AdminController::class, 'updateVendor'])->name('vendor.update');
    Route::delete('/vendor/{id}', [AdminController::class, 'deleteVendor'])->name('vendor.delete');
});

// Approver Routes
Route::middleware(['auth', 'role:approver'])->prefix('approval')->name('approval.')->group(function () {
    Route::get('/', [ApprovalController::class, 'index'])->name('index');
    Route::get('/{id}', [ApprovalController::class, 'show'])->name('show');
    Route::post('/{id}/approve', [ApprovalController::class, 'approve'])->name('approve');
    Route::post('/{id}/reject', [ApprovalController::class, 'reject'])->name('reject');
});
