<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FlightsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'flights_to' => FlightResource::collection($this->collection->get(0)),
                'flights_from' => FlightResource::collection($this->collection->get(1)),
            ]
        ];
    }
}
