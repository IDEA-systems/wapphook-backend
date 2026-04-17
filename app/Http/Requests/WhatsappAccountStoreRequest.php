<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class WhatsappAccountStoreRequest extends FormRequest
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
                'min:1',
                'max:255',
                Rule::unique('whatsapp_accounts', 'id')
                    ->where('company_id', $this->route('companyId')),
            ],
            'application_id' => [
                'required',
                'string',
                'min:1',
                'max:255',
                Rule::exists('applications', 'id')
                    ->where('company_id', $this->route('companyId')),
            ],
            'name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El campo id es obligatorio.',
            'id.string' => 'El campo id debe ser una cadena de texto.',
            'id.min' => 'El campo id debe tener al menos 1 carácter.',
            'id.max' => 'El campo id no debe exceder los 255 caracteres.',
            'id.unique' => 'Ya existe una cuenta de WhatsApp con este ID para esta empresa.',
            'application_id.required' => 'El campo application_id es obligatorio.',
            'application_id.string' => 'El campo application_id debe ser una cadena de texto.',
            'application_id.min' => 'El campo application_id debe tener al menos 1 carácter.',
            'application_id.max' => 'El campo application_id no debe exceder los 255 caracteres.',
            'application_id.exists' => 'La aplicación especificada no existe para esta empresa.',
            'name.required' => 'El campo name es obligatorio.',
            'name.string' => 'El campo name debe ser una cadena de texto.',
            'name.min' => 'El campo name debe tener al menos 1 carácter.',
            'name.max' => 'El campo name no debe exceder los 255 caracteres.',
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
