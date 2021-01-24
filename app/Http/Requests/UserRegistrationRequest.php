<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

class UserRegistrationRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'document_number' => ['required', 'string', 'size:10'],
            'password' => ['required', 'string']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->setResponseStatus(422);
        $this->setResponseMessage('Validation error');
        parent::failedValidation($validator);
    }
}
