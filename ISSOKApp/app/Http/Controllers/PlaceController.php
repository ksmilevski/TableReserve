<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Place::query();

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('type')) {
            $query->where('category', $request->type);
        }

        $places = $query->get();

        $cities = Place::select('city')->distinct()->pluck('city');
        $categories = ['cafe', 'club', 'restaurant', 'other'];

        return view('places.index', compact('places', 'cities', 'categories'));
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);
        $upcomingEvents = $place->events()
            ->where('event_date', '>=', Carbon::now())
            ->orderBy('event_date')
            ->get();

        return view('places.show', compact('place', 'upcomingEvents'));
    }
    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
            'category' => 'required|in:cafe,club,restaurant,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('places', 'public');
        }

        Place::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect()->route('places.my')->with('success', 'Place created successfully!');
    }


    public function myPlaces()
    {
        $places = Place::where('user_id', auth()->id())->get();
        return view('places.my', compact('places'));
    }
    public function manage($id)
    {
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $upcomingEvents = $place->events()
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->get();

        return view('places.manage', compact('place', 'upcomingEvents'));
    }

    public function destroy($id)
    {
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $place->events()->delete();
        $place->reservations()->delete();

        $place->delete();

        return redirect()->route('places.index')->with('success', 'Place deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $place = Place::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
            'category' => 'required|in:cafe,club,restaurant,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($place->image) {
                Storage::disk('public')->delete($place->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('places', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update place with validated data
        $place->update($validatedData);

        return redirect()->route('places.manage', $place->id)->with('success', 'Place updated successfully!');
    }

}
