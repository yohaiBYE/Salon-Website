<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Jane Cruz', 'email' => 'jane@example.com'],
            ['name' => 'Carlos Reyes', 'email' => 'carlos@example.com'],
            ['name' => 'Mia Santos', 'email' => 'mia@example.com'],
        ];

        foreach ($customers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => bcrypt('password'),
                ]
            );

            $user->assignRole('Customer');
        }
    }
}
