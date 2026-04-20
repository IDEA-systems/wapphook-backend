<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyTokenUpdateRequest extends FormRequest
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
            'application_id' => [
                'sometimes',
                'string',
                'min:1',
                'max:255',
                Rule::exists('applications', 'id')
                    ->where('company_id', $this->route('companyId')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'application_id.string' => 'El campo application_id debe ser una cadena de texto.',
            'application_id.min' => 'El campo application_id debe tener al menos 1 caracter.',
            'application_id.max' => 'El campo application_id no debe exceder los 255 caracteres.',
            'application_id.exists' => 'La aplicacion especificada no existe para esta empresa.',
        ];
    }
}