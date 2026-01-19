<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'adminp3m@poliban.ac.id',
            'password' => Hash::make('passwordP3m'),
            'role' => 'admin',
        ]);

        // Create Operator User
        User::create([
            'name' => 'Operator PPM',
            'email' => 'operatorp3m@poliban.ac.id',
            'password' => Hash::make('passwordOperatorP3m'),
            'role' => 'operator',
        ]);

        echo "\n✓ Admin and Operator users created successfully\n";
        echo "  Admin: aadminp3m@poliban.ac.id / passwordP3m\n";
        echo "  Operator: operatorp3m@poliban.ac.id / passwordOperatorP3m\n\n";
    }
}
