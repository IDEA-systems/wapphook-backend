<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            ],
            'email' => [
                'required',
                'string',
                'email',
                'min:1',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
            ],
            'abilities' => [
                'required',
                'array',
                'min:1',
            ],
            'abilities.*' => [
                'required',
                'string',
                'min:1',
                'max:100',
                'distinct',
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
            'email.required' => 'El campo email es obligatorio.',
            'email.string' => 'El campo email debe ser una cadena de texto.',
            'email.email' => 'El campo email debe tener un formato valido.',
            'email.min' => 'El campo email debe tener al menos 1 caracter.',
            'email.max' => 'El campo email no debe exceder los 255 caracteres.',
            'email.unique' => 'El email ya se encuentra registrado.',
            'password.required' => 'El campo password es obligatorio.',
            'password.string' => 'El campo password debe ser una cadena de texto.',
            'password.min' => 'El campo password debe tener al menos 8 caracteres.',
            'password.max' => 'El campo password no debe exceder los 255 caracteres.',
            'abilities.required' => 'El campo abilities es obligatorio.',
            'abilities.array' => 'El campo abilities debe ser un arreglo.',
            'abilities.min' => 'Debes indicar al menos un permiso.',
            'abilities.*.required' => 'Cada permiso es obligatorio.',
            'abilities.*.string' => 'Cada permiso debe ser una cadena de texto.',
            'abilities.*.min' => 'Cada permiso debe tener al menos 1 caracter.',
            'abilities.*.max' => 'Cada permiso no debe exceder los 100 caracteres.',
            'abilities.*.distinct' => 'No se permiten permisos duplicados.',
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
