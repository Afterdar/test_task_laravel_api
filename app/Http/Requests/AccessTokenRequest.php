<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class AccessTokenRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => $this->getMessage('required'),
            'email.email' => $this->getMessage('email'),

            'password.required' => $this->getMessage('required'),

            'device_name.required' => $this->getMessage('required'),
        ];
    }
}
