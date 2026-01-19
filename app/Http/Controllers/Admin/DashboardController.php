<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\ResearchProduct;
use App\Models\Announcement;
use App\Models\Download;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display dashboard with statistics.
     */
    public function index()
    {
        $statistics = [
            'total_news' => News::count(),
            'published_news' => News::published()->count(),
            'total_research' => ResearchProduct::count(),
            'total_announcements' => Announcement::count(),
            'active_announcements' => Announcement::active()->count(),
            'total_downloads' => Download::count(),
            'total_users' => User::count(),
        ];

        $recent_news = News::with(['category', 'author'])
            ->latest()
            ->take(5)
            ->get();

        $recent_research = ResearchProduct::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('statistics', 'recent_news', 'recent_research'));
    }
}
