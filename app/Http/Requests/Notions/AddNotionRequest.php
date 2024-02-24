<?php

declare(strict_types=1);

namespace App\Http\Requests\Notions;

use App\Http\Requests\BaseRequest;

class AddNotionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:50'],
            'content' => ['required', 'string'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => $this->getMessage('required'),
            'title.string' => $this->getMessage('string'),
            'title.max' => $this->getMessage('max'),

            'content.required' => $this->getMessage('required'),
            'content.string' => $this->getMessage('string'),

            'active' => $this->getMessage('boolean'),
        ];
    }
}
