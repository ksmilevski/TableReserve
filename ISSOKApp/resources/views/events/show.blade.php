<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-3 p-4 mb-4">
            @if ($event->event_image)
                <img src="{{ asset('storage/' . $event->event_image) }}" class="img-fluid rounded mb-4" alt="Event Image" style="max-height: 250px; object-fit: cover; width: 100%;">
            @endif

            <h1 class="fw-bold text-primary mb-3">{{ $event->title }}</h1>
            <p class="text-muted">{{ $event->description }}</p>
            <p><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d H:i') }}</p>
            <p><strong>Location:</strong> {{ $event->place->name }}</p>
            <p><strong>Address:</strong> {{ $event->place->address }}, {{ $event->place->city }}</p>

            <div class="text-center mt-4">
                @if ($event->current_reservations >= $event->max_reservations)
                    <p class="text-danger fw-bold">Reservations are fully booked for this event.</p>
                @else
                    @auth
                        <button class="btn btn-primary btn-lg w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#reservationModal">
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
            <div class="modal-content border-0 rounded-3 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="reservationModalLabel">Make a Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="place_id" value="{{ $event->place->id }}">
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="customer_name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="reservation_date" value="{{ $event->event_date }}">

                        <!-- Phone Input -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Phone</label>
                            <input type="text" name="customer_phone" class="form-control shadow-sm" required>
                        </div>

                        <!-- Number of People -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Number of People</label>
                            <input type="number" name="number_of_people" class="form-control shadow-sm" required>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-success shadow-sm">Confirm Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
        }

        .btn-lg {
            padding: 12px;
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-content {
            background-color: #ffffff;
            border-radius: 12px;
        }

        .modal-header {
            border-bottom: none;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.save-confirm').forEach(button => {
                button.addEventListener('click', function (e) {
                    if (!confirm("Are you sure you want to confirm this reservation?")) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</x-app-layout>
