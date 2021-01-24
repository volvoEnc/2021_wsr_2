<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Flight;
use App\Http\Resources\AirportItemResource;
use App\Http\Resources\AirportsItemCollection;
use App\Http\Resources\FlightsCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('query');
        if (empty($q)) {
            return AirportsItemCollection::collection(new Collection());
        }

        $iata = strtoupper($q);
        $airports = Airport::query()
            ->where('city', 'LIKE', "%{$q}%")
            ->orWhere('name', 'LIKE', "%{$q}%")
            ->orWhere('iata', $iata)
            ->get();

        return new AirportsItemCollection($airports);
    }

    public function flights()
    {
        $flights_to = Flight::with(['airport_to', 'airport_from'])->get();


        $flights_back = Flight::with(['airport_to', 'airport_from'])->get();

        $flights_back = new Collection();
        $flights = new Collection();
        $flights->add($flights_to);
        $flights->add($flights_back);

        return new FlightsCollection($flights);
    }
}
