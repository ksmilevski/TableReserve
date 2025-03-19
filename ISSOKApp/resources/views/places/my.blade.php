<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold">My Places</h2>
    </x-slot>

    @if ($places->isEmpty())
        <div class="text-center mt-5">
            <h4 class="text-muted">You have not published any places yet.</h4>
            <a href="{{ route('places.create') }}" class="btn btn-success mt-3">Publish a Place</a>
        </div>
    @else
        <div class="row">
            @foreach ($places as $place)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        @if ($place->image)
                            <img src="{{ asset('storage/' . $place->image) }}" class="card-img-top" alt="Place Image">
                        @endif
                        <div class="card-body">
                            <h3 class="card-title text-primary">{{ $place->name }}</h3>
                            <p class="card-text text-muted">{{ $place->description }}</p>
                            <a href="{{ route('places.manage', $place->id) }}" class="btn btn-warning w-100">Manage Place</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
