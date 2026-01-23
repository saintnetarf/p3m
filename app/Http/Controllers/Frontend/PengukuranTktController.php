<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PengukuranTkt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengukuranTktController extends Controller
{
    /**
     * Display a listing of TKT measurements.
     */
    public function index(Request $request)
    {
        $query = PengukuranTkt::with('author');

        // Filter by level TKT
        if ($request->has('level') && $request->level) {
            $query->where('level_tkt', $request->level);
        }

        // Filter by kategori
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Search by title
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $pengukuran_tkt = $query->orderBy('created_at', 'desc')->paginate(12);

        // Get unique categories and levels for filter
        $categories = PengukuranTkt::whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori');

        $levels = PengukuranTkt::whereNotNull('level_tkt')
            ->distinct()
            ->orderBy('level_tkt')
            ->pluck('level_tkt');

        return view('frontend.pengukuran-tkt.index', compact('pengukuran_tkt', 'categories', 'levels'));
    }

    /**
     * Display the specified TKT measurement.
     */
    public function show(PengukuranTkt $pengukuranTkt)
    {
        $pengukuranTkt->load('author');

        // Get related TKT measurements (same level or category)
        $related = PengukuranTkt::where('id', '!=', $pengukuranTkt->id)
            ->where(function($query) use ($pengukuranTkt) {
                $query->where('level_tkt', $pengukuranTkt->level_tkt)
                      ->orWhere('kategori', $pengukuranTkt->kategori);
            })
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.pengukuran-tkt.show', compact('pengukuranTkt', 'related'));
    }

    /**
     * Download the specified file.
     */
    public function download(PengukuranTkt $pengukuranTkt)
    {
        // Check if file exists
        if (!Storage::disk('public')->exists($pengukuranTkt->file)) {
            abort(404, 'File tidak ditemukan');
        }

        // Increment download count
        $pengukuranTkt->incrementDownloadCount();

        // Return file download
        return Storage::disk('public')->download(
            $pengukuranTkt->file,
            $pengukuranTkt->file_name ?? 'pengukuran-tkt.pdf'
        );
    }
}
