<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/places/manage/{id}', [PlaceController::class, 'manage'])->name('places.manage');
    Route::put('/places/update/{id}', [PlaceController::class, 'update'])->name('places.update');

    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/update/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/destroy/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/events/{id}/reservations', [EventController::class, 'reservations'])->name('events.reservations');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/places/create', [PlaceController::class, 'create'])->name('places.create');
    Route::post('/places/store', [PlaceController::class, 'store'])->name('places.store');
    Route::get('/my-places', [PlaceController::class, 'myPlaces'])->name('places.my');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/places/manage/{id}', [PlaceController::class, 'manage'])->name('places.manage');
    Route::put('/places/update/{id}', [PlaceController::class, 'update'])->name('places.update');
    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/places/manage/{id}', [PlaceController::class, 'manage'])->name('places.manage');
    Route::put('/places/update/{id}', [PlaceController::class, 'update'])->name('places.update');

    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/update/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/destroy/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/events/{id}/reservations', [EventController::class, 'reservations'])->name('events.reservations');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/reservations/my', [ReservationController::class, 'myReservations'])->name('reservations.my');
    Route::delete('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])
        ->name('reservations.cancel')
        ->middleware('auth');
});
Route::get('/places/{id}/reservations', [ReservationController::class, 'showPlaceReservations'])
    ->name('places.reservations')
    ->middleware('auth');

Route::get('/', [PlaceController::class, 'index'])->name('places.index');
Route::get('places/{id}', [PlaceController::class, 'show'])->name('places.show');
Route::delete('/places/{id}', [PlaceController::class, 'destroy'])->name('places.destroy');
Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');

Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');

