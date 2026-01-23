<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengukuranTkt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengukuranTktController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengukuran_tkt = PengukuranTkt::with('author')->latest()->paginate(15);
        return view('admin.pengukuran-tkt.index', compact('pengukuran_tkt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengukuran-tkt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'kategori' => 'nullable|string|max:255',
                'level_tkt' => 'nullable|integer|min:1|max:9',
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
            ], [
                'file.required' => 'File harus diupload.',
                'file.file' => 'File tidak valid.',
                'file.mimes' => 'Format file harus: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, atau RAR.',
                'file.max' => 'Ukuran file maksimal 20MB.',
                'level_tkt.min' => 'Level TKT minimal 1.',
                'level_tkt.max' => 'Level TKT maksimal 9.',
            ]);

            $validated['slug'] = Str::slug($validated['title']);
            $validated['author_id'] = auth()->id();

            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');

                $validated['file'] = $file->store('pengukuran-tkt', 'public');
                $validated['file_name'] = $file->getClientOriginalName();
                $validated['file_type'] = $file->getClientOriginalExtension();
                $validated['file_size'] = $file->getSize();
            } else {
                return back()->withInput()->with('error', 'File gagal diupload. Pastikan ukuran file tidak melebihi 20MB.');
            }

            PengukuranTkt::create($validated);

            return redirect()->route('admin.pengukuran-tkt.index')
                ->with('success', 'Data pengukuran TKT berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mengupload file: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengukuranTkt $pengukuranTkt)
    {
        return view('admin.pengukuran-tkt.edit', compact('pengukuranTkt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengukuranTkt $pengukuranTkt)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kategori' => 'nullable|string|max:255',
            'level_tkt' => 'nullable|integer|min:1|max:9',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
        ], [
            'file.mimes' => 'Format file harus: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, atau RAR.',
            'file.max' => 'Ukuran file maksimal 20MB.',
            'level_tkt.min' => 'Level TKT minimal 1.',
            'level_tkt.max' => 'Level TKT maksimal 9.',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($pengukuranTkt->file) {
                Storage::disk('public')->delete($pengukuranTkt->file);
            }

            $file = $request->file('file');
            $validated['file'] = $file->store('pengukuran-tkt', 'public');
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }

        $pengukuranTkt->update($validated);

        return redirect()->route('admin.pengukuran-tkt.index')
            ->with('success', 'Data pengukuran TKT berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengukuranTkt $pengukuranTkt)
    {
        // Delete file
        if ($pengukuranTkt->file) {
            Storage::disk('public')->delete($pengukuranTkt->file);
        }

        $pengukuranTkt->delete();

        return redirect()->route('admin.pengukuran-tkt.index')
            ->with('success', 'Data pengukuran TKT berhasil dihapus.');
    }
}
