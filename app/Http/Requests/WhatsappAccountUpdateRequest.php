<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WhatsappAccountUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'sometimes',
                'string',
                'min:1',
                'max:255',
                Rule::unique('whatsapp_accounts')
                    ->where('company_id', $this->route('companyId'))
                    ->ignore($this->route('id'), 'id'),
            ],
            'application_id' => [
                'sometimes',
                'string',
                'min:1',
                'max:255',
            ],
            'name' => [
                'sometimes',
                'string',
                'min:1',
                'max:255',
            ],
        ];
    }
}
