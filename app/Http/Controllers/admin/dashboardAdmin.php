<?php

namespace App\Http\Controllers\admin;

use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Models\InformasiBencana;
use App\Http\Controllers\Controller;
use App\Models\PenggunaanDanaDonasi;

class dashboardAdmin extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard', [
            'judul' => 'Dashboard Admin',
            'informasi_bencana' => InformasiBencana::all(),
            'donasi_uang' => Donasi::where('jenis_donasi', 'uang')->orderby('tanggal_donasi', 'desc')->take(5)->get(),
            'penggunaan_donasi' => PenggunaanDanaDonasi::orderBy('tanggal_pembelian', 'desc')->take(5)->get()
        ]);
    }
}
