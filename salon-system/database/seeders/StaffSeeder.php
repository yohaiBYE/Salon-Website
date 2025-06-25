<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Permission\Models\Role;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = [
            ['name' => 'Juan Manalo', 'email' => 'juan-manalo@salon.com'],
            ['name' => 'Sofia Reyes', 'email' => 'sofia-reyes@salon.com'],
            ['name' => 'Althea Dela Cruz', 'email' => 'althea-dela-cruz@salon.com'],
            ['name' => 'Samantha Mendoza', 'email' => 'samantha-mendoza@salon.com'],
            ['name' => 'Anne Santos', 'email' => 'anne-santos@salon.com'],
            ['name' => 'Julia Ramos', 'email' => 'julia-ramos@salon.com'],
        ];

        foreach ($staff as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('password'),
            ]);

            $user->assignRole('Staff');
        }
    }
}
