<x-app-layout>
    <div class="container mt-4">
        <!-- Page Title -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-uppercase text-primary">My Profile</h2>
        </div>

        <!-- Manage Places Section -->
        <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('places.create') }}" class="btn btn-outline-primary">Publish Place</a>
                <a href="{{ route('places.my') }}" class="btn btn-outline-primary">My Places</a>
                <a href="{{ route('reservations.my') }}" class="btn btn-outline-primary">My Reservations</a>
            </div>
        </div>

        <!-- Profile & Password Sections -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 p-4 text-center hover-lift">
                    <h5 class="fw-semibold mb-3">Profile Information</h5>
                    <button class="btn btn-success w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 p-4 text-center hover-lift">
                    <h5 class="fw-semibold mb-3">Change Password</h5>
                    <button class="btn btn-warning w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        Change Password
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="editProfileModalLabel">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-warning">Update Password</button>
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

        .hover-lift {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        }

        .modal-content {
            background-color: #fff;
        }
    </style>
</x-app-layout>
