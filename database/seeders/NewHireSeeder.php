<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewHire;
use Carbon\Carbon;

class NewHireSeeder extends Seeder
{
    public function run()
    {

        
        $departments = [
            'Front Office',
            'Food & Beverages',
            'Housekeeping',
            'Human Resources',
            'Finance',
            'IT',
            'Engineering',
            'Sales & Marketing',
        ];

        $positions = [
            'Receptionist',
            'Waiter',
            'Chef',
            'Admin',
            'Manager',
            'Housekeeper',
            'HR Assistant',
            'Accountant',
            'IT Support',
            'Maintenance Staff',
            'Sales Executive',
            'Marketing Coordinator',
        ];

        // Generate 30 random hires
        for ($i = 1; $i <= 30; $i++) {
for ($i = 1; $i <= 30; $i++) {
    NewHire::create([
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'department' => fake()->randomElement($departments),
        'position' => fake()->randomElement($positions),
        'date_submitted' => Carbon::today()->subDays(rand(0, 30)),
        'status' => fake()->randomElement(['pending']),
    ]);
}

        }
    }
}
