<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Staff
        $staff = User::firstOrCreate(
            ['email' => 'juan-manalo@salon.com'],
            ['name' => 'Juan Manalo', 'password' => bcrypt('password')]
        );
        $staff->assignRole('Staff');

        // Create Customer
        $customer = User::firstOrCreate(
            ['email' => 'jane@example.com'],
            ['name' => 'Jane Customer', 'password' => bcrypt('password')]
        );
        $customer->assignRole('Customer');
    }
}
