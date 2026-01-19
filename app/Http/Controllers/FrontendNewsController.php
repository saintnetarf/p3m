<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class FrontendNewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index()
    {
        $news = News::with(['category', 'author'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = NewsCategory::withCount(['news' => function ($query) {
            $query->where('status', 'published');
        }])->get();

        return view('frontend.news.index', compact('news', 'categories'));
    }

    /**
     * Display the specified news.
     */
    public function show(News $news)
    {
        // Check if news is published
        if ($news->status !== 'published') {
            abort(404);
        }

        $news->load(['category', 'author']);

        // Get related news from same category
        $relatedNews = News::where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('frontend.news.show', compact('news', 'relatedNews'));
    }

    /**
     * Display news by category.
     */
    public function category(NewsCategory $category)
    {
        $news = News::with(['category', 'author'])
            ->where('news_category_id', $category->id)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = NewsCategory::withCount(['news' => function ($query) {
            $query->where('status', 'published');
        }])->get();

        return view('frontend.news.category', compact('news', 'categories', 'category'));
    }
}
