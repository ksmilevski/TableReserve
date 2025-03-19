<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold">Reservations for {{ $event->title }}</h2>
    </x-slot>

    <div class="card shadow p-4">
        @if ($reservations->isEmpty())
            <p class="text-center fw-semibold text-muted">No reservations for this event.</p>
        @else
            <table class="table table-hover">
                <thead class="table-dark">
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
                        <td>{{ $reservation->customer_name }}</td>
                        <td>{{ $reservation->customer_phone }}</td>
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ $reservation->number_of_people }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>


