<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsCategory;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Penelitian', 'description' => 'Berita tentang kegiatan penelitian'],
            ['name' => 'Pengabdian Masyarakat', 'description' => 'Berita tentang kegiatan pengabdian kepada masyarakat'],
            ['name' => 'Prestasi', 'description' => 'Berita tentang prestasi penelitian dan pengabdian'],
            ['name' => 'Kegiatan', 'description' => 'Berita tentang kegiatan umum PPM'],
            ['name' => 'Pengumuman', 'description' => 'Pengumuman resmi dari PPM'],
        ];

        foreach ($categories as $category) {
            NewsCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }

        echo "✓ News categories created successfully\n";
    }
}
