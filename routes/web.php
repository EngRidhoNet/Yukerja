<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DashboardMitraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MitraProfileController;
use App\Http\Controllers\MitraAuthController;
use App\Http\Controllers\MitraDashboardController;
use App\Http\Controllers\JobHistoryController;
use App\Http\Controllers\ServiceAreaController;
use Illuminate\Support\Facades\Route;

// Landing page route
Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Customer homepage view (if static)
Route::view('/customer/homepage', 'customer.homepage')->name('customer.homepage');

// Authentication Routes for Customers
Route::get('customer/register', function () {
    return view('auth.customer.register');
})->name('customer.register');

Route::post('auth/register/customer', [CustomerAuthController::class, 'register'])->name('auth.customer.register');

// Authentication Routes for Mitra
Route::get('mitra/register', function () {
    return view('auth.mitra.register');
})->name('mitra.register');

Route::post('auth/register/mitra', [MitraAuthController::class, 'register'])->name('auth.mitra.register');

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home & Category Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/category/{categorySlug}', [HomeController::class, 'category'])->name('category');

// Service detail page
Route::get('/service/{id}', [HomeController::class, 'serviceDetail'])->name('service.detail');

// Routes protected by Customer Authentication and Role
Route::middleware(['auth', 'role:customer'])->group(function () {

    // Customer dashboard routes
    Route::get('/customer/dashboard', [HomeController::class, 'index'])->name('customer.dashboard');

    Route::get('/customer/dashboard/category', [HomeController::class, 'category'])->name('customer.dashboard.category');

    // Edit Profile route replaced by controller method to pass data dynamically
     Route::get('/customer/edit_profile', [HomeController::class, 'editProfile'])->name('customer.edit_profile');

    // Transaction status pages
    Route::view('/transaksi_berhasil', 'customer.transaksi_berhasil')->name('transaksi.berhasil');
    Route::view('/transaksi_dikembalikan', 'customer.transaksi_dikembalikan')->name('transaksi.dikembalikan');
});

// Routes protected by Mitra Authentication and Role
Route::prefix('mitra')->middleware(['auth', 'role:mitra'])->group(function () {

    Route::get('/dashboard', [MitraDashboardController::class, 'index'])->name('mitra.dashboard');

    Route::get('/dashboard/job-terdekat', [MitraDashboardController::class, 'nearbyJobs'])->name('mitra.dashboard.job-terdekat');

    Route::get('/dashboard/riwayat', [JobHistoryController::class, 'index'])->name('mitra.dashboard.riwayat');

    Route::get('/dashboard/area', [ServiceAreaController::class, 'index'])->name('mitra.dashboard.area');

    Route::get('/dashboard/penawaran', function () {
        return view('mitra.penawaran');
    })->name('mitra.dashboard.penawaran');

    Route::get('/dashboard/edit-profile', [MitraProfileController::class, 'edit'])->name('mitra.dashboard.edit-profile');
    Route::put('/dashboard/edit-profile/update', [MitraProfileController::class, 'update'])->name('profile.update');
    Route::post('/dashboard/edit-profile/portofolio', [MitraProfileController::class, 'storePortfolio'])->name('portfolio.store');

    Route::get('/dashboard/pengaturan', function () {
        return view('mitra.pengaturan');
    })->name('mitra.dashboard.pengaturan');
});

// Optional route named utama, for home view
Route::get('/utama', function () {
    return view('home');
})->name('utama');
