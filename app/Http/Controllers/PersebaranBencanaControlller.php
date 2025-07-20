<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\LaporanBencana;
use App\Models\Posko;
use Illuminate\Http\Request;

class PersebaranBencanaControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = LaporanBencana::all();
        $donasi = Donasi::all();
        $posko = Posko::all();
        return view('all.pages.persebaran-bencana.main',[
            'jumlah_laporan' => count($laporan)
            , 'jumlah_donasi' => count($donasi),
            'jumlah_posko' => count($posko),
            'laporan' => $laporan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
