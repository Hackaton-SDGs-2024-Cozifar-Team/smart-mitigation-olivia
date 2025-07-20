<?php

namespace App\Http\Controllers\bpbd;

use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Models\LaporanBencana;
use App\Models\InformasiBencana;
use App\Http\Controllers\Controller;
use App\Models\PenggunaanDanaDonasi;

class dashboardBpbd extends Controller
{
    public function index()
    {
        return view('bpbd.pages.dashboard', [
            'judul' => 'Dashboard BPBD',
            'laporan_bencana' => LaporanBencana::all(),
            'informasi_bencana' => InformasiBencana::all(),
            // 'donasi_barang' => Donasi::where('jenis_donasi', 'barang')->orderby('tanggal_donasi', 'desc')->take(5)->get(),
            'donasi_barang' => Donasi::where('jenis_donasi', 'barang')->get(),
            'penggunaan_donasi' => PenggunaanDanaDonasi::orderBy('tanggal_pembelian', 'desc')->take(5)->get()
        ]);
    }
}
