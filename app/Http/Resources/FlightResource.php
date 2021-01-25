<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
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
            'flight_id' => $this->id,
            'flight_code' => $this->flight_code,
            'from' => new FlightDirectionResource($this),
            'to' => new FlightDirectionTo($this),
            'cost' => $this->cost,
            'availability' => $this->availability
        ];
    }
}
