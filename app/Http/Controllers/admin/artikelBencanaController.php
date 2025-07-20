<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\ArtikelBencana;
use App\Http\Controllers\Controller;

class artikelBencanaController extends Controller
{
    public function index()
    {
        return view('admin.pages.artikel-bencana', [
            'judul' => 'Artikel Bencana',
            'artikel_bencana' => ArtikelBencana::all()
        ]);
    }

    public function create()
    {
        return view('admin.pages.create-artikel-bencana', [
            'judul' => 'Artikel Bencana'
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'judul_artikel' => 'required',
            'tanggal' => 'required',
            'isi_artikel' => 'required',
            'foto_artikel' => 'required|mimes:jpg,png,jpeg|max:2048',
        ], [
            'judul_artikel.required' => 'Judul artikel wajib diisi.',
            'tanggal.required' => 'Tanggal artikel wajib diisi.',
            'isi_artikel.required' => 'Isi artikel wajib diisi.',
            'foto_artikel.required' => 'Foto artikel wajib diisi.',
            'foto_artikel.mimes' => 'File harus berupa gambar (jpg, png, jpeg).',
            'foto_artikel.max' => 'File tidak boleh lebih dari 2 MB.',
        ]);

        if ($request->hasFile('foto_artikel')) {
            $imageArtikel = $request->file('foto_artikel');
            $originalNameArtikel = $imageArtikel->getClientOriginalName();
            $imageArtikel->move(public_path('uploads/foto-artikel'), $originalNameArtikel);
            $validatedData['foto_artikel'] = $originalNameArtikel;
        }

        ArtikelBencana::create($validatedData);

        return redirect()->route('admin.artikel-bencana')->with('success', 'Artikel bencana berhasil disimpan.');
    }

    public function edit($id)
    {
        $artikelBencana = ArtikelBencana::find($id);
        return view('admin.pages.update-artikel-bencana', [
            'artikel_bencana' => $artikelBencana,
            'judul' => 'Edit Artikel Bencana'
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $artikelBencana = ArtikelBencana::find($id);
        $validatedData = $request->validate([
            'judul_artikel' => 'required',
            'tanggal' => 'required',
            'isi_artikel' => 'required',
            'foto_artikel' => 'mimes:jpg,png,jpeg|max:2048',
        ], [
            'judul_artikel.required' => 'Judul artikel wajib diisi.',
            'tanggal.required' => 'Tanggal artikel wajib diisi.',
            'isi_artikel.required' => 'Isi artikel wajib diisi.',
            'foto_artikel.mimes' => 'File harus berupa gambar (jpg, png, jpeg).',
            'foto_artikel.max' => 'File tidak boleh lebih dari 2 MB.',
        ]);

        if ($request->hasFile('foto_artikel')) {
            $imageArtikel = $request->file('foto_artikel');
            $originalNameArtikel = $imageArtikel->getClientOriginalName();
            $imageArtikel->move(public_path('uploads/foto-artikel'), $originalNameArtikel);
            $validatedData['foto_artikel'] = $originalNameArtikel;
        }

        $artikelBencana->update($validatedData);

        return redirect()->route('admin.artikel-bencana')->with('success', 'Artikel bencana berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $artikelBencana = ArtikelBencana::find($id);
        $artikelBencana->delete();
        return redirect()->route('admin.artikel-bencana')->with('success', 'Artikel bencana berhasil dihapus.');
    }
}
