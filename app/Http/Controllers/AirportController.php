<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Flight;
use App\Http\Requests\FlightsRequest;
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

    public function flights(FlightsRequest $request)
    {
        $af = $request->get('from');
        $at = $request->get('to');

        $flightsDb = Flight::with(['airport_to', 'airport_from'])->get();
        $flightsTo = new Collection();
        $flightsBack = new Collection();
        $flights = new Collection();

        foreach ($flightsDb as $f) {
            if ($f->airport_to->iata == $at && $f->airport_from->iata == $af) {
                $flightsTo->add($f);
            }
        }

        $flights->add($flightsTo);
        if ($request->has('date2')) {
            foreach ($flightsDb as $f) {
                if ($f->airport_from->iata == $at && $f->airport_to->iata == $af) {
                    $flightsBack->add($f);
                }
            }
        }
        $flights->add($flightsBack);

        return new FlightsCollection($flights);
    }
}
