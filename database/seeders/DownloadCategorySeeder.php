<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DownloadCategory;
use Illuminate\Support\Str;

class DownloadCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Panduan', 'description' => 'Panduan dan pedoman PPM'],
            ['name' => 'Template Proposal', 'description' => 'Template untuk proposal penelitian dan pengabdian'],
            ['name' => 'Template Laporan', 'description' => 'Template untuk laporan penelitian dan pengabdian'],
            ['name' => 'Formulir', 'description' => 'Formulir-formulir yang diperlukan'],
            ['name' => 'Dokumen Lainnya', 'description' => 'Dokumen pendukung lainnya'],
        ];

        foreach ($categories as $category) {
            DownloadCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }

        echo "✓ Download categories created successfully\n";
    }
}
