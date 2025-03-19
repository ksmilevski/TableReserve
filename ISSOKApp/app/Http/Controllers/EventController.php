<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('events.show', compact('event'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'max_reservations' => 'required|integer|min:1',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('events', 'public');
        }

        Event::create([
            'place_id' => $request->place_id,
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'max_reservations' => $request->max_reservations,
            'event_image' => $imagePath,
        ]);

        return back()->with('success', 'Event created successfully!');
    }



    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'max_reservations' => 'required|integer|min:1',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData = $request->only(['title', 'description', 'event_date', 'max_reservations']);

        if ($request->hasFile('event_image')) {
            if ($event->event_image) {
                Storage::disk('public')->delete($event->event_image);
            }

            $imagePath = $request->file('event_image')->store('events', 'public');
            $validatedData['event_image'] = $imagePath;
        }

        $event->update($validatedData);

        return redirect()->route('places.manage', $event->place_id)->with('success', 'Event updated successfully!');
    }




    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return back()->with('success', 'Event deleted successfully!');
    }

    public function reservations($id)
    {
        $event = Event::findOrFail($id);

        $reservations = Reservation::where('event_id', $id)
            ->orderBy('reservation_date', 'asc')
            ->get();

        return view('events.reservations', compact('event', 'reservations'));
    }
}
