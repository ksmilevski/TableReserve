<x-app-layout>
    <div class="container mt-5">
        <h2 class="text-center text-uppercase fw-bold mb-4">Manage Place</h2>

        <div class="card shadow-sm p-4">
            <ul class="nav nav-tabs" id="managePlaceTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="edit-place-tab" data-bs-toggle="tab" data-bs-target="#edit-place" type="button" role="tab">Edit Place</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reservations-tab" data-bs-toggle="tab" data-bs-target="#reservations" type="button" role="tab">Reservations</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button" role="tab">Upcoming Events</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="create-event-tab" data-bs-toggle="tab" data-bs-target="#create-event" type="button" role="tab">Create Event</button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="managePlaceTabsContent">
                <div class="tab-pane fade show active" id="edit-place" role="tabpanel">
                    <h5 class="fw-bold text-primary">Place Details</h5>
                    <form action="{{ route('places.update', $place->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current Image</label>
                            <div class="mb-2">
                                @if($place->image)
                                    <img src="{{ asset('storage/' . $place->image) }}" class="img-fluid rounded shadow-sm" style="max-width: 200px;" alt="Current Image">
                                @else
                                    <p class="text-muted">No image uploaded.</p>
                                @endif
                            </div>
                            <input type="file" name="image" class="form-control">
                        </div>

                        @foreach (['name' => 'Place Name', 'address' => 'Address', 'city' => 'City', 'phone' => 'Phone', 'description' => 'Description'] as $field => $label)
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ $label }}</label>
                                @if($field == 'description')
                                    <textarea name="{{ $field }}" class="form-control">{{ $place->$field }}</textarea>
                                @else
                                    <input type="text" name="{{ $field }}" class="form-control" value="{{ $place->$field }}">
                                @endif
                            </div>
                        @endforeach

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category" class="form-select">
                                <option value="cafe" {{ $place->category == 'cafe' ? 'selected' : '' }}>Cafe</option>
                                <option value="club" {{ $place->category == 'club' ? 'selected' : '' }}>Club</option>
                                <option value="restaurant" {{ $place->category == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                                <option value="other" {{ $place->category == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">Save Changes</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="reservations" role="tabpanel">
                    <h5 class="fw-bold text-primary">Manage Reservations</h5>
                    <a href="{{ route('places.reservations', $place->id) }}" class="btn btn-outline-dark w-100">Show All Reservations</a>
                </div>

                <div class="tab-pane fade" id="events" role="tabpanel">
                    <h5 class="fw-bold text-primary">Upcoming Events</h5>
                    @if($place->events->isEmpty())
                        <p class="text-muted">No upcoming events.</p>
                    @else
                        <div class="row">
                            @foreach ($upcomingEvents as $event)
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
                                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-secondary w-100">Edit Event</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="create-event" role="tabpanel">
                    <h5 class="fw-bold text-primary">Create Event</h5>
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="place_id" value="{{ $place->id }}">

                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Date</label>
                            <input type="datetime-local" name="event_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Reservations</label>
                            <input type="number" name="max_reservations" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Image</label>
                            <input type="file" name="event_image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Publish Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                let inputField = this.previousElementSibling;
                inputField.removeAttribute('readonly');
                inputField.removeAttribute('disabled');
                inputField.focus();
                this.style.display = "none";
            });
        });

        document.querySelectorAll('.delete-confirm').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                let form = this.closest("form");
                if (confirm("Are you sure you want to delete this event? This action cannot be undone.")) {
                    form.submit();
                }
            });
        });

        document.querySelectorAll('.save-confirm').forEach(button => {
            button.addEventListener('click', function (e) {
                if (!confirm("Are you sure you want to save these changes?")) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
