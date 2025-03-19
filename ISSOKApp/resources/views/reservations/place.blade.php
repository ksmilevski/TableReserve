<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold">Reservations for {{ $place->name }}</h2>
    </x-slot>

    <div class="card shadow p-4">
        @if ($reservations->isEmpty())
            <p class="text-center fw-semibold text-muted">No reservations for this place.</p>
        @else
            <table class="table table-hover">
                <thead class="table-dark">
                <tr>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Date & Time</th>
                    <th>People</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->customer_name }}</td>
                        <td>{{ $reservation->customer_phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d H:i') }}</td>
                        <td>{{ $reservation->number_of_people }}</td>
                        <td>
                            <!-- Owner cannot cancel, only user who created the reservation can cancel -->
                            @if(auth()->id() === $reservation->user_id)
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                            @else
                                <span class="text-muted">Not allowed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
