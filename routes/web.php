<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DashboardMitraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MitraAuthController;
use App\Models\Mitra;
use Illuminate\Support\Facades\Route;




// Landing page route
Route::get('/', function () {
    return view('main');
})->name('main');
Route::get('/about', function () {
    return view('about');
})->name('about');




// auth customer
Route::get('customer/register', function () {
    return view('auth.customer.register');
})->name('customer.register');
Route::post('auth/register/customer', [CustomerAuthController::class, 'register'])->name('auth.customer.register');


Route::get('mitra/register', function () {
    return view('auth.mitra.register');
})->name('mitra.register');

Route::post('auth/register/mitra', [MitraAuthController::class, 'register'])->name('auth.mitra.register');


// Dashboard Customer
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Category routes
Route::get('/untuk-kamu', [HomeController::class, 'category'])->name('category.for-you');
Route::get('/layanan-umum', [HomeController::class, 'category'])->name('category.general-services');
Route::get('/bengkel-kendaraan', [HomeController::class, 'category'])->name('category.vehicle-workshop');
Route::get('/layanan-rumah-tangga', [HomeController::class, 'category'])->name('category.household-services');
Route::get('/pekerjaan-freelance', [HomeController::class, 'category'])->name('category.freelance');
Route::get('/lain-lain', [HomeController::class, 'category'])->name('category.others');


// Service detail page
Route::get('/service/{id}', [HomeController::class, 'serviceDetail'])->name('service.detail');



// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




// Route untuk customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [HomeController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/dashboard/category', [HomeController::class, 'category'])->name('customer.dashboard.category');
});



// Route untuk mitra
Route::middleware(['auth', 'role:mitra'])->group(function () {
    Route::get('/mitra/dashboard', [DashboardMitraController::class, 'index'])->name('mitra.dashboard');

    Route::get('mitra/dashboard/job-terdekat', function () {
        return view('mitra.job-terdekat');
    })->name('mitra.dashboard.job-terdekat');

    Route::get('mitra/dashboard/riwayat', function () {
        return view('mitra.riwayat-pekerjaan');
    })->name('mitra.dashboard.riwayat');

    Route::get('mitra/dashboard/area', function () {
        return view('mitra.area');
    })->name('mitra.dashboard.area');

    Route::get('mitra/dashboard/penawaran', function () {
        return view('mitra.penawaran');
    })->name('mitra.dashboard.penawaran');
});





// slicing hilmy
Route::get('/utama', function () {
    return view('home');
})->name('utama');
