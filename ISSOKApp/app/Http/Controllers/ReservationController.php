<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
            'event_id' => 'nullable|exists:events,id',
            'customer_phone' => 'required|string|max:20',
            'number_of_people' => 'required|integer|min:1',
        ]);

        if ($request->event_id) {
            $event = Event::findOrFail($request->event_id);

            if ($event->current_reservations >= $event->max_reservations) {
                return back()->with('error', 'No more reservations available for this event.');
            }

            Reservation::create([
                'user_id' => auth()->id(),
                'place_id' => $request->place_id,
                'event_id' => $request->event_id,
                'customer_name' => auth()->user()->name,
                'customer_phone' => $request->customer_phone,
                'reservation_date' => $event->event_date,
                'number_of_people' => $request->number_of_people,
            ]);

            $event->increment('current_reservations');
        }
        else {
            Reservation::create([
                'user_id' => auth()->id(),
                'place_id' => $request->place_id,
                'event_id' => null,
                'customer_name' => auth()->user()->name,
                'customer_phone' => $request->customer_phone,
                'reservation_date' => $request->reservation_date,
                'number_of_people' => $request->number_of_people,
            ]);
        }

        return back()->with('success', 'Reservation created successfully!');
    }
    public function myReservations()
    {
        $twelveHoursAgo = now()->subHours(12);

        $reservations = Reservation::where('user_id', auth()->id())
            ->where('reservation_date', '>=', $twelveHoursAgo)
            ->orderBy('reservation_date', 'asc')
            ->get();

        return view('reservations.my', compact('reservations'));
    }


    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (auth()->id() !== $reservation->user_id) {
            return redirect()->back()->with('error', 'You do not have permission to cancel this reservation.');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation cancelled successfully.');
    }

    public function showPlaceReservations($id)
    {
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $reservations = Reservation::where('place_id', $id)
            ->whereNull('event_id')
            ->orderBy('reservation_date', 'asc')
            ->get();

        return view('reservations.place', compact('place', 'reservations'));
    }

}
