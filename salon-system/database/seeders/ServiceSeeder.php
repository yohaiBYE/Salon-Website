<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create(['name' => 'Massage', 'category' => 'Basic', 'duration' => 30, 'price' => 350]);
        Service::create(['name' => 'Haircut', 'category' => 'Basic', 'duration' => 40, 'price' => 500]);

        Service::create(['name' => 'Permanent Wave', 'category' => 'Treatment', 'duration' => 120, 'price' => 1300]);
        Service::create(['name' => 'Root Perm', 'category' => 'Treatment', 'duration' => 60, 'price' => 800]);
        Service::create(['name' => 'Hair Relax', 'category' => 'Treatment', 'duration' => 120, 'price' => 2000]);
        Service::create(['name' => 'Hair Rebond', 'category' => 'Treatment', 'duration' => 120, 'price' => 4000]);
        Service::create(['name' => 'Hair Spa', 'category' => 'Treatment', 'duration' => 40, 'price' => 700]);

        Service::create(['name' => 'Full Permanent', 'category' => 'Color Vibrancy', 'duration' => 120, 'price' => 1800]);
        Service::create(['name' => 'Root Retouch', 'category' => 'Color Vibrancy', 'duration' => 120, 'price' => 1400]);
        Service::create(['name' => 'Highlights', 'category' => 'Color Vibrancy', 'duration' => 120, 'price' => 1800]);
        Service::create(['name' => 'Highlights w/ bleach', 'category' => 'Color Vibrancy', 'duration' => 120, 'price' => 2300]);
    }
}
