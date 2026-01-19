<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResearchProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ResearchProduct::with('author')->latest()->paginate(15);
        return view('admin.research-products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.research-products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'researcher' => 'required|string|max:255',
            'category' => 'required|in:Penelitian,Pengabdian Masyarakat,Publikasi',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = auth()->id();
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('research-products/images', 'public');
        }

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('research-products/files', 'public');
        }

        ResearchProduct::create($validated);

        return redirect()->route('admin.research-products.index')
            ->with('success', 'Produk penelitian berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResearchProduct $researchProduct)
    {
        return view('admin.research-products.edit', compact('researchProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResearchProduct $researchProduct)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'researcher' => 'required|string|max:255',
            'category' => 'required|in:Penelitian,Pengabdian Masyarakat,Publikasi',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($researchProduct->image) {
                Storage::disk('public')->delete($researchProduct->image);
            }
            $validated['image'] = $request->file('image')->store('research-products/images', 'public');
        }

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($researchProduct->file) {
                Storage::disk('public')->delete($researchProduct->file);
            }
            $validated['file'] = $request->file('file')->store('research-products/files', 'public');
        }

        $researchProduct->update($validated);

        return redirect()->route('admin.research-products.index')
            ->with('success', 'Produk penelitian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResearchProduct $researchProduct)
    {
        // Delete image if exists
        if ($researchProduct->image) {
            Storage::disk('public')->delete($researchProduct->image);
        }

        // Delete file if exists
        if ($researchProduct->file) {
            Storage::disk('public')->delete($researchProduct->file);
        }

        $researchProduct->delete();

        return redirect()->route('admin.research-products.index')
            ->with('success', 'Produk penelitian berhasil dihapus.');
    }
}
