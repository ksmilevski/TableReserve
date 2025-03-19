<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold text-dark">Create Place</h2>
    </x-slot>

    <div class="card shadow-lg border-0 rounded-4 p-4">
        <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-2">
                <label class="form-label fw-semibold">Place Name</label>
                <input type="text" name="name" class="form-control shadow-sm" required>
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">Address</label>
                <input type="text" name="address" class="form-control shadow-sm" required>
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">City</label>
                <input type="text" name="city" class="form-control shadow-sm" required>
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control shadow-sm" required>
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control shadow-sm" rows="3"></textarea>
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">Category</label>
                <select name="category" class="form-select shadow-sm" required>
                    <option value="cafe">Cafe</option>
                    <option value="club">Club</option>
                    <option value="restaurant">Restaurant</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Upload Image</label>
                <input type="file" name="image" class="form-control shadow-sm" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary w-100 shadow-sm">Publish Place</button>
        </form>
    </div>

    <style>
        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            max-width: 600px;
            margin: auto;
        }
    </style>
</x-app-layout>
