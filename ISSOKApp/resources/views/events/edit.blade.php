<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold">Edit Event</h2>
    </x-slot>

    <div class="card shadow p-4">
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label fw-semibold">Event Title</label>
                <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ $event->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Event Date</label>
                <input type="datetime-local" name="event_date" class="form-control"
                       value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Max Reservations</label>
                <input type="number" name="max_reservations" class="form-control" value="{{ $event->max_reservations }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Current Event Image</label>
                <div class="mb-2">
                    @if($event->event_image)
                        <img src="{{ asset('storage/' . $event->event_image) }}" class="img-fluid rounded shadow-sm" style="max-width: 200px;" alt="Event Image">
                    @else
                        <p class="text-muted">No image uploaded.</p>
                    @endif
                </div>
                <label class="form-label fw-semibold">Upload New Image</label>
                <input type="file" name="event_image" class="form-control">
                <small class="text-muted">Upload a new image to replace the existing one.</small>
            </div>

            <button type="submit" class="btn btn-success w-100 save-confirm">Save Changes</button>
        </form>
    </div>
</x-app-layout>

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
