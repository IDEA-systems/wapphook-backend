<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WhatsappNumberUpdateRequest extends FormRequest
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
            'whatsapp_account_id' => [
                'sometimes',
                'string',
                'max:255',
                Rule::exists('whatsapp_accounts', 'id')
                    ->where('company_id', $this->route('companyId'))
            ],
            'name_visible' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('whatsapp_numbers', 'name_visible')
                    ->where('company_id', $this->route('companyId'))
                    ->ignore($this->route('id'), 'id')
            ],
            'api_key' => [
                'sometimes',
                'string',
                'max:255'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'whatsapp_account_id.string' => 'El ID de la cuenta de whatsapp debe ser una cadena de texto.',
            'whatsapp_account_id.max' => 'El ID de la cuenta de whatsapp no puede exceder los 255 caracteres.',
            'whatsapp_account_id.exists' => 'La cuenta de whatsapp no existe o no pertenece a la empresa.',
            'name_visible.string' => 'El nombre visible debe ser una cadena de texto.',
            'name_visible.max' => 'El nombre visible no puede exceder los 255 caracteres.',
            'name_visible.unique' => 'El nombre visible ya está en uso para esta empresa.',
            'api_key.string' => 'La clave API debe ser una cadena de texto.',
            'api_key.max' => 'La clave API no puede exceder los 255 caracteres.'
        ];
    }
}
