<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchStatistic;
use Illuminate\Http\Request;

class ResearchStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = ResearchStatistic::orderBy('year', 'desc')
            ->orderBy('category')
            ->paginate(15);

        // Get available years for filter
        $years = ResearchStatistic::selectRaw('DISTINCT year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.research-statistics.index', compact('statistics', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.research-statistics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 10),
            'category' => 'required|string|max:255',
            'count' => 'required|integer|min:0',
        ]);

        ResearchStatistic::create($validated);

        return redirect()->route('admin.research-statistics.index')
            ->with('success', 'Data penelitian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $statistic = ResearchStatistic::findOrFail($id);
        return view('admin.research-statistics.show', compact('statistic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $statistic = ResearchStatistic::findOrFail($id);
        return view('admin.research-statistics.edit', compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $statistic = ResearchStatistic::findOrFail($id);

        $validated = $request->validate([
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 10),
            'category' => 'required|string|max:255',
            'count' => 'required|integer|min:0',
        ]);

        $statistic->update($validated);

        return redirect()->route('admin.research-statistics.index')
            ->with('success', 'Data penelitian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statistic = ResearchStatistic::findOrFail($id);
        $statistic->delete();

        return redirect()->route('admin.research-statistics.index')
            ->with('success', 'Data penelitian berhasil dihapus.');
    }
}
