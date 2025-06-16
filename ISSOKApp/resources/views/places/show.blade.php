<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-sm border-0 p-4 mb-4">
            @if ($place->image)
                <img src="{{ asset('storage/' . $place->image) }}" class="img-fluid rounded mb-4" alt="Place Image" style="max-height: 300px; object-fit: cover; width: 100%;">
            @endif

            <h1 class="fw-bold text-primary mb-3">{{ $place->name }}</h1>
            <p class="text-muted">{{ $place->description }}</p>
            <p><strong>Address:</strong> {{ $place->address }}</p>
            <p><strong>City:</strong> {{ $place->city }}</p>
            <p><strong>Phone:</strong> {{ $place->phone }}</p>
            <p><strong>Type:</strong> <span class="badge bg-secondary">{{ ucfirst($place->category) }}</span></p>

            <div class="text-center mt-4">
                <button class="btn btn-lg btn-primary w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#reservationModal">
                    <i class="bi bi-calendar-check"></i> Make a Reservation
                </button>
            </div>
        </div>

        <h3 class="mt-5 fw-bold text-primary">Upcoming Events</h3>

        @if($upcomingEvents->isEmpty())
            <div class="text-center text-muted py-4">
                <i class="bi bi-exclamation-circle fs-1"></i>
                <p class="mt-2">No upcoming events. Check back later!</p>
            </div>
        @else
            <div class="row g-4 mt-3">
                @foreach($upcomingEvents as $event)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 rounded-3 h-100 hover-zoom">
                            @if($event->event_image)
                                <img src="{{ asset('storage/' . $event->event_image) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Event Image">
                            @endif
                            <div class="card-body">
                                <h5 class="fw-bold text-primary">
                                    <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-dark hover-primary">
                                        {{ $event->title }}
                                    </a>
                                </h5>
                                <p class="text-muted small mb-2">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d H:i') }}
                                </p>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary w-100">View Event</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Reservation Modal -->
    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-3 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="reservationModalLabel">Make a Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @auth
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="place_id" value="{{ $place->id }}">

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

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-success">Confirm Reservation</button>
                            </div>
                        </form>
                    @else
                        <div class="text-center">
                            <p class="fw-semibold">Please <a href="{{ route('login') }}" class="text-primary">log in</a> to make a reservation.</p>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .card {
            border-radius: 12px;
        }

        .btn-lg {
            font-size: 1.2rem;
            padding: 12px;
        }

        .modal-content {
            background-color: #ffffff;
        }

        .hover-zoom {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .hover-zoom:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .hover-primary:hover {
            color: #0d6efd !important;
        }

        .modal-header {
            border-bottom: none;
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }
    </style>
</x-app-layout>
