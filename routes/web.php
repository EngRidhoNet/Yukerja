<?php

use App\Http\Controllers\MitraTransactionController;
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
    ServiceAreaController,
    JobApplicationController,
    JobPostController,
    TransactionController
};

use Chatify\Http\Controllers\MessagesController;

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
// Chatify Routes
// ==============================



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
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardCustomerController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/mitra/{id}', [DashboardCustomerController::class, 'show'])->name('mitra.show');
    Route::get('/mitra/category/{categoryId}', [DashboardCustomerController::class, 'getMitrasByCategory'])->name('mitra.category');

    // Job Posts
    Route::get('/dashboard/post-job',[JobPostController::class,'create'])->name('dashboard.post-job');
    Route::post('/dashboard/post-job/store', [JobPostController::class, 'store'])->name('dashboard.post-job.store');


    // Job Applications (Penawaran)
    Route::get('/dashboard/penawaran', [JobApplicationController::class, 'index'])->name('dashboard.penawaran');
    Route::get('/jobs/{jobPost}/applications', [JobApplicationController::class, 'getApplications'])->name('dashboard.applications.get');
    Route::post('/applications/{application}/deal', [JobApplicationController::class, 'deal'])->name('dashboard.applications.deal');
    Route::post('/applications/{application}/accept', [JobApplicationController::class, 'accept'])->name('dashboard.applications.accept');
    Route::post('/applications/{application}/reject', [JobApplicationController::class, 'reject'])->name('dashboard.applications.reject');
    Route::post('/applications/{application}/rate', [JobApplicationController::class, 'rate'])->name('dashboard.applications.rate');
    Route::post('/applications/{application}/delete', [JobApplicationController::class, 'delete'])->name('dashboard.applications.delete');

    // Order History
    Route::get('/dashboard/history', [TransactionController::class, 'index'])->name('dashboard.history');
    Route::get('/dashboard/history/{id}', [TransactionController::class, 'show'])->name('dashboard.history.show');
    Route::get('/dashboard/history/export', [TransactionController::class, 'export'])->name('dashboard.history.export');
});

// ==============================
// Mitra Dashboard & Features
// ==============================
Route::middleware(['auth', 'role:mitra'])->prefix('mitra/dashboard')->group(function () {
    Route::get('/', [MitraDashboardController::class, 'index'])->name('mitra.dashboard');
    Route::get('/job-terdekat', [MitraDashboardController::class, 'nearbyJobs'])->name('mitra.dashboard.job-terdekat');
    Route::get('/riwayat', [JobHistoryController::class, 'index'])->name('mitra.dashboard.riwayat');
    Route::get('/area', [ServiceAreaController::class, 'index'])->name('mitra.dashboard.area');
    Route::post('/area/update-location', [ServiceAreaController::class, 'updateLocation'])->name('mitra.area.update-location');
    Route::post('/area/save', [ServiceAreaController::class, 'saveServiceAreas'])->name('mitra.area.save');
    Route::get('/area/provinces', [ServiceAreaController::class, 'getProvinces'])->name('mitra.area.provinces');
    Route::get('/area/cities/{provinceId}', [ServiceAreaController::class, 'getCities'])->name('mitra.area.cities');
    Route::get('/area/districts/{cityId}', [ServiceAreaController::class, 'getDistricts'])->name('mitra.area.districts');
    Route::get('/area/search-location', [ServiceAreaController::class, 'searchLocation'])->name('mitra.area.search-location');
    
    Route::get('/transactions', [MitraTransactionController::class, 'index'])->name('mitra.dashboard.transactions');
    Route::get('/transactions/{transaction}/detail', [MitraTransactionController::class, 'show'])->name('mitra.dashboard.transaction.detail');
    // Penawaran
    Route::view('/penawaran', 'mitra.penawaran')->name('mitra.dashboard.penawaran');
    
    // Edit Profile & Portfolio
    Route::get('/edit-profile', [MitraProfileController::class, 'edit'])->name('mitra.dashboard.edit-profile');
    Route::put('/edit-profile/update', [MitraProfileController::class, 'update'])->name('profile.update');
    Route::post('/edit-profile/portofolio', [MitraProfileController::class, 'storePortfolio'])->name('portfolio.store');
    Route::get('/job/{job}/detail', [MitraDashboardController::class, 'jobDetail'])->name('mitra.job.detail');
    Route::post('/job/{job}/apply', [MitraDashboardController::class, 'applyJob'])->name('mitra.job.apply');

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
