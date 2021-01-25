<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightDirectionTo extends JsonResource
{
    public function toArray($request)
    {
        return [
            'city' => $this->airport_to->city,
            'airport' => $this->airport_to->name,
            'iata' => $this->airport_to->iata,
            'date' => $request->get('date1'),
            'time' => $this->time()
        ];
    }
}
