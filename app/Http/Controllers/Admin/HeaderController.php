<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headers = Header::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.headers.index', compact('headers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.headers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_items' => 'nullable|string',
        ]);

        $header = new Header();
        $header->institution_name = $validated['institution_name'];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $header->logo = $request->file('logo')->store('logos', 'public');
        }

        // Convert menu_items string to array if provided
        if ($request->filled('menu_items')) {
            $menuItems = json_decode($request->menu_items, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $header->menu_items = $menuItems;
            } else {
                $header->menu_items = [];
            }
        } else {
            $header->menu_items = [];
        }

        // Handle is_active checkbox
        $header->is_active = $request->has('is_active');

        $header->save();

        return redirect()->route('admin.headers.index')
            ->with('success', 'Header berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $header = Header::findOrFail($id);
        return view('admin.headers.show', compact('header'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $header = Header::findOrFail($id);
        return view('admin.headers.edit', compact('header'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $header = Header::findOrFail($id);

        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_items' => 'nullable|string',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($header->logo) {
                Storage::disk('public')->delete($header->logo);
            }
            $header->logo = $request->file('logo')->store('logos', 'public');
        }

        // Update basic fields
        $header->institution_name = $validated['institution_name'];

        // Convert menu_items string to array if provided
        if ($request->filled('menu_items')) {
            $menuItems = json_decode($request->menu_items, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $header->menu_items = $menuItems;
            } else {
                $header->menu_items = [];
            }
        } else {
            $header->menu_items = [];
        }

        // Handle is_active checkbox
        $header->is_active = $request->has('is_active');

        $header->save();

        return redirect()->route('admin.headers.index')
            ->with('success', 'Header berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $header = Header::findOrFail($id);

        // Delete logo file
        if ($header->logo) {
            Storage::disk('public')->delete($header->logo);
        }

        $header->delete();

        return redirect()->route('admin.headers.index')
            ->with('success', 'Header berhasil dihapus.');
    }
}
