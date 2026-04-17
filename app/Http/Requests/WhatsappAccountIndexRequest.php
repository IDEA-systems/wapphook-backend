<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\HttpException;

class WhatsappAccountIndexRequest extends FormRequest
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
            'page' => [
                'required',
                'integer',
                'min:1',
            ],
            'rows' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],
            'order' => [
                'required',
                'in:asc,desc',
            ],
            'sort' => [
                'required',
                'in:id,name,application_id,created_at,updated_at',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'application_id.string' => 'El ID de la aplicación debe ser una cadena de texto.',
            'application_id.min' => 'El ID de la aplicación debe tener al menos 1 carácter.',
            'application_id.max' => 'El ID de la aplicación no puede exceder 255 caracteres.',
            'application_id.exists' => 'El ID de la aplicación no existe para esta compañía.',
            'page.required' => 'El número de página es obligatorio.',
            'page.integer' => 'El número de página debe ser un número entero.',
            'page.min' => 'El número de página debe ser al menos 1.',
            'rows.required' => 'La cantidad de filas es obligatoria.',
            'rows.integer' => 'La cantidad de filas debe ser un número entero.',
            'rows.min' => 'La cantidad de filas debe ser al menos 1.',
            'rows.max' => 'La cantidad de filas no puede exceder 1000.',
            'order.required' => 'El orden es obligatorio.',
            'order.in' => 'El orden debe ser "asc" o "desc".',
            'sort.required' => 'El campo de ordenamiento es obligatorio.',
            'sort.in' => 'El campo de ordenamiento debe ser uno de: id, name, application_id, created_at, updated_at.',
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
