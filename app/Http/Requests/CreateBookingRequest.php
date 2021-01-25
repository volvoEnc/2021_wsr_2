<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'flight_from.id' => ['required', 'numeric', 'exists:flights,id'],
            'flight_from.date' => ['required', 'date', 'date_format:Y-m-d'],
            'flight_back.id' => ['numeric', 'exists:flights,id'],
            'flight_back.date' => ['date', 'date_format:Y-m-d'],
            'passengers.*.first_name' => ['required', 'string'],
            'passengers.*.last_name' => ['required', 'string'],
            'passengers.*.birth_date' => ['required', 'date', 'date_format:Y-m-d'],
            'passengers.*.document_number' => ['required', 'string', 'size:10'],
        ];
    }
}
