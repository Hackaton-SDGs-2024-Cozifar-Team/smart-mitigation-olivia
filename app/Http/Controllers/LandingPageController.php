<?php

namespace App\Http\Controllers;

use App\Models\ArtikelBencana;
use App\Models\LaporanBencana;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        $bencana = LaporanBencana::withSum(['donasi as total_donasi' => function ($query) {
            $query->where('jenis_donasi', 'uang');
        }], 'nominal_donasi')
        ->get();
        return view('all.pages.main', [
            'artikel' => ArtikelBencana::orderBy('tanggal', 'desc')->take(6)->get(),
            'bencana' => $bencana
        ]);
    }

    public function indexDashboard(){
        return view('admin.pages.dashboard');
    }

    public function tutupanLahan()
    {
        return view('all.pages.tampilan-tutupan-lahan');
    }
}
