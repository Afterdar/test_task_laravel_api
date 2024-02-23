<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Exception;

class RegisterUser extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'unique:users', 'max:50'],
            'password' => ['required', 'min:6'],
        ];
    }

    /**
     * @throws Exception
     */
    public function messages(): array
    {
        return [
            'name.required' => $this->getMessage('required'),
            'name.max' => $this->getMessage('max'),

            'email.required' => $this->getMessage('required'),
            'email.unique' => $this->getMessage('unique'),
            'email.max' => $this->getMessage('max'),

            'password.required' => $this->getMessage('required'),
            'password.min' => $this->getMessage('min'),
        ];
    }
}

