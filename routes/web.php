<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CustomerAuthController,
    DashboardCustomerController,
    DashboardMitraController,
    HomeController,
    MitraProfileController,
    MitraAuthController,
    MitraDashboardController,
    JobHistoryController,
    ServiceAreaController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Struktur routing dikelompokkan berdasarkan:
| - Landing Page
| - Auth (Customer & Mitra)
| - Dashboard (Customer & Mitra)
| - Layanan
| - Testing/Slicing
*/

// ==============================
// Landing Page & Public Pages
// ==============================
Route::view('/', 'main')->name('main');
Route::view('/about', 'about')->name('about');
Route::get('/service/{id}', [HomeController::class, 'serviceDetail'])->name('service.detail');

// ==============================
// Auth Routes (Login & Logout)
// ==============================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==============================
// Customer Registration & Auth
// ==============================
Route::view('customer/register', 'auth.customer.register')->name('customer.register');
Route::post('auth/register/customer', [CustomerAuthController::class, 'register'])->name('auth.customer.register');

// ==============================
// Mitra Registration & Auth
// ==============================
Route::view('mitra/register', 'auth.mitra.register')->name('mitra.register');
Route::post('auth/register/mitra', [MitraAuthController::class, 'register'])->name('auth.mitra.register');

// ==============================
// Customer Dashboard
// ==============================
Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/dashboard', [DashboardCustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/dashboard/mitra/{id}', [DashboardCustomerController::class, 'show'])->name('customer.dashboard.mitra.show');
    // Route::get('/dashboard/post-job', function () {
    //     return view('customer.post_job');
    // })->name('customer.dashboard.post-job');

    Route::get('/dashboard/post-job', [App\Http\Controllers\JobPostController::class, 'create'])->name('customer.dashboard.post-job');
    Route::post('/dashboard/post-job/store', [App\Http\Controllers\JobPostController::class, 'store'])->name('customer.dashboard.post-job.store');
    Route::get('/dashboard/history', function(){
        return view('customer.order_history');
    })->name('customer.dashboard.history');
    Route::get('dashboard/penawaran', function () {
        return view('customer.penawaran');
    })->name('customer.dashboard.penawaran');
});

// ==============================
// Mitra Dashboard & Features
// ==============================
Route::middleware(['auth', 'role:mitra'])->prefix('mitra/dashboard')->group(function () {
    Route::get('/', [MitraDashboardController::class, 'index'])->name('mitra.dashboard');
    Route::get('/job-terdekat', [MitraDashboardController::class, 'nearbyJobs'])->name('mitra.dashboard.job-terdekat');
    Route::get('/riwayat', [JobHistoryController::class, 'index'])->name('mitra.dashboard.riwayat');
    Route::get('/area', [ServiceAreaController::class, 'index'])->name('mitra.dashboard.area');
    
    // Penawaran
    Route::view('/penawaran', 'mitra.penawaran')->name('mitra.dashboard.penawaran');
    
    // Edit Profile & Portfolio
    Route::get('/edit-profile', [MitraProfileController::class, 'edit'])->name('mitra.dashboard.edit-profile');
    Route::put('/edit-profile/update', [MitraProfileController::class, 'update'])->name('profile.update');
    Route::post('/edit-profile/portofolio', [MitraProfileController::class, 'storePortfolio'])->name('portfolio.store');

    // Pengaturan
    Route::view('/pengaturan', 'mitra.pengaturan')->name('mitra.dashboard.pengaturan');
});

// ==============================
// Universal Dashboard Home (fallback)
// ==============================
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==============================
// Slicing / Testing View
// ==============================
Route::view('/utama', 'home')->name('utama');
