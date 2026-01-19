<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\DownloadCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Display a listing of downloads.
     */
    public function index(Request $request)
    {
        $query = Download::with(['category', 'author']);

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->where('download_category_id', $request->category);
        }

        // Search by title
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $downloads = $query->orderBy('created_at', 'desc')->paginate(12);

        $categories = DownloadCategory::withCount('downloads')
            ->orderBy('name')
            ->get();

        return view('frontend.downloads.index', compact('downloads', 'categories'));
    }

    /**
     * Download the specified file.
     */
    public function download(Download $download)
    {
        // Check if file exists
        if (!Storage::disk('public')->exists($download->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        // Increment download count
        $download->incrementDownloadCount();

        // Return file download
        return Storage::disk('public')->download(
            $download->file_path,
            $download->file_name
        );
    }
}
