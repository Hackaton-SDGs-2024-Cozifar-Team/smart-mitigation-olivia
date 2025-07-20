<?php

namespace App\Http\Controllers\bpbd;

use Illuminate\Http\Request;
use App\Models\LaporanBencana;
use App\Http\Controllers\Controller;

class laporanBencanaTerkonfirmasiController extends Controller
{
    public function index()
    {
        return view('bpbd.pages.laporan-bencana-terkonfirmasi', [
            'judul' => 'Laporan Bencana',
            'laporan_bencana' => LaporanBencana::where('status', 'terkonfirmasi')->get()
        ]);
    }

    public function laporanSelesai($id)
    {
        $laporan = LaporanBencana::find($id);
        $laporan->status = 'selesai';
        $laporan->save();
        return redirect()->route('bpbd.laporan-bencana-terkonfirmasi');
    }
}
