<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingFlightsResource extends JsonResource
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
            'code' => $this->code,
            'cost' => $this->cost,
            'flights' => FlightResource::collection($this->flights),
            'passengers' => BookingPassengersResource::collection($this->passengers)
        ];
    }
}
