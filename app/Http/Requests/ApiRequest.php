<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    protected $responseStatus = 422;
    protected $responseMessage = 'Validation error';
    protected $responseErrors = null;

    protected function setResponseStatus($status)
    {
        $this->responseStatus = $status;
    }

    protected function getResponseStatus()
    {
        return $this->responseStatus;
    }

    protected function setResponseMessage($msg)
    {
        $this->responseMessage = $msg;
    }

    protected function getResponseMessage()
    {
        return $this->responseMessage;
    }

    protected function failedValidation(Validator $validator)
    {
        $responseArray = [
            'error' => [
                'code' => $this->getResponseStatus(),
                'message' => $this->getResponseMessage(),
                'errors' => $validator->errors()->toArray()
            ]
        ];
        throw new HttpResponseException(response($responseArray, $this->getResponseStatus()));
    }

    protected function failedAuthorization()
    {
        $responseArray = [
            'error' => [
                'code' => 401,
                'message' => 'Unauthorized'
            ]
        ];
        if (!empty($this->responseErrors)) {
            $responseArray['error']['errors'] = $this->responseErrors;
        }

        throw new HttpResponseException(response($responseArray, $this->getResponseStatus()));
    }
}
