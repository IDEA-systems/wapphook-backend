<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CompanyStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:1',
                'max:255',
                Rule::unique('companies', 'name'),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'min:1',
                'max:255',
                Rule::unique('companies', 'email'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo name es obligatorio.',
            'name.string' => 'El campo name debe ser una cadena de texto.',
            'name.min' => 'El campo name debe tener al menos 1 caracter.',
            'name.max' => 'El campo name no debe exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una compania con este nombre.',
            'email.required' => 'El campo email es obligatorio.',
            'email.string' => 'El campo email debe ser una cadena de texto.',
            'email.email' => 'El campo email debe tener un formato valido.',
            'email.min' => 'El campo email debe tener al menos 1 caracter.',
            'email.max' => 'El campo email no debe exceder los 255 caracteres.',
            'email.unique' => 'Ya existe una compania con este correo.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'name' => 'Error de validacion',
                'message' => $validator->errors()->first(),
            ], 400)
        );
    }
}