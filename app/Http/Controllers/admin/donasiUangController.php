<?php

namespace App\Http\Controllers\admin;

use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class donasiUangController extends Controller
{
    public function index()
    {
        return view('admin.pages.donasi-uang', [
            'judul' => 'Donasi Uang',
            'donasi_uang' => Donasi::where('jenis_donasi', 'uang')->get()
        ]);
    }

    public function donasiDitolak($id)
    {
        $donasi = Donasi::find($id);
        $donasi->status = 'ditolak';
        $donasi->save();
        return redirect()->route('admin.donasi-uang')->with('success', 'Donasi Uang Berhasil Ditolak');
    }
}
