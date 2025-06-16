<nav class="navbar navbar-expand-lg bg-light border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold text-dark" href="{{ url('/') }}">My App</a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto d-flex align-items-center gap-2">
                <li class="nav-item">
                    <a href="{{ route('places.index') }}" class="btn btn-outline-dark">Places</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-dark">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-outline-dark">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    .navbar {
        padding: 1rem;
    }
    .btn {
        font-size: 0.9rem;
        padding: 8px 15px;
        border-radius: 0; /* No rounded corners */
        border: 1px solid #000; /* Thin border */
        background: none;
        color: #000;
        transition: all 0.2s ease-in-out;
    }
    .btn:hover {
        background: #f8f9fa;
    }
</style>
