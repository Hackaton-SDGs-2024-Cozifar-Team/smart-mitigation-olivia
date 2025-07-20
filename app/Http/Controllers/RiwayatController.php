<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\LaporanBencana;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function indexRiwayatBencana(){
        return view('all.pages.riwayat-bencana', [
           'laporan_bencanas' =>  LaporanBencana::all(),
        ]);
    }
    public function indexRiwayatDonasi(){
        return view('all.pages.riwayat-donasi',[
            'laporan_donasis' =>  Donasi::all(),
         ]);
    }
}
