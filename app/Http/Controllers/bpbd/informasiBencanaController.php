<?php

namespace App\Http\Controllers\bpbd;

use Illuminate\Http\Request;
use App\Models\LaporanBencana;
use App\Models\InformasiBencana;
use App\Http\Controllers\Controller;

class informasiBencanaController extends Controller
{
    public function index()
    {
        return view('bpbd.pages.informasi-bencana', [
            'judul' => 'Informasi Bencana',
            'informasi_bencana' => InformasiBencana::all(),
        ]);
    }

    public function create()
    {
        return view('bpbd.pages.create-informasi-bencana', [
            'judul' => 'Tambah Informasi Bencana',
            'laporan_bencana' => LaporanBencana::all()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'id_laporan_bencana' => 'required',
            'korban_terluka' => 'required',
            'korban_meninggal' => 'required',
            'korban_hilang' => 'required',
            'korban_mengungsi' => 'required',
            'dampak_kerusakan' => 'required',
        ]);

        InformasiBencana::create($validatedData);
        return redirect()->route('bpbd.informasi-bencana')->with('success', 'Informasi data berhasil disimpan.');
    }

    public function edit($id)
    {
        $informasi_bencana = InformasiBencana::find($id);
        return view('bpbd.pages.update-informasi-bencana', [
            'judul' => 'Edit Informasi Bencana',
            'informasi_bencana' => $informasi_bencana,
            'laporan_bencana' => LaporanBencana::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'id_laporan_bencana' => 'required',
            'korban_terluka' => 'required',
            'korban_meninggal' => 'required',
            'korban_hilang' => 'required',
            'korban_mengungsi' => 'required',
            'dampak_kerusakan' => 'required',
        ], [
            'id_laporan_bencana.required' => 'Bencana alam harus dipilih.',
            'korban_terluka.required' => 'Korban terluka harus diisi.',
            'korban_meninggal.required' => 'Korban meninggal harus diisi.',
            'korban_hilang.required' => 'Korban hilang harus diisi.',
            'korban_mengungsi.required' => 'Korban mengungsi harus diisi.',
            'dampak_kerusakan.required' => 'Dampak kerusakan harus diisi.',
        ]);
        InformasiBencana::where('id_informasi_bencana', $id)->update($validatedData);
        return redirect()->route('bpbd.informasi-bencana')->with('success', 'Informasi data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $informasi_bencana = InformasiBencana::find($id);
        $informasi_bencana->delete();
        return redirect()->route('bpbd.informasi-bencana')->with('success', 'Informasi data berhasil dihapus.');
    }
}
