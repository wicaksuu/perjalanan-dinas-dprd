<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomisiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendampingController;
use App\Http\Controllers\KegiatanDinasController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes
    Route::get('komisi', App\Livewire\KomisiIndex::class)->name('komisi.index'); // Livewire Refactor
    Route::resource('komisi', KomisiController::class)->except(['index']);

    Route::get('anggota', App\Livewire\AnggotaIndex::class)->name('anggota.index'); // Livewire Refactor
    Route::resource('anggota', AnggotaController::class)->except(['index'])->parameters(['anggota' => 'anggota']);

    Route::get('pegawai', App\Livewire\PegawaiIndex::class)->name('pegawai.index'); // Livewire Refactor
    Route::resource('pegawai', PegawaiController::class)->except(['index']);
    
    Route::get('pendamping', App\Livewire\PendampingIndex::class)->name('pendamping.index'); // Livewire Refactor
    Route::resource('pendamping', PendampingController::class)->except(['index']);
    
    Route::get('kegiatan-dinas/create', App\Livewire\KegiatanDinasForm::class)->name('kegiatan-dinas.create'); // Livewire Create Form
    Route::get('kegiatan-dinas/{kegiatan_dinas}/edit', App\Livewire\KegiatanDinasForm::class)->name('kegiatan-dinas.edit'); // Livewire Edit Form
    Route::get('kegiatan-dinas', App\Livewire\KegiatanDinasIndex::class)->name('kegiatan-dinas.index'); // Livewire Refactor
    Route::get('/kegiatan-dinas/kalender', App\Livewire\KegiatanDinasCalendar::class)->name('kegiatan-dinas.kalender');
    Route::get('/kegiatan-dinas/laporan', App\Livewire\KegiatanDinasLaporan::class)->name('kegiatan-dinas.laporan');
    Route::get('/kegiatan-dinas/laporan-pegawai', App\Livewire\KegiatanDinasLaporanPegawai::class)->name('kegiatan-dinas.laporan-pegawai');
    Route::get('/kegiatan-dinas/laporan-pimpinan', App\Livewire\KegiatanDinasLaporanPimpinan::class)->name('kegiatan-dinas.laporan-pimpinan');
    Route::resource('kegiatan-dinas', KegiatanDinasController::class)->except(['index', 'create', 'store', 'edit', 'update'])->parameters(['kegiatan-dinas' => 'kegiatan_dinas']);
    
    // API routes for dynamic loading
    Route::get('/api/anggota-by-komisi/{komisiId}', [KegiatanDinasController::class, 'getAnggotaByKomisi']);
    Route::get('/api/pendamping-by-komisi/{komisiId}', [KegiatanDinasController::class, 'getPendampingByKomisi']);
});
