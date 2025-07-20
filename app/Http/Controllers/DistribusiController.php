<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\LaporanBencana;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distribusi = Distribusi::all();
        return view('admin.pages.distribusi.main',[
            'judul' => 'Distribusi Barang',
            'distribusi' => $distribusi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $laporan_bencana = LaporanBencana::all();
        return view('admin.pages.distribusi.tambah',[
            'judul' => 'Tambah Distribusi Barang',
            'laporan_bencana' => $laporan_bencana
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_posko' => 'required',
            'nama_kebutuhan' => 'required',
            'jumlah' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);
        $newName = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $newName = rand(0, 100). time().'.' . $ext;
            $file->move('uploads/distribusi', $newName);
        }
        // dd($request->all());
        Distribusi::create([
            'id_posko' => $request->id_posko,
            'nama_kebutuhan' => $request->nama_kebutuhan,
            'jumlah' => $request->jumlah,
            'tanggal' => now(),
            'foto_keterangan' => $newName
        ]);
        return redirect()->route('distribusi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detailDistribusi($id)
    {
        $distribusi = Distribusi::where('id_posko', $id)->get();
        return view('all.pages.detail-distribusi',[
            'distribusi' => $distribusi
        ]);
    }
}
