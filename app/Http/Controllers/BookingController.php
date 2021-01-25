<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Resources\BookingCodeResource;
use App\Passenger;
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
}
