<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from' => ['string', 'required', 'exists:airports,iata'],
            'to' => ['string', 'required', 'exists:airports,iata'],
            'date1' => ['required', 'date', 'date_format:Y-m-d'],
            'date2' => ['required', 'date', 'date_format:Y-m-d'],
            'passengers' => ['min:1', 'max:8', 'numeric']
        ];
    }
}
