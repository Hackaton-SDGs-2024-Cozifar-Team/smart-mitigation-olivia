<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanBencana;
use App\Models\PenggunaanDanaDonasi;
use Illuminate\Http\Request;

class penggunaanDonasiController extends Controller
{
    public function index()
    {
        return view('admin.pages.penggunaan-donasi', [
            'judul' => 'Penggunaan Donasi',
            'penggunaan_donasi' => PenggunaanDanaDonasi::all()
        ]);
    }

    public function create()
    {
        // gabung 2 tabel
        $laporanBencana = LaporanBencana::with(['donasis', 'penggunaanDonasi'])->get();

        $disasterData = $laporanBencana->map(function ($data) {
            // total donasi untuk bencana
            $totalDonasi = $data->donasis->where('jenis_donasi', 'uang')->sum('nominal_donasi');

            // total penggunaan untuk bencana
            $totalPenggunaan = $data->penggunaanDonasi->sum('nominal_uang');

            // sisa dana
            $sisa = $totalDonasi - $totalPenggunaan;

            return [
                'id_laporan_bencana' => $data->id_laporan_bencana,
                'nama_bencana' => $data->nama_bencana,
                'sisa' => $sisa > 0 ? $sisa : 0
            ];
        });

        return view('admin.pages.create-penggunaan-donasi', [
            'disasterData' => $disasterData
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_lapora_bencana' => 'required',
            'nama_kebutuhan' => 'required',
            'nominal_uang' => 'required|numeric',
            'foto_struk' => 'required|image|mimes:jpg,png,jpeg|max:5000',
            'tanggal_pembelian' => 'required|date',
            'bukti_keterangan' => 'required|image|mimes:jpg,png,jpeg|max:5000'
        ]);

        // Dapatkan data laporan bencana dan hitung sisa donasi
        $laporanBencana = LaporanBencana::with(['donasis', 'penggunaanDonasi'])
            ->findOrFail($request->id_lapora_bencana);

        $totalDonasi = $laporanBencana->donasis->where('jenis_donasi', 'uang')->sum('nominal_donasi');
        $totalPenggunaan = $laporanBencana->penggunaanDonasi->sum('nominal_uang');
        $sisa = $totalDonasi - $totalPenggunaan;

        // Validasi nominal uang melebihi sisa donasi
        if ($request->nominal_uang > $sisa) {
            return redirect()->back()->withErrors(['nominal_uang' => 'Nominal tidak boleh melebihi sisa donasi yang tersedia.'])->withInput();
        }

        if ($request->hasFile('foto_struk')) {
            $imageStruk = $request->file('foto_struk');
            $originalNameStruk = $imageStruk->getClientOriginalName();
            $imageStruk->move(public_path('uploads/penggunaan-donasi'), $originalNameStruk);
            $validatedData['foto_struk'] = $originalNameStruk;
        }

        if ($request->hasFile('bukti_keterangan')) {
            $imageKet = $request->file('bukti_keterangan');
            $originalNameKet = $imageKet->getClientOriginalName();
            $imageKet->move(public_path('uploads/penggunaan-donasi'), $originalNameKet);
            $validatedData['bukti_keterangan'] = $originalNameKet;
        }

        PenggunaanDanaDonasi::create($validatedData);
        return redirect()->route('admin.penggunaan-donasi')->with('success', 'Penggunaan dana donasi berhasil disimpan.');
    }
}
