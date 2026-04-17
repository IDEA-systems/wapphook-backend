<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

class WhatsappNumberStoreRequest extends FormRequest
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
                'required',
                'string',
                'max:255',
                Rule::unique('whatsapp_numbers', 'id')
                    ->where('company_id', $this->route('companyId'))
            ],
            'whatsapp_account_id' => [
                'required',
                'string',
                'max:255',
                Rule::exists('whatsapp_accounts', 'id')
                    ->where('company_id', $this->route('companyId'))
            ],
            'name_visible' => [
                'required',
                'string',
                'max:255',
                Rule::unique('whatsapp_numbers', 'name_visible')
                    ->where('company_id', $this->route('companyId'))
            ],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('whatsapp_numbers', 'phone_number')
                    ->where('company_id', $this->route('companyId'))
            ],
            'api_key' => [
                'required',
                'string'
            ],
            'pin' => [
                'required',
                'numeric',
                'digits:6'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El campo id es obligatorio.',
            'id.numeric' => 'El campo id debe ser un número.',
            'id.unique' => 'El id ya está registrado para otro número de whatsapp.',
            'whatsapp_account_id.required' => 'El campo whatsapp_account_id es obligatorio.',
            'whatsapp_account_id.string' => 'El campo whatsapp_account_id debe ser una cadena de texto.',
            'whatsapp_account_id.exists' => 'El whatsapp_account_id no existe en la base de datos.',
            'name_visible.required' => 'El campo name_visible es obligatorio.',
            'name_visible.string' => 'El campo name_visible debe ser una cadena de texto.',
            'name_visible.max' => 'El campo name_visible no puede tener más de 255 caracteres.',
            'name_visible.unique' => 'El name_visible ya está registrado para otro número de whatsapp.',
            'phone_number.required' => 'El campo phone_number es obligatorio.',
            'phone_number.string' => 'El campo phone_number debe ser una cadena de texto.',
            'phone_number.max' => 'El campo phone_number no puede tener más de 20 caracteres.',
            'phone_number.unique' => 'El phone_number ya está registrado para otro número de whatsapp.',
            'api_key.required' => 'El campo api_key es obligatorio.',
            'api_key.string' => 'El campo api_key debe ser una cadena de texto.',
            'api_key.max' => 'El campo api_key no puede tener más de 1055 caracteres.',
            'pin.required' => 'El campo pin es obligatorio.',
            'pin.string' => 'El campo pin debe ser una cadena de texto.',
            'pin.max' => 'El campo pin no puede tener más de 10 caracteres.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'name' => 'Error de validación',
                'message' => $validator->errors()->first()
            ], 400)
        );
    }
}
