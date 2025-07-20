<?php

namespace App\Http\Controllers;

use App\Models\LaporanBencana;
use App\Models\PrediksiBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrediksiBencanaController extends Controller
{
    public function index()
    {
        $subquery = DB::table('prediksi_bencanas')
        ->select('id_desa', DB::raw('MAX(tanggal_prediksi) as tanggal_prediksi'))
        ->where('status_prediksi', 'terprediksi')
        ->groupBy('id_desa');

    $prediksi = DB::table('prediksi_bencanas as pb')
        ->joinSub($subquery, 'latest', function ($join) {
            $join->on('pb.id_desa', '=', 'latest.id_desa')
                 ->on('pb.tanggal_prediksi', '=', 'latest.tanggal_prediksi');
        })
        ->join('desas', 'pb.id_desa', '=', 'desas.id_desa')
        ->select('pb.id_desa', 'pb.tanggal_prediksi', 'desas.latitude','desas.longitude','desas.nama_desa','pb.tanggal_prediksi')
        ->get();

        $prediksi_bencana = PrediksiBencana::limit(2)->get();
        $laporan_bencana = LaporanBencana::all();
        return view('all.pages.prediksi-bencana',[
            'prediksi_bencana' => $prediksi_bencana,
            'laporan_bencana' => $laporan_bencana,
            'prediksi' => $prediksi
        ]);
    }
}
