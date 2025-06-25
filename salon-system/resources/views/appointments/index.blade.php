@extends('layouts.app')

@section('content')
    <h2>My Appointments</h2>

    @if($appointments->count())
        @foreach($appointments as $appt)
            <div>
                <strong>{{ $appt->service->name }}</strong> at {{ $appt->start_time }}
                <form action="{{ route('appointments.destroy', $appt->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Cancel</button>
                </form>
            </div>
        @endforeach
    @else
        <p>You have no appointments.</p>
    @endif
@endsection

@push('scripts')
<script>
    $('.delete-form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cancel this appointment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
@endpush
