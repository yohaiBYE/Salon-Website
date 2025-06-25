@extends('layouts.app')

@section('content')
    <h2>Appointment Calendar</h2>
    <div id="calendar"></div>
@endsection

@push('scripts')
<script type="module">
    import { Calendar } from "https://cdn.skypack.dev/@schedule-x/calendar";
    import { calendarEventLayer } from "https://cdn.skypack.dev/@schedule-x/layer-event";

    const calendar = new Calendar({
        target: document.getElementById('calendar'),
        props: {
            layers: [calendarEventLayer],
            events: @json($events) // this should be passed from your controller
        }
    });
</script>
@endpush
