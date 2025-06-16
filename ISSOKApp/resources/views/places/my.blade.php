<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold text-primary">My Places</h2>
    </x-slot>

    <div class="container mt-4">
        @if ($places->isEmpty())
            <div class="text-center py-5">
                <h4 class="text-muted mb-3">You have not published any places yet.</h4>
                <a href="{{ route('places.create') }}" class="btn btn-primary py-2 px-4">Publish a Place</a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($places as $place)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 rounded-3 hover-lift">
                            @if ($place->image)
                                <img src="{{ asset('storage/' . $place->image) }}" class="card-img-top img-fluid" style="height: 180px; object-fit: cover;" alt="Place Image">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 180px;">
                                    <i class="bi bi-image text-muted fs-1"></i>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="fw-bold text-primary mb-2">{{ $place->name }}</h5>
                                <p class="text-muted small mb-3">{{ Str::limit($place->description, 80) }}</p>
                                <a href="{{ route('places.manage', $place->id) }}" class="btn btn-outline-primary w-100 shadow-sm">Manage Place</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: #fff;
        }
    </style>
</x-app-layout>
