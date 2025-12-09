<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Route untuk Daftar Kamar Publik (Index)
Route::get('/rooms', [RoomController::class, 'publicIndex'])->name('rooms.index');

// Route placeholder untuk Booking per Kamar
Route::get('/rooms/{id}/book', [RoomController::class, 'book'])->name('rooms.book');

// User dashboard
Route::get('/dashboard', [PenggunaController::class, 'index'])
    ->middleware('auth');

// Admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware('admin');

Route::resource('kamar', \App\Http\Controllers\KamarController::class);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('bookings', BookingController::class);
});

Route::middleware(['admin'])->group(function () {
    Route::resource('pengguna', PenggunaController::class); });

Route::resource('transactions', \App\Http\Controllers\TransactionController::class);

Route::middleware('admin')->group(function () {
    Route::resource('laporans', \App\Http\Controllers\LaporanController::class);
});
