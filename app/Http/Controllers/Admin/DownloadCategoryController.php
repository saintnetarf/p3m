<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DownloadCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DownloadCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DownloadCategory::withCount('downloads')->latest()->paginate(15);
        return view('admin.download-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.download-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:download_categories',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        DownloadCategory::create($validated);

        return redirect()->route('admin.download-categories.index')
            ->with('success', 'Kategori download berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DownloadCategory $downloadCategory)
    {
        return view('admin.download-categories.edit', compact('downloadCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DownloadCategory $downloadCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:download_categories,name,' . $downloadCategory->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $downloadCategory->update($validated);

        return redirect()->route('admin.download-categories.index')
            ->with('success', 'Kategori download berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DownloadCategory $downloadCategory)
    {
        // Check if category has downloads
        if ($downloadCategory->downloads()->count() > 0) {
            return redirect()->route('admin.download-categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki file download.');
        }

        $downloadCategory->delete();

        return redirect()->route('admin.download-categories.index')
            ->with('success', 'Kategori download berhasil dihapus.');
    }
}
