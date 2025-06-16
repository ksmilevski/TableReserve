<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold text-primary">Reservations for {{ $event->title }}</h2>
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-3 p-4">
            @if ($reservations->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted fs-5">No reservations for this event.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Date & Time</th>
                            <th>People</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td class="fw-semibold text-primary">{{ $reservation->customer_name }}</td>
                                <td>{{ $reservation->customer_phone }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d H:i') }}</td>
                                <td>{{ $reservation->number_of_people }}</td>
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

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .text-primary {
            color: #0d6efd;
        }
    </style>
</x-app-layout>
