<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightDirectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'city' => $this->airport_from->city,
            'airport' => $this->airport_from->name,
            'iata' => $this->airport_from->iata,
            'date' => $request->get('date1'),
            'time' => $this->time()
        ];
    }
}
