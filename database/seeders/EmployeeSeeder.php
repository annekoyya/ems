<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\NewHire;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

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

        $newHires = NewHire::pluck('id')->toArray();

        foreach (range(1, 30) as $i) {
            $department = $faker->randomElement($departments);
            $position = $faker->randomElement($positions);

            $employee = Employee::create([
                'new_hire_id' => $faker->randomElement($newHires) ?? null,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'middle_name' => $faker->optional()->firstName,
                'name_extension' => $faker->optional()->randomElement(['Jr.', 'Sr.', 'II', 'III']),
                'date_of_birth' => $faker->date('Y-m-d', '2002-01-01'),
                'home_address' => $faker->address,
                'emergency_contact_name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'emergency_contact_number' => $faker->phoneNumber,
                'phone_number' => $faker->phoneNumber,
                'relationship' => $faker->randomElement(['Parent', 'Sibling', 'Friend', 'Spouse']),
                'tin' => $faker->numerify('###-###-###'),
                'sss_number' => $faker->numerify('##-#######-#'),
                'pagibig_number' => $faker->numerify('####-####-####'),
                'bank_name' => $faker->randomElement(['BDO', 'BPI', 'Metrobank', 'UnionBank', 'LandBank']),
                'account_name' => $faker->name,
                'account_number' => $faker->numerify('##########'),
                'start_date' => $faker->dateTimeBetween('-3 years', 'now'),
                'department' => $department,
                'job_category' => $position,
                'employment_type' => $faker->randomElement(['Full-time', 'Part-time', 'Contractual']),
                'reporting_manager' => $faker->name,
            ]);

            // 🔐 Automatically create a User account for Admin / HR / Manager
            $shouldBeUser = false;
            $role = null;

            if (strtolower($position) === 'admin') {
                $shouldBeUser = true;
                $role = 'admin';
            } elseif (strtolower($position) === 'manager') {
                $shouldBeUser = true;
                $role = 'manager';
            } elseif (in_array(strtolower($department), ['human resources', 'hr'])) {
                $shouldBeUser = true;
                $role = 'hr';
            }

            if ($shouldBeUser) {
                User::create([
                    'employee_id' => $employee->id,
                    'first_name'  => $employee->first_name,
                    'last_name'   => $employee->last_name,
                    'email'       => $employee->email,
                    'password'    => Hash::make('password123'),
                    'role'        => $role,
                ]);
            }
        }

        // ✅ Add guaranteed test admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'employee_id' => null,
                'first_name'  => 'Test',
                'last_name'   => 'Admin',
                'password'    => Hash::make('password123'),
                'role'        => 'admin',
            ]
        );

        $this->command->info('✅ EmployeeSeeder completed successfully!');
        $this->command->info('🔐 You can log in with:');
        $this->command->info('   Email: admin@example.com');
        $this->command->info('   Password: password123');
    }
}
