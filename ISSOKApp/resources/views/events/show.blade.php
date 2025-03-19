<x-app-layout>
    <div class="container mt-5">
        <div class="card shadow p-4">
            @if ($event->event_image)
                <img src="{{ asset('storage/' . $event->event_image) }}" class="img-fluid rounded mb-4" alt="Event Image" style="max-height: 300px; object-fit: cover; width: 100%;">
            @endif

            <h1 class="fw-bold text-primary">{{ $event->title }}</h1>
            <p class="text-muted">{{ $event->description }}</p>
            <p><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d H:i') }}</p>
            <p><strong>Location:</strong> {{ $event->place->name }}</p>
            <p><strong>Address:</strong> {{ $event->place->address }}, {{ $event->place->city }}</p>

            <div class="text-center mt-4">
                @if ($event->current_reservations >= $event->max_reservations)
                    <p class="text-center fw-bold text-danger">No more reservations available for this event.</p>
                @else
                    @auth
                        <button class="btn btn-lg btn-dark w-100 shadow" data-bs-toggle="modal" data-bs-target="#reservationModal">
                            <i class="bi bi-calendar-check"></i> Make a Reservation
                        </button>
                    @else
                        <p class="text-center fw-semibold">You need to <a href="{{ route('login') }}" class="text-primary">log in</a> to make a reservation.</p>
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <!-- Reservation Modal -->
    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="reservationModalLabel">Make a Reservation</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="place_id" value="{{ $event->place->id }}">
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="customer_name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="reservation_date" value="{{ $event->event_date }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Phone</label>
                            <input type="text" name="customer_phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Number of People</label>
                            <input type="number" name="number_of_people" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Confirm Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Bootstrap Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
    .card {
        border-radius: 10px;
    }
    .btn {
        border-radius: 5px;
    }
    .btn-lg {
        font-size: 1.2rem;
        padding: 12px;
    }
    .modal-header {
        border-bottom: none;
    }
</style>
