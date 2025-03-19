<x-app-layout>
    <div class="container mt-5">
        <div class="card shadow p-4">
            @if ($place->image)
                <img src="{{ asset('storage/' . $place->image) }}" class="img-fluid rounded mb-4" alt="Place Image" style="max-height: 300px; object-fit: cover; width: 100%;">
            @endif

            <h1 class="fw-bold text-primary">{{ $place->name }}</h1>
            <p class="text-muted">{{ $place->description }}</p>
            <p><strong>Address:</strong> {{ $place->address }}</p>
            <p><strong>City:</strong> {{ $place->city }}</p>
            <p><strong>Phone:</strong> {{ $place->phone }}</p>
            <p><strong>Type:</strong> <span class="badge bg-dark">{{ ucfirst($place->category) }}</span></p>

            <div class="text-center mt-4">
                <button class="btn btn-lg btn-dark w-100 shadow" data-bs-toggle="modal" data-bs-target="#reservationModal">
                    <i class="bi bi-calendar-check"></i> Make a Reservation
                </button>
            </div>
        </div>

        <h3 class="mt-4 fw-bold">Upcoming Events</h3>

        @if($upcomingEvents->isEmpty())
            <p class="text-muted">No upcoming events.</p>
        @else
            <div class="row">
                @foreach($upcomingEvents as $event)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            @if($event->event_image)
                                <img src="{{ asset('storage/' . $event->event_image) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Event Image">
                            @endif
                            <div class="card-body">
                                <h5 class="fw-bold text-primary">
                                    <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-dark">
                                        {{ $event->title }}
                                    </a>
                                </h5>
                                <p class="text-muted small">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d H:i') }}
                                </p>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-dark w-100">View Event</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="reservationModalLabel">Make a Reservation</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @auth
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="place_id" value="{{ $place->id }}">
                            <input type="hidden" name="customer_name" value="{{ auth()->user()->name }}">
                            <input type="hidden" name="event_id" value="">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Your Phone</label>
                                <input type="text" name="customer_phone" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Reservation Date & Time</label>
                                <input type="datetime-local" name="reservation_date" class="form-control" required>
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
                    @else
                        <p class="text-center fw-semibold">You need to <a href="{{ route('login') }}" class="text-primary">log in</a> to make a reservation.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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
