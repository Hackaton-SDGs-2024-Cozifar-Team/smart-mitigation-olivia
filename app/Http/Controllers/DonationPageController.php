<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanKorban;
use App\Models\LaporanBencana;
use Illuminate\Http\Request;

class DonationPageController extends Controller
{
    public function index()
    {
        $bencana = LaporanBencana::withSum(['donasi as total_donasi' => function ($query) {
            $query->where('jenis_donasi', 'uang');
        }], 'nominal_donasi')
        ->get();

        return view('all.pages.donation.main', [
            'title' => 'Donasi',
            'bencana' => $bencana
        ]);
    }

    public function detailPage($id)
    {
        $kebutuhanKorban = KebutuhanKorban::where('id_laporan_bencana', $id)->get();
        $bencana = LaporanBencana::withSum(['donasi as total_donasi_uang' => function ($query) {
            $query->where('jenis_donasi', 'uang');
        }], 'nominal_donasi')
        ->withSum(['donasi as total_donasi_barang' => function ($query) {
            $query->where('jenis_donasi', 'barang');
        }], 'jumlah_barang')
        ->where('id_laporan_bencana', $id)
        ->first();
        return view('all.pages.donation.detail', [
            "bencana" => $bencana ,
            "kebutuhanKorban" => $kebutuhanKorban
        ]);
    }
}