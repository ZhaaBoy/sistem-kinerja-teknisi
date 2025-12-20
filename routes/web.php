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
Route::get('/api/search/customers', function () {
    $q = trim(request('q', ''));

    return \App\Models\Customer::with('barang')
        ->when(
            $q !== '',
            fn($q2) =>
            $q2->where('nama_customer', 'like', "%{$q}%")
        )
        ->limit(10)
        ->get()
        ->map(fn($c) => [
            'id'           => $c->id,
            'nama_customer' => $c->nama_customer,
            'barang_id'    => $c->barang_id,
            'nama_barang'  => $c->barang?->nama_barang,
            'kode_barang'  => $c->barang?->kode_barang,
        ]);
})->name('api.customers.search');


Route::get('/api/search/barangs', function () {
    $q = trim(request('q', ''));

    return \App\Models\Barang::query()
        ->when($q !== '', function ($query) use ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_barang', 'like', "%{$q}%")
                    ->orWhere('kode_barang', 'like', "%{$q}%");
            });
        })
        ->orderBy('nama_barang')
        ->limit(10)
        ->get(['id', 'nama_barang', 'kode_barang']);
})->name('api.barangs.search');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/cetak', [DashboardController::class, 'cetak'])->name('dashboard.cetak');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('customers', \App\Http\Controllers\CustomerController::class);
        Route::resource('barangs', \App\Http\Controllers\BarangController::class);
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
        Route::get('/laporan-enrollment/cetak-semua', [LaporanController::class, 'cetakSemua'])
            ->name('laporan-enrollment.cetak-semua');
    });
});
