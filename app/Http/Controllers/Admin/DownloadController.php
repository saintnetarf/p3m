<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\DownloadCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $downloads = Download::with(['category', 'author'])->latest()->paginate(15);
        return view('admin.downloads.index', compact('downloads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DownloadCategory::all();
        return view('admin.downloads.create', compact('categories'));
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
                'download_category_id' => 'required|exists:download_categories,id',
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
            ], [
                'file.required' => 'File harus diupload.',
                'file.file' => 'File tidak valid.',
                'file.mimes' => 'Format file harus: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, atau RAR.',
                'file.max' => 'Ukuran file maksimal 20MB.',
            ]);

            $validated['slug'] = Str::slug($validated['title']);
            $validated['author_id'] = auth()->id();

            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');

                $validated['file_path'] = $file->store('downloads', 'public');
                $validated['file_name'] = $file->getClientOriginalName();
                $validated['file_size'] = $file->getSize();
            } else {
                return back()->withInput()->with('error', 'File gagal diupload. Pastikan ukuran file tidak melebihi 20MB.');
            }

            Download::create($validated);

            return redirect()->route('admin.downloads.index')
                ->with('success', 'File download berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mengupload file: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Download $download)
    {
        $categories = DownloadCategory::all();
        return view('admin.downloads.edit', compact('download', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Download $download)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'download_category_id' => 'required|exists:download_categories,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($download->file_path) {
                Storage::disk('public')->delete($download->file_path);
            }

            $file = $request->file('file');
            $validated['file_path'] = $file->store('downloads', 'public');
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_size'] = $file->getSize();
        }

        $download->update($validated);

        return redirect()->route('admin.downloads.index')
            ->with('success', 'File download berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Download $download)
    {
        // Delete file
        if ($download->file_path) {
            Storage::disk('public')->delete($download->file_path);
        }

        $download->delete();

        return redirect()->route('admin.downloads.index')
            ->with('success', 'File download berhasil dihapus.');
    }
}
