<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold text-primary">Create Place</h2>
    </x-slot>

    <div class="container mt-3">
        <div class="card shadow-sm border-0 rounded-3 p-4 mx-auto" style="max-width: 600px;">
            <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Place Name -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Place Name</label>
                    <input type="text" name="name" class="form-control shadow-sm" required>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <input type="text" name="address" class="form-control shadow-sm" required>
                </div>

                <!-- City -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">City</label>
                    <input type="text" name="city" class="form-control shadow-sm" required>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control shadow-sm" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control shadow-sm" rows="3"></textarea>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Category</label>
                    <select name="category" class="form-select shadow-sm" required>
                        <option value="" disabled selected>Select Category</option>
                        <option value="cafe">Cafe</option>
                        <option value="club">Club</option>
                        <option value="restaurant">Restaurant</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload Image</label>
                    <input type="file" name="image" class="form-control shadow-sm" accept="image/*">
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm">Publish Place</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            margin-top: 20px; /* Reduced top margin to bring form closer to the navbar */
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

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</x-app-layout>
