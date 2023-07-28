<?php

namespace App\Http\Requests;

use App\Traits\ResponseFormatTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CarrierRequest extends FormRequest
{
    use ResponseFormatTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator): void
    {
        static::responseFailedValidation($validator->errors());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $rules = [
            'name' => 'required|string|max:255',
            'lastnamefather' => 'required|string|max:255',
            'lastnamemother' => 'required|string|max:255',
            'cedula' => 'required|string|max:13|unique:persons',
            'birthdate' => 'required|date|max:255',
            'license' => 'required|string|max:255|unique:carriers',
        ];
        $rulesNull= [
            'name' => 'nullable|string|max:255',
            'lastnamefather' => 'nullable|string|max:255',
            'lastnamemother' => 'nullable|string|max:255',
            'cedula' => 'nullable|string|max:13',
            'birthdate' => 'nullable|date|max:255',
            'license' => 'nullable|string|max:255',
        ];
        return match ($this->method()) {
            'POST'=> $rules,
            'PUT'=> $rulesNull,
       };
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'lastnamefather' => 'apellido paterno',
            'lastnamemother' => 'apellido materno',
            'cedula' => 'cedula',
            'birthdate' => 'fecha de nacimiento',
            'license' => 'licencia',
        ];
    }
}
