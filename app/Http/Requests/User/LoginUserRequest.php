<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Exception;

class LoginUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'min:6'],
        ];
    }

    /**
     * @throws Exception
     */
    public function messages(): array
    {
        return [
            'email.required' => $this->getMessage('required'),
            'email.email' => $this->getMessage('email'),
            'email.max' => $this->getMessage('max'),

            'password.required' => $this->getMessage('required'),
            'password.min' => $this->getMessage('min'),
        ];
    }
}

