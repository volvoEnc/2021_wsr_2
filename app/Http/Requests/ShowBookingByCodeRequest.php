<?php

namespace App\Http\Requests;


class ShowBookingByCodeRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['required', 'exists:bookings,code']
        ];
    }
}
