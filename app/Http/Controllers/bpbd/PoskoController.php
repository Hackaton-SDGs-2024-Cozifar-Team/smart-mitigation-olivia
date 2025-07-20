<?php

namespace App\Http\Controllers\bpbd;

use App\Http\Controllers\Controller;
use App\Models\LaporanBencana;
use App\Models\Posko;
use Illuminate\Http\Request;

class PoskoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan_bencana = LaporanBencana::where('status', 'terkonfirmasi')->get();  
        return view('bpbd.pages.posko.main',[
            'judul' => 'Laporan Bencana',
            'laporan_bencana' => $laporan_bencana
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bpbd.pages.posko.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_laporan_bencana' => 'required',
            'nama_posko' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        // dd($request->all());

        Posko::create($request->all());
        return redirect()->route('posko.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('bpbd.pages.posko.tambah', [
            'judul' => 'Posko',
            'id_laporan_bencana' => $id,
            'posko' => Posko::where('id_laporan_bencana', $id)->get(),
        ]);
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
        $posko = Posko::find($id);
        $posko->delete();
        return redirect()->route('posko.index');
    }

    public function apiPoskoByLaporanBencana($id)
    {
        $posko = Posko::where('id_laporan_bencana', $id)->get();
        return response()->json($posko);
    }

    public function apiPosko($id)
    {
        $posko = Posko::where('id_laporan_bencana', $id)->get();
        return response()->json($posko);
    }
}
