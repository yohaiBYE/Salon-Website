<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::where('email', 'jane@example.com')->first();
        $staff = User::where('email', 'juan-manalo@salon.com')->first();
        $service = Service::where('name', 'Haircut')->first();

        if ($customer && $staff && $service) {
            $start = Carbon::tomorrow()->setTime(10, 0);
            $end = $start->copy()->addMinutes($service->duration);

            Appointment::create([
                'customer_id' => $customer->id,
                'staff_id' => $staff->id,
                'service_id' => $service->id,
                'start_time' => $start,
                'end_time' => $end,
                'status' => 'Pending',
                'notes' => 'Seeded test appointment',
            ]);
        }
    }
}
