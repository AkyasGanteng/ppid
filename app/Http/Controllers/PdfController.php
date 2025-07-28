<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PdfController extends Controller
{
    public function index()
    {
        $pdfs = Pdf::all();
        return view('admin.pdf.index', compact('pdfs'));
    }

    public function create()
    {
        return view('admin.pdf.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:pdf|max:10240',
        ]);

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $path = $request->file('file')->storeAs('pdfs', $fileName, 'public');

        Pdf::create([
            'title' => $request->title,
            'file' => $path,
        ]);

        return redirect()->route('pdfs.index')->with('success', 'PDF berhasil ditambahkan.');
    }

    public function edit(Pdf $pdf)
    {
        return view('admin.pdf.edit', compact('pdf'));
    }

    public function update(Request $request, Pdf $pdf)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $path = $request->file('file')->storeAs('pdfs', $fileName, 'public');
            $pdf->file = $path;
        }

        $pdf->title = $request->title;
        $pdf->save();

        return redirect()->route('pdfs.index')->with('success', 'PDF berhasil diperbarui.');
    }

    public function destroy(Pdf $pdf)
    {
        $pdf->delete();
        return redirect()->route('pdfs.index')->with('success', 'PDF berhasil dihapus.');
    }
}
