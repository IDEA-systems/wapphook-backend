<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class VerifyTokenStoreRequest extends FormRequest
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
                'required',
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
            'application_id.required' => 'El campo application_id es obligatorio.',
            'application_id.string' => 'El campo application_id debe ser una cadena de texto.',
            'application_id.min' => 'El campo application_id debe tener al menos 1 caracter.',
            'application_id.max' => 'El campo application_id no debe exceder los 255 caracteres.',
            'application_id.exists' => 'La aplicacion especificada no existe para esta empresa.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'name' => 'Error de validacion',
                'message' => $validator->errors()->first()
            ], 400)
        );
    }
}