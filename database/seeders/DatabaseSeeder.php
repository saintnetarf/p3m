<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            NewsCategorySeeder::class,
            DownloadCategorySeeder::class,
            HeaderSeeder::class,
        ]);

        echo "\n\033[32m✓ Database seeded successfully!\033[0m\n\n";
    }
}
