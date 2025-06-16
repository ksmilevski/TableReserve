<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold text-primary">My Reservations</h2>
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-3 p-4">
            @if ($reservations->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted fs-5">You have no reservations yet.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                        <tr>
                            <th>Place</th>
                            <th>Date & Time</th>
                            <th>People</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td class="fw-semibold text-primary">{{ $reservation->place->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d H:i') }}</td>
                                <td>{{ $reservation->number_of_people }}</td>
                                <td class="text-center">
                                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm cancel-confirm">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table thead {
            background-color: #0d6efd;
            color: #ffffff;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .cancel-confirm {
            transition: background-color 0.3s, transform 0.3s;
        }

        .cancel-confirm:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.cancel-confirm').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    let form = this.closest("form");
                    if (confirm("Are you sure you want to cancel this reservation?")) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
