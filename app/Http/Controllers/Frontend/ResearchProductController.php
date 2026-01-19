<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ResearchProduct;
use Illuminate\Http\Request;

class ResearchProductController extends Controller
{
    public function index(Request $request)
    {
        $query = ResearchProduct::with('author');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('researcher', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(12);

        return view('frontend.research-products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = ResearchProduct::with('author')->where('slug', $slug)->firstOrFail();

        return view('frontend.research-products.show', compact('product'));
    }
}
