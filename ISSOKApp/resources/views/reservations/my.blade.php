<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-uppercase fw-bold">My Reservations</h2>
    </x-slot>

    <div class="card shadow p-4">
        @if ($reservations->isEmpty())
            <p class="text-center fw-semibold text-muted">You have no reservations yet.</p>
        @else
            <table class="table table-hover">
                <thead class="table-dark">
                <tr>
                    <th>Place</th>
                    <th>Date & Time</th>
                    <th>People</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->place->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d H:i') }}</td>
                        <td>{{ $reservation->number_of_people }}</td>
                        <td>
                            <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm cancel-confirm">Cancel</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>

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
