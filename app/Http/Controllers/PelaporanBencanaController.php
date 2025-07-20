<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\LaporanBencana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PelaporanBencanaController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::all();
        $desa = Desa::all();
        return view('all.pages.pelaporan-bencana',[
            'kecamatan' => $kecamatan,
            'desas' => $desa
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,png,jpeg|max:2048',
            'id_kecamatan' => 'required',
            'nama_bencana' => 'required',
            'deskripsi_bencana' => 'required',
            'deskripsi_alamat' => 'required',
            'tingkat_bencana' => 'required',
            'id_desa' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $newName = null;
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $newName = rand(0, 100). time().'.' . $ext;
            $file->move('uploads/bencana', $newName);
        }
        LaporanBencana::create([
            'id_kecamatan' => $request->id_kecamatan,
            'id_users' => Auth::user()->id_users,
            'nama_bencana' => $request->nama_bencana,
            'deskripsi_bencana' => $request->deskripsi_bencana,
            'deskripsi_alamat' => $request->deskripsi_alamat,
            'tingkat_bencana' => $request->tingkat_bencana,
            'tanggal_kejadian' => now(),
            'id_desa' => $request->id_desa,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto_bencana' => $newName,
            'target_uang_donasi' => 10000000,
            'status' => 'tidak terkonfirmasi',
        ]);
        return redirect('/')->with('success', 'Laporan bencana berhasil dikirim');
    }
}
