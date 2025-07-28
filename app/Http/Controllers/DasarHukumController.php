<?php

namespace App\Http\Controllers;

use App\Models\DasarHukum;
use Illuminate\Http\Request;

class DasarHukumController extends Controller
{
    public function index()
    {
        $items = DasarHukum::all();
        return view('admin.dasarhukum.index', compact('items'));
    }

    public function create()
    {
        return view('admin.dasarhukum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $request->file('file')->store('dasarhukum', 'public');

        DasarHukum::create([
            'title' => $request->title,
            'file' => $path,
        ]);

        return redirect()->route('dasarhukum.index')->with('success', 'Dasar hukum berhasil ditambahkan.');
    }

    public function edit(DasarHukum $dasarhukum)
    {
        return view('admin.dasarhukum.edit', compact('dasarhukum'));
    }

    public function update(Request $request, DasarHukum $dasarhukum)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = ['title' => $request->title];

        if ($request->hasFile('file')) {
            if (\Storage::disk('public')->exists($dasarhukum->file)) {
                \Storage::disk('public')->delete($dasarhukum->file);
            }

            $data['file'] = $request->file('file')->store('dasarhukum', 'public');
        }

        $dasarhukum->update($data);

        return redirect()->route('dasarhukum.index')->with('success', 'Dasar hukum berhasil diperbarui.');
    }

    public function destroy(DasarHukum $dasarhukum)
    {
        if (\Storage::disk('public')->exists($dasarhukum->file)) {
            \Storage::disk('public')->delete($dasarhukum->file);
        }

        $dasarhukum->delete();

        return redirect()->back()->with('success', 'Dasar hukum berhasil dihapus.');
    }
}
