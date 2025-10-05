<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

public function run(): void
{
    $this->call([
        EmployeeSeeder::class,
    ]);

    // ✅ Optional: Add a test admin manually
    User::firstOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Test Admin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]
    );
}

}
