<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Header;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Header::create([
            'institution_name' => 'Lembaga Penelitian dan Pengabdian kepada Masyarakat',
            'menu_items' => json_encode([
                ['label' => 'Beranda', 'url' => '/', 'active' => true],
                ['label' => 'Berita', 'url' => '/berita', 'active' => true],
                ['label' => 'Produk Penelitian', 'url' => '/produk-penelitian', 'active' => true],
                ['label' => 'Pengumuman', 'url' => '/pengumuman', 'active' => true],
                ['label' => 'Download', 'url' => '/download', 'active' => true],
                ['label' => 'Grafik', 'url' => '/grafik', 'active' => true],
            ]),
            'is_active' => true,
        ]);

        echo "✓ Header configuration created successfully\n";
    }
}
