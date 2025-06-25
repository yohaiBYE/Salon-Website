@extends('layouts.app')

@section('content')
    <h2>Book Appointment</h2>

    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf

        <label>Service</label>
        <select name="service_id" required>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }} - ₱{{ $service->price }}</option>
            @endforeach
        </select>

        <label>Date & Time</label>
        <input type="text" name="start_time" id="start_time" required>

        <label>Notes</label>
        <textarea name="notes"></textarea>

        <button type="submit">Book Now</button>
    </form>
@endsection

@push('scripts')
<script>
    $('#start_time').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD HH:mm'
        },
        minDate: moment()
    });
</script>
@endpush
