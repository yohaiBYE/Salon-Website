<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['service', 'staff'])
        ->where('customer_id', auth()->id())
        ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $service = Service::findOrFail($request->service_id);
        $start = Carbon::parse($request->start_time);
        $end = $start->copy()->addMinutes($service->duration);

        // Time validation: business hours and lunch
        if (
            $start->hour < 8 || $end->hour >= 18 ||
            ($start->hour == 12 || ($start->hour == 11 && $end->hour >= 12))
        ) {
            return back()->withErrors(['time' => 'Please book within 8AM to 12PM or 1PM to 6PM.']);
        }

        // Check overlapping for all staff (staff will be assigned by admin)
        $conflict = Appointment::where(function ($q) use ($start, $end) {
            $q->whereBetween('start_time', [$start, $end])
              ->orWhereBetween('end_time', [$start, $end]);
        })->exists();

        if ($conflict) {
            return back()->withErrors(['time' => 'That time slot is already taken.']);
        }

        Appointment::create([
            'customer_id' => Auth::id(),
            'service_id' => $request->service_id,
            'start_time' => $start,
            'end_time' => $end,
            'notes' => $request->notes,
            'status' => 'Pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked!');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        if ($appointment->customer_id !== Auth::id()) {
            abort(403);
        }

        $services = Service::all();
        return view('appointments.edit', compact('appointment', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->customer_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $service = Service::findOrFail($request->service_id);
        $start = Carbon::parse($request->start_time);
        $end = $start->copy()->addMinutes($service->duration);

        $appointment->update([
            'service_id' => $request->service_id,
            'start_time' => $start,
            'end_time' => $end,
            'notes' => $request->notes,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated.');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->customer_id !== Auth::id()) {
            abort(403);
        }

        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled.');
    }

    public function calendar()
    {
        $events = Appointment::with('service', 'customer')->get()->map(function ($appt) {
            return [
                'id' => $appt->id,
                'title' => $appt->service->name . ' - ' . $appt->customer->name,
                'start' => $appt->start_time,
                'end' => $appt->end_time,
            ];
        });

        return view('admin.calendar', ['events' => $events]);
    }
}
