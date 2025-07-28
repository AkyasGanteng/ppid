<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'kegiatan' => 'required',
            'tanggal' => 'nullable|date',
            'foto' => 'required|image|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'judul' => $validated['judul'],
            'kegiatan' => $validated['kegiatan'],
            'tanggal' => $validated['tanggal'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'kegiatan' => 'required',
            'tanggal' => 'nullable|date',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('galeri', 'public');
            $galeri->foto = $fotoPath;
        }

        $galeri->update([
            'judul' => $validated['judul'],
            'kegiatan' => $validated['kegiatan'],
            'tanggal' => $validated['tanggal'],
            'foto' => $galeri->foto,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
    
    public function show(Galeri $galeri)
{
    return view('galeri.show', compact('galeri'));
}


}
