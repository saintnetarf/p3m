<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\ResearchProduct;
use App\Models\Announcement;
use App\Models\Header;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Get header settings
        $header = Header::where('is_active', true)->first();

        // Get latest published news
        $latest_news = News::published()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(6)
            ->get();

        // Get latest research products
        $latest_research = ResearchProduct::latest()
            ->take(6)
            ->get();

        // Get active announcements
 //       $announcements = Announcement::active()
        $announcements = Announcement::latest()
            // ->important()
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.home', compact('header', 'latest_news', 'latest_research', 'announcements'));
    }
}
