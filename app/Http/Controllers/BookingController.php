<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Flight;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Resources\BookingCodeResource;
use App\Passenger;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(CreateBookingRequest $request)
    {
        $booking = new Booking();

        $booking->flight_from = $request->get('flight_from')['id'];
        $booking->flight_back = $request->get('flight_back')['id'];
        $booking->date_from = $request->get('flight_back')['date'];
        $booking->date_back = $request->get('flight_back')['date'];
        $booking->code = strtoupper(Str::random(5));

        $booking->save();

        foreach ($request->get('passengers') as $item) {
            $passenger = new Passenger($item);
            $passenger->booking_id = $booking->id;
            $passenger->save();
        }

        return new BookingCodeResource($booking);
    }

    public function show($code, Request $request)
    {
        $booking = Booking::query()->where('code', $code)->first();
        if ($booking === null) {
            throw new HttpResponseException(response(null, 404));
        }

        $flightsDb = Flight::with(['airport_to', 'airport_from'])
            ->where('id', $booking->flight_from)
            ->orWhere('id', $booking->flight_back)
            ->get();

        dd($flightsDb->count());

    }
}
