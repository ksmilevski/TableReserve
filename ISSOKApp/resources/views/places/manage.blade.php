<x-app-layout>
    <div class="container mt-4">
        <h2 class="text-center text-uppercase fw-bold mb-4 text-primary">Manage Place</h2>

        <div class="card shadow-sm border-0 rounded-3 p-4">
            <ul class="nav nav-tabs mb-4" id="managePlaceTabs" role="tablist">
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

            <div class="tab-content" id="managePlaceTabsContent">

                <!-- Edit Place Tab -->
                <div class="tab-pane fade show active" id="edit-place" role="tabpanel">
                    <h5 class="fw-bold text-primary mb-3">Place Details</h5>
                    <form action="{{ route('places.update', $place->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Current Image -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current Image</label>
                            <div class="mb-2">
                                @if($place->image)
                                    <img src="{{ asset('storage/' . $place->image) }}" class="img-fluid rounded mb-3" style="max-width: 150px;" alt="Current Image">
                                @else
                                    <p class="text-muted">No image uploaded.</p>
                                @endif
                            </div>
                            <input type="file" name="image" class="form-control shadow-sm">
                        </div>

                        <!-- Dynamic Fields -->
                        @foreach (['name' => 'Place Name', 'address' => 'Address', 'city' => 'City', 'phone' => 'Phone', 'description' => 'Description'] as $field => $label)
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ $label }}</label>
                                @if($field == 'description')
                                    <textarea name="{{ $field }}" class="form-control shadow-sm">{{ $place->$field }}</textarea>
                                @else
                                    <input type="text" name="{{ $field }}" class="form-control shadow-sm" value="{{ $place->$field }}">
                                @endif
                            </div>
                        @endforeach

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category" class="form-select shadow-sm">
                                <option value="cafe" {{ $place->category == 'cafe' ? 'selected' : '' }}>Cafe</option>
                                <option value="club" {{ $place->category == 'club' ? 'selected' : '' }}>Club</option>
                                <option value="restaurant" {{ $place->category == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                                <option value="other" {{ $place->category == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3 shadow-sm">Save Changes</button>
                    </form>
                </div>

                <!-- Reservations Tab -->
                <div class="tab-pane fade" id="reservations" role="tabpanel">
                    <h5 class="fw-bold text-primary mb-3">Manage Reservations</h5>
                    <a href="{{ route('places.reservations', $place->id) }}" class="btn btn-outline-primary w-100 shadow-sm">Show All Reservations</a>
                </div>

                <!-- Upcoming Events Tab -->
                <div class="tab-pane fade" id="events" role="tabpanel">
                    <h5 class="fw-bold text-primary mb-3">Upcoming Events</h5>
                    @if($place->events->isEmpty())
                        <p class="text-muted">No upcoming events.</p>
                    @else
                        <div class="row g-3">
                            @foreach ($upcomingEvents as $event)
                                <div class="col-md-4">
                                    <div class="card shadow-sm border-0 h-100">
                                        @if($event->event_image)
                                            <img src="{{ asset('storage/' . $event->event_image) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="Event Image">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="fw-bold text-primary">{{ $event->title }}</h6>
                                            <p class="text-muted small">{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d H:i') }}</p>
                                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-secondary w-100">Edit Event</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Create Event Tab -->
                <div class="tab-pane fade" id="create-event" role="tabpanel">
                    <h5 class="fw-bold text-primary mb-3">Create Event</h5>
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="place_id" value="{{ $place->id }}">

                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" name="title" class="form-control shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control shadow-sm"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Date</label>
                            <input type="datetime-local" name="event_date" class="form-control shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Max Reservations</label>
                            <input type="number" name="max_reservations" class="form-control shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Image</label>
                            <input type="file" name="event_image" class="form-control shadow-sm">
                        </div>

                        <button type="submit" class="btn btn-success w-100 shadow-sm">Publish Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
        }

        .btn {
            border-radius: 6px;
        }

        .nav-tabs .nav-link.active {
            background-color: #0d6efd;
            color: #ffffff;
        }

        .nav-tabs .nav-link {
            color: #0d6efd;
        }

        .nav-tabs .nav-link:hover {
            background-color: #e9ecef;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
        }
    </style>
</x-app-layout>
