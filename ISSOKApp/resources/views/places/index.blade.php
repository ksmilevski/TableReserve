<x-app-layout>
    <div class="container py-4">
        <!-- Title -->
        <h1 class="text-center text-uppercase fw-bold mb-4 text-primary">Discover Places</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('places.index') }}" class="row g-3 mb-4">
            <div class="col-md-5">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-geo-alt-fill text-primary"></i></span>
                    <select name="city" class="form-select border-0 shadow-sm">
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-5">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-tags-fill text-primary"></i></span>
                    <select name="type" class="form-select border-0 shadow-sm">
                        <option value="">Select Type</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('type') == $category ? 'selected' : '' }}>
                                {{ ucfirst($category) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="bi bi-search"></i> Search</button>
            </div>
        </form>

        <!-- No Places Message -->
        @if ($places->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="bi bi-exclamation-circle fs-1 mb-3"></i>
                <p class="mt-2">No places listed yet. Check back later!</p>
            </div>
        @else
            <!-- Places Grid -->
            <div class="row g-4">
                @foreach ($places as $place)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-zoom">
                            @if ($place->image)
                                <img src="{{ asset('storage/' . $place->image) }}" class="card-img-top img-fluid img-fixed-size" alt="{{ $place->name }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="fw-bold text-dark mb-2">
                                    <a href="{{ route('places.show', $place->id) }}" class="text-decoration-none text-primary hover-primary">
                                        {{ $place->name }}
                                    </a>
                                </h5>
                                <p class="text-muted small mb-1"><i class="bi bi-geo-alt"></i> {{ $place->address }}</p>
                                <span class="badge bg-primary-subtle text-primary mb-2">{{ ucfirst($place->category) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Additional Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
        }

        .img-fixed-size {
            height: 180px;
            object-fit: cover;
        }

        .hover-zoom {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-zoom:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        }

        .hover-primary:hover {
            color: #0d6efd !important;
        }
    </style>
</x-app-layout>



{{--<x-app-layout>--}}
{{--        <div class="container inner-frame py-5 px-4">--}}
{{--            <!-- Title -->--}}
{{--            <h1 class="text-center text-uppercase fw-bold mb-4 text-dark">Discover Places</h1>--}}

{{--            <!-- Search Form -->--}}
{{--            <form method="GET" action="{{ route('places.index') }}" class="row g-3 mb-4">--}}
{{--                <div class="col-md-5">--}}
{{--                    <div class="input-group shadow-sm">--}}
{{--                        <span class="input-group-text bg-white border-0"><i class="bi bi-geo-alt-fill text-primary"></i></span>--}}
{{--                        <select name="city" class="form-select border-0 shadow-sm">--}}
{{--                            <option value="">Select City</option>--}}
{{--                            @foreach($cities as $city)--}}
{{--                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-5">--}}
{{--                    <div class="input-group shadow-sm">--}}
{{--                        <span class="input-group-text bg-white border-0"><i class="bi bi-tags-fill text-primary"></i></span>--}}
{{--                        <select name="type" class="form-select border-0 shadow-sm">--}}
{{--                            <option value="">Select Type</option>--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <option value="{{ $category }}" {{ request('type') == $category ? 'selected' : '' }}>--}}
{{--                                    {{ ucfirst($category) }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2">--}}
{{--                    <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="bi bi-search"></i> Search</button>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            <!-- No Places Message -->--}}
{{--            @if ($places->isEmpty())--}}
{{--                <div class="text-center text-muted fs-5 py-5">--}}
{{--                    <i class="bi bi-exclamation-circle fs-1"></i>--}}
{{--                    <p class="mt-2">No places listed yet. Check back later!</p>--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <!-- Places Grid -->--}}
{{--                <div class="row g-4">--}}
{{--                    @foreach ($places as $place)--}}
{{--                        <div class="col-lg-4 col-md-6">--}}
{{--                            <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-zoom">--}}
{{--                                @if ($place->image)--}}
{{--                                    <img src="{{ asset('storage/' . $place->image) }}" class="card-img-top img-fluid img-fixed-size" alt="{{ $place->name }}">--}}
{{--                                @endif--}}
{{--                                <div class="card-body d-flex flex-column">--}}
{{--                                    <h5 class="fw-bold text-dark mb-2">--}}
{{--                                        <a href="{{ route('places.show', $place->id) }}" class="text-decoration-none text-dark hover-primary">--}}
{{--                                            {{ $place->name }}--}}
{{--                                        </a>--}}
{{--                                    </h5>--}}
{{--                                    <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $place->address }}</p>--}}
{{--                                    <span class="badge bg-primary-subtle text-primary align-self-start">{{ ucfirst($place->category) }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}
{{--    </div>--}}

{{--    <!-- Additional Styles -->--}}
{{--    <style>--}}
{{--        /* Glassmorphism Inner Frame */--}}
{{--        .inner-frame {--}}
{{--            background: rgba(255, 255, 255, 0.85);--}}
{{--            backdrop-filter: blur(10px);--}}
{{--            border-radius: 20px;--}}
{{--            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);--}}
{{--            max-width: 1100px;--}}
{{--            width: 95%;--}}
{{--        }--}}

{{--        /* Consistent Image Sizing */--}}
{{--        .img-fixed-size {--}}
{{--            height: 200px;--}}
{{--            object-fit: cover;--}}
{{--        }--}}

{{--        /* Hover Effect for Cards */--}}
{{--        .hover-zoom {--}}
{{--            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;--}}
{{--        }--}}
{{--        .hover-zoom:hover {--}}
{{--            transform: scale(1.05);--}}
{{--            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);--}}
{{--        }--}}

{{--        /* Hover Effect for Links */--}}
{{--        .hover-primary:hover {--}}
{{--            color: #0d6efd !important;--}}
{{--        }--}}
{{--    </style>--}}
{{--</x-app-layout>--}}
