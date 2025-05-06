<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DashboardMitraController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


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

// auth mitra
Route::get('login', function () {
    return view('auth.mitra.login');
})->name('login');
Route::get('mitra/register', function () {
    return view('auth.mitra.register');
})->name('mitra.register');


// Home page route
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


Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [HomeController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/dashboard/category', [HomeController::class, 'category'])->name('customer.dashboard.category');
});

Route::middleware(['auth', 'role:mitra'])->group(function () {
});
Route::get('/mitra/dashboard', [DashboardMitraController::class, 'index'])->name('mitra.dashboard');


