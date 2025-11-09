<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HasilEnrollmentController;
use App\Http\Controllers\ShipmentAssignmentController;
use App\Http\Controllers\EnrollmentAssignmentController;

Route::get('/', fn() => to_route('dashboard'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/cetak', [DashboardController::class, 'cetak'])->name('dashboard.cetak');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware('role:kepala_gudang,teknisi,helper')->group(function () {
        Route::resource('penugasan-enrollment', EnrollmentAssignmentController::class)
            ->parameters(['penugasan-enrollment' => 'assignment']);
        // Aksi teknisi menyelesaikan tugas & input hasil
        Route::get('hasil-enrollment', [HasilEnrollmentController::class, 'index'])
            ->name('hasil-enrollment.index');
        Route::get('hasil-enrollment/{assignment}/create', [HasilEnrollmentController::class, 'create'])
            ->name('hasil-enrollment.create');
        Route::post('hasil-enrollment/{assignment}', [HasilEnrollmentController::class, 'store'])
            ->name('hasil-enrollment.store');
        // Penugasan Pengiriman (buat dari tugas yang sudah selesai)
        Route::resource('penugasan-pengiriman', ShipmentAssignmentController::class)
            ->parameters(['penugasan-pengiriman' => 'shipment'])
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::post('/hasil-enrollment/{assignment}/selesai-packing', [HasilEnrollmentController::class, 'selesaiPacking'])
            ->name('hasil-enrollment.selesaiPacking');
        Route::get('/laporan-enrollment', [LaporanController::class, 'index'])->name('laporan-enrollment.index');
        Route::get('/laporan-enrollment/cetak/{assignment}', [LaporanController::class, 'cetak'])->name('laporan-enrollment.cetak');
    });
});
