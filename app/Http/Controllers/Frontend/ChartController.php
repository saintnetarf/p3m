<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ResearchStatistic;
use App\Models\ServiceStatistic;
use App\Models\PublicationStatistic;
use App\Models\ProsedingStatistic;
use App\Models\BookStatistic;
use App\Models\HakCiptaStatistic;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display the charts page.
     */
    public function index()
    {
        return view('frontend.charts.index');
    }

    /**
     * Get research statistics data for Chart.js (Line Chart by Category).
     */
    public function researchData()
    {
        $data = ResearchStatistic::orderBy('year')
            ->orderBy('category')
            ->get();

        // Get all unique years
        $years = $data->pluck('year')->unique()->sort()->values()->toArray();

        // Get all unique categories
        $categories = $data->pluck('category')->unique()->values()->toArray();

        // Prepare datasets for each category
        $datasets = [];
        $colors = [
            'rgba(255, 99, 132, 1)',   // Red
            'rgba(54, 162, 235, 1)',   // Blue
            'rgba(46, 204, 113, 1)',   // Green
            'rgba(255, 206, 86, 1)',   // Yellow
            'rgba(75, 192, 192, 1)',   // Teal
            'rgba(153, 102, 255, 1)',  // Purple
            'rgba(255, 159, 64, 1)',   // Orange

            'rgba(52, 152, 219, 1)',   // Light Blue
        ];

        foreach ($categories as $index => $category) {
            $categoryData = [];

            foreach ($years as $year) {
                $count = $data->where('year', $year)
                             ->where('category', $category)
                             ->sum('count');
                $categoryData[] = $count;
            }

            $color = $colors[$index % count($colors)];

            $datasets[] = [
                'label' => $category,
                'data' => $categoryData,
                'borderColor' => $color,
                'backgroundColor' => str_replace('1)', '0.1)', $color),
                'tension' => 0.4,
                'fill' => false,
                'borderWidth' => 2,
                'pointRadius' => 4,
                'pointHoverRadius' => 6,
            ];
        }

        return response()->json([
            'labels' => $years,
            'datasets' => $datasets,
        ]);
    }

    /**
     * Get service statistics data for Chart.js (Line Chart by Prodi).
     */
    public function serviceData()
    {
        $data = ServiceStatistic::orderBy('year')
            ->orderBy('category')
            ->get();

        // Get all unique years
        $years = $data->pluck('year')->unique()->sort()->values()->toArray();

        // Get all unique categories
        $categories = $data->pluck('category')->unique()->values()->toArray();

        // Prepare datasets for each prodi
        $datasets = [];
        $colors = [
            'rgba(46, 204, 113, 1)',   // Green
            'rgba(52, 152, 219, 1)',   // Blue
            'rgba(155, 89, 182, 1)',   // Purple
            'rgba(241, 196, 15, 1)',   // Yellow
            'rgba(231, 76, 60, 1)',    // Red
            'rgba(26, 188, 156, 1)',   // Turquoise
            'rgba(230, 126, 34, 1)',   // Orange
            'rgba(149, 165, 166, 1)',  // Gray
        ];

        foreach ($categories as $index => $category) {
            $categoryData = [];

            foreach ($years as $year) {
                $count = $data->where('year', $year)
                             ->where('category', $category)
                             ->sum('count');
                $categoryData[] = $count;
            }

            $color = $colors[$index % count($colors)];

            $datasets[] = [
                'label' => $category,
                'data' => $categoryData,
                'borderColor' => $color,
                'backgroundColor' => str_replace('1)', '0.1)', $color),
                'tension' => 0.4,
                'fill' => false,
                'borderWidth' => 2,
                'pointRadius' => 4,
                'pointHoverRadius' => 6,
            ];
        }

        return response()->json([
            'labels' => $years,
            'datasets' => $datasets,
        ]);
    }

    /**
     * Get publication statistics data for Chart.js (Line Chart by Category).
     */
    public function publicationData()
    {
        $data = PublicationStatistic::orderBy('year')
            ->orderBy('category')
            ->get();

        // Get all unique years
        $years = $data->pluck('year')->unique()->sort()->values()->toArray();

        // Get all unique categories
        $categories = $data->pluck('category')->unique()->values()->toArray();

        // Prepare datasets for each category
        $datasets = [];
        $colors = [
            'rgba(231, 76, 60, 1)',    // Red
            'rgba(52, 152, 219, 1)',   // Blue
            'rgba(241, 196, 15, 1)',   // Yellow
            'rgba(155, 89, 182, 1)',   // Purple
            'rgba(26, 188, 156, 1)',   // Turquoise
            'rgba(230, 126, 34, 1)',   // Orange
            'rgba(46, 204, 113, 1)',   // Green
            'rgba(236, 240, 241, 1)',  // Silver
        ];

        foreach ($categories as $index => $category) {
            $categoryData = [];

            foreach ($years as $year) {
                $count = $data->where('year', $year)
                             ->where('category', $category)
                             ->sum('count');
                $categoryData[] = $count;
            }

            $color = $colors[$index % count($colors)];

            $datasets[] = [
                'label' => $category,
                'data' => $categoryData,
                'borderColor' => $color,
                'backgroundColor' => str_replace('1)', '0.1)', $color),
                'tension' => 0.4,
                'fill' => false,
                'borderWidth' => 2,
                'pointRadius' => 4,
                'pointHoverRadius' => 6,
            ];
        }

        return response()->json([
            'labels' => $years,
            'datasets' => $datasets,
        ]);
    }

    /**
     * Get proseding statistics data for Chart.js (Line Chart by Category).
     */
    public function prosedingData()
    {
        $data = ProsedingStatistic::orderBy('year')
            ->orderBy('category')
            ->get();

        // Get all unique years
        $years = $data->pluck('year')->unique()->sort()->values()->toArray();

        // Get all unique categories
        $categories = $data->pluck('category')->unique()->values()->toArray();

        // Prepare datasets for each category
        $datasets = [];
        $colors = [
            'rgb(11, 29, 234)',    // Amber
            'rgba(156, 39, 176, 1)',   // Purple
            'rgba(96, 125, 139, 1)',   // Blue Grey
            'rgba(0, 150, 136, 1)',    // Teal
            'rgba(46, 204, 113, 1)',   // Green
  //          'rgba(255, 87, 34, 1)',    // Deep Orange
            'rgba(96, 125, 139, 1)',   // Blue Grey

            'rgba(101, 11, 5, 1)',    // Red
            'rgba(63, 81, 181, 1)',    // Indigo
        ];

        foreach ($categories as $index => $category) {
            $categoryData = [];

            foreach ($years as $year) {
                $count = $data->where('year', $year)
                             ->where('category', $category)
                             ->sum('count');
                $categoryData[] = $count;
            }

            $color = $colors[$index % count($colors)];

            $datasets[] = [
                'label' => $category,
                'data' => $categoryData,
                'borderColor' => $color,
                'backgroundColor' => str_replace('1)', '0.1)', $color),
                'tension' => 0.4,
                'fill' => false,
                'borderWidth' => 2,
                'pointRadius' => 4,
                'pointHoverRadius' => 6,
            ];
        }

        return response()->json([
            'labels' => $years,
            'datasets' => $datasets,
        ]);
    }

    /**
     * Get book statistics data for Chart.js (Line Chart by Category).
     */
    public function bookData()
    {
        $data = BookStatistic::orderBy('year')
            ->orderBy('category')
            ->get();

        // Get all unique years
        $years = $data->pluck('year')->unique()->sort()->values()->toArray();

        // Get all unique categories
        $categories = $data->pluck('category')->unique()->values()->toArray();

        // Prepare datasets for each category
        $datasets = [];
        $colors = [
            'rgb(195, 231, 11)',  // Gray
            'rgba(111, 66, 193, 1)',   // Violet
            'rgba(13, 110, 253, 1)',   // Blue
            'rgba(220, 53, 69, 1)',    // Red
            'rgba(25, 135, 84, 1)',    // Green
            'rgba(255, 193, 7, 1)',    // Yellow
            'rgba(13, 202, 240, 1)',   // Cyan
            'rgba(214, 51, 132, 1)',   // Pink
        ];

        foreach ($categories as $index => $category) {
            $categoryData = [];

            foreach ($years as $year) {
                $count = $data->where('year', $year)
                             ->where('category', $category)
                             ->sum('count');
                $categoryData[] = $count;
            }

            $color = $colors[$index % count($colors)];

            $datasets[] = [
                'label' => $category,
                'data' => $categoryData,
                'borderColor' => $color,
                'backgroundColor' => str_replace('1)', '0.1)', $color),
                'tension' => 0.4,
                'fill' => false,
                'borderWidth' => 2,
                'pointRadius' => 4,
                'pointHoverRadius' => 6,
            ];
        }

        return response()->json([
            'labels' => $years,
            'datasets' => $datasets,
        ]);
    }

    /**
     * Get hak cipta statistics data for Chart.js (Line Chart by Category).
     */
    public function hakCiptaData()
    {
        $data = HakCiptaStatistic::orderBy('year')
            ->orderBy('category')
            ->get();

        // Get all unique years
        $years = $data->pluck('year')->unique()->sort()->values()->toArray();

        // Get all unique categories
        $categories = $data->pluck('category')->unique()->values()->toArray();

        $datasets = [];

        // Define colors - Red theme for hak cipta
        $colors = [
            'rgba(255, 99, 132, 1)',   // Red
            'rgba(54, 162, 235, 1)',   // Blue
            'rgba(255, 206, 86, 1)',   // Yellow
            'rgba(75, 192, 192, 1)',   // Teal
            'rgba(153, 102, 255, 1)',  // Purple
            'rgba(255, 159, 64, 1)',   // Orange
            'rgba(46, 204, 113, 1)',   // Green
            'rgba(52, 152, 219, 1)',   // Light Blue
        ];

        foreach ($categories as $index => $category) {
            $categoryData = [];

            foreach ($years as $year) {
                $count = $data->where('year', $year)
                             ->where('category', $category)
                             ->sum('count');
                $categoryData[] = $count;
            }

            $color = $colors[$index % count($colors)];

            $datasets[] = [
                'label' => $category,
                'data' => $categoryData,
                'borderColor' => $color,
                'backgroundColor' => str_replace('1)', '0.1)', $color),
                'tension' => 0.4,
                'fill' => false,
                'borderWidth' => 2,
                'pointRadius' => 4,
                'pointHoverRadius' => 6,
            ];
        }

        return response()->json([
            'labels' => $years,
            'datasets' => $datasets,
        ]);
    }
}
