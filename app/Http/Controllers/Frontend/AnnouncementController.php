<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements.
     */
    public function index(Request $request)
    {
        $query = Announcement::with('author')
            ->whereDate('start_date', '<=', now());
         //   ->whereDate('end_date', '>=', now());

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $announcements = $query->orderBy('is_important', 'desc')
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        $importantAnnouncements = Announcement::with('author')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->where('is_important', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('frontend.announcements.index', compact('announcements', 'importantAnnouncements'));
    }

    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        $announcement->load('author');

        // Get related announcements
        $relatedAnnouncements = Announcement::where('id', '!=', $announcement->id)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->orderBy('start_date', 'desc')
            ->limit(5)
            ->get();

        return view('frontend.announcements.show', compact('announcement', 'relatedAnnouncements'));
    }
}
