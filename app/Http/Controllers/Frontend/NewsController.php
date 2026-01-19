<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of news.
     */
    public function index(Request $request)
    {
        $query = News::published()->with(['category', 'author']);

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->latest('published_at')->paginate(12);
        $categories = NewsCategory::withCount('news')->get();

        return view('frontend.news.index', compact('news', 'categories'));
    }

    /**
     * Display the specified news.
     */
    public function show(News $news)
    {
        // Only show published news
        if ($news->status !== 'published') {
            abort(404);
        }

        // Increment views
        $news->increment('views');

        // Load relationships
        $news->load(['category', 'author']);

        // Get related news
        $related_news = News::published()
            ->where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->take(4)
            ->get();

        return view('frontend.news.show', compact('news', 'related_news'));
    }

    /**
     * Display news by category.
     */
    public function category(NewsCategory $category)
    {
        $news = News::published()
            ->where('news_category_id', $category->id)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(12);

        $categories = NewsCategory::withCount('news')->get();

        return view('frontend.news.category', compact('news', 'category', 'categories'));
    }
}
