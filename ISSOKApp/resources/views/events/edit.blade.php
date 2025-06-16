<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold text-primary">Edit Event</h2>
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-3 p-4">
            <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Event Title -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Event Title</label>
                    <input type="text" name="title" class="form-control shadow-sm" value="{{ $event->title }}" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control shadow-sm" rows="3">{{ $event->description }}</textarea>
                </div>

                <!-- Event Date -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Event Date</label>
                    <input type="datetime-local" name="event_date" class="form-control shadow-sm"
                           value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') }}" required>
                </div>

                <!-- Max Reservations -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Max Reservations</label>
                    <input type="number" name="max_reservations" class="form-control shadow-sm" value="{{ $event->max_reservations }}" required>
                </div>

                <!-- Current Event Image -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Event Image</label>
                    <div class="mb-2">
                        @if($event->event_image)
                            <img src="{{ asset('storage/' . $event->event_image) }}" class="img-fluid rounded shadow-sm mb-2"
                                 style="width: 150px; height: 150px; object-fit: cover;" alt="Event Image">
                        @else
                            <p class="text-muted">No image uploaded.</p>
                        @endif
                    </div>

                    <!-- Upload New Image -->
                    <label class="form-label fw-semibold">Upload New Image</label>
                    <input type="file" name="event_image" class="form-control shadow-sm">
                    <small class="text-muted">Upload a new image to replace the existing one.</small>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success py-2 shadow-sm save-confirm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            margin-top: 20px;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0px 0px 8px rgba(13, 110, 253, 0.2);
        }

        .btn-success {
            background-color: #198754;
            border: none;
        }

        .btn-success:hover {
            background-color: #157347;
        }

        .save-confirm {
            transition: background-color 0.3s, transform 0.3s;
        }

        .save-confirm:hover {
            background-color: #157347;
            transform: translateY(-2px);
        }

        .text-muted {
            font-size: 0.9rem;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.save-confirm').forEach(button => {
                button.addEventListener('click', function (e) {
                    if (!confirm("Are you sure you want to save these changes?")) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</x-app-layout>
