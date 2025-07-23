<?php

use App\Http\Controllers\admin\artikelBencanaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bpbd\dashboardBpbd;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\admin\dashboardAdmin;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DonationPageController;
use App\Http\Controllers\admin\donasiUangController;
use App\Http\Controllers\PelaporanBencanaController;
use App\Http\Controllers\bpbd\donasiBarangController;
use App\Http\Controllers\bpbd\laporanBencanaController;
use App\Http\Controllers\bpbd\informasiBencanaController;
use App\Http\Controllers\bpbd\laporanBencanaTerkonfirmasiController;
use App\Http\Controllers\PrediksiCuacaController;
use App\Http\Controllers\admin\penggunaanDonasiController;
use App\Http\Controllers\Api\GeminiController;
use App\Http\Controllers\bpbd\PoskoController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ClusteringBanjirController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersebaranBencanaControlller;
use App\Http\Controllers\PrediksiBencanaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Middleware\AksesAdmin;
use App\Http\Middleware\AksesBPBD;
use App\Http\Middleware\UserAkses;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');

// AUTH
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('checkLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'viewRegister'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('checkRegister');

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

//route untuk clustering
Route::get('/clustering-banjir', [ClusteringBanjirController::class, 'index'])->name('clustering-banjir');
//route untuk prediksi bencana
Route::get('/prediksi-bencana', [PrediksiBencanaController::class, 'index'])->name('prediksi-bencana');

//route untuk tutupan lahan
Route::get('/tutupan-lahan', [LandingPageController::class, 'tutupanLahan'])->name('tutupan-lahan');
//route untuk sebaran bencana
Route::get('/peta-persebaran-bencana', [PersebaranBencanaControlller::class, 'index'])->name('persebaran-bencana');

//route untuk pelaporan bencana
Route::get('/pelaporan-bencana', [PelaporanBencanaController::class, 'index'])->name('pelaporan-bencana')->middleware('auth');
Route::post('/pelaporan-bencana', [PelaporanBencanaController::class, 'store'])->name('pelaporan-bencana.store');
Route::get('/riwayat-bencana', [RiwayatController::class, 'indexRiwayatBencana'])->name('riwayat-bencana');
Route::get('/riwayat-donasi', [RiwayatController::class, 'indexRiwayatDonasi'])->name('riwayat-donasi');
//route untuk donasi
Route::get('/donasi', [DonationPageController::class, 'index'])->name('user.donasi');
Route::get('/detail-donasi/{id}', [DonationPageController::class, 'detailPage'])->name('user.donasi.detail');
Route::get('/tambah-donasi/{id}', [DonationController::class, 'index'])->name('user.donasi.tambah')->middleware('auth');
Route::post('/get-token', [DonationController::class, 'getToken'])->name('user.store.donasi-uang');
Route::post('/donasi-barang', [DonationController::class, 'storeBarang'])->name('user.store.donasi-barang');
Route::get('/detail-distribusi/{id}', [DistribusiController::class, 'detailDistribusi']);
// admin
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.pages.dashboard');
        });
        Route::get('/', [dashboardAdmin::class, 'index'])->name('admin.dashboard');

        // donasi uang
        Route::get('/donasi-uang', [donasiUangController::class, 'index'])->name('admin.donasi-uang');
        Route::put('/donasi-uang/{id}/ditolak', [donasiUangController::class, 'donasiDitolak'])->name('admin.donasi-uang.ditolak');

        // penggunaan donasi
        Route::get('/penggunaan-donasi', [penggunaanDonasiController::class, 'index'])->name('admin.penggunaan-donasi');
        Route::get('/create/penggunaan-donasi', [PenggunaanDonasiController::class, 'create'])->name('admin.penggunaan-donasi.create');
        Route::post('/create/penggunaan-donasi', [PenggunaanDonasiController::class, 'store'])->name('admin.penggunaan-donasi.store');

        Route::resource('distribusi', DistribusiController::class);
        
        // artikel bencana
        Route::get('/artikel-bencana', [artikelBencanaController::class, 'index'])->name('admin.artikel-bencana');
        Route::get('/create/artikel-bencana', [artikelBencanaController::class, 'create'])->name('admin.artikel-bencana.create');
        Route::post('/create/artikel-bencana', [artikelBencanaController::class, 'store'])->name('admin.artikel-bencana.store');
        Route::get('/edit/artikel-bencana/{id_artikel_bencana}', [artikelBencanaController::class, 'edit'])->name('admin.artikel-bencana.edit');
        Route::put('/update/artikel-bencana/{id_artikel_bencana}', [artikelBencanaController::class, 'update'])->name('admin.artikel-bencana.update');
        Route::delete('/delete/artikel-bencana/{id_artikel_bencana}', [artikelBencanaController::class, 'destroy'])->name('admin.artikel-bencana.delete');
    })->middleware([AksesAdmin::class]);
});

// bpbd
Route::middleware('auth')->group(function () {
    route::prefix('bpbd')->group(function () {
        Route::get('/', function () {
            return view('bpbd.pages.dashboard');
        });
        Route::get('/', [dashboardBpbd::class, 'index'])->name('bpbd.dashboard');

        //laporan bencana
        Route::get('/laporan-bencana', [laporanBencanaController::class, 'index'])->name('bpbd.laporan-bencana');
        Route::put('/laporan-bencana/{id_laporan_bencana}/diterima', [laporanBencanaController::class, 'laporanDiterima'])->name('bpbd.laporan-bencana.diterima');
        Route::put('/laporan-bencana/{id_laporan_bencana}/ditolak', [laporanBencanaController::class, 'laporanDitolak'])->name('bpbd.laporan-bencana.ditolak');

        Route::get('/laporan-bencana-terkonfirmasi', [laporanBencanaTerkonfirmasiController::class, 'index'])->name('bpbd.laporan-bencana-terkonfirmasi');
        Route::put('/laporan-bencana-selesai/{id}', [laporanBencanaTerkonfirmasiController::class, 'laporanSelesai'])->name('bpbd.laporan-bencana-selesai');

        //informasi bencana
        Route::get('/informasi-bencana', [informasiBencanaController::class, 'index'])->name('bpbd.informasi-bencana');
        Route::get('/create/informasi-bencana', [informasiBencanaController::class, 'create'])->name('bpbd.informasi-bencana.create');
        Route::post('/create/informasi-bencana', [informasiBencanaController::class, 'store'])->name('bpbd.informasi-bencana.store');
        Route::get('/update/informasi-bencana/{id}', [informasiBencanaController::class, 'edit'])->name('bpbd.informasi-bencana.edit');
        Route::put('/update/informasi-bencana/{id}', [informasiBencanaController::class, 'update'])->name('bpbd.informasi-bencana.update');
        Route::delete('/delete/informasi-bencana/{id}', [informasiBencanaController::class, 'destroy'])->name('bpbd.informasi-bencana.delete');

        //donasi barang
        Route::get('/donasi', [donasiBarangController::class, 'index'])->name('bpbd.donasi-barang');
        // Route::put('/donasi/{id}/diterima', [donasiBarangController::class, 'donasiDiterima'])->name('bpbd.donasi-barang.diterima');
        Route::put('/donasi/{id_donasi}/ditolak', [donasiBarangController::class, 'donasiDitolak'])->name('bpbd.donasi-barang.ditolak');

        Route::resource('posko', PoskoController::class);
    })->middleware([AksesBPBD::class]);
});

Route::post('/gemini-articles', [GeminiController::class, 'getArticles']);
Route::get('/artikel/detail', function () {
    return view('all.pages.detail-artikel');
})->name('artikel.detail');

// Profile routes (add these to your existing routes)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});
