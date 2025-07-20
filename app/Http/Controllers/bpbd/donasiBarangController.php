<?php

namespace App\Http\Controllers\bpbd;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;

class donasiBarangController extends Controller
{
    public function index()
    {
        return view('bpbd.pages.donasi-barang', [
            'judul' => 'Donasi Barang',
            'donasi_barang' => Donasi::where('jenis_donasi', 'barang')->get()
        ]);
    }

    public function donasiDitolak($id)
    {
        $donasi = Donasi::find($id);
        $donasi->status = 'ditolak';
        $donasi->save();
        return redirect()->route('bpbd.donasi-barang')->with('success', 'Donasi ditolak');
    }
}
