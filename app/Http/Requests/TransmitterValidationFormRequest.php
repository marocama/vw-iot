<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransmitterValidationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:5|max:30',
            'number_serial' => 'required|string|size:10',
            'interface' => 'required|string|size:4',
            'location' => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Você deve definir um Identificador.',
            'name.min' => 'O Identificador deve conter pelo menos 5 caracteres.',
            'name.max' => 'O Identificador não deve ultrapassar 30 caracteres.',
            'number_serial.required' => 'Você deve definir um Número Serial.',
            'number_serial.size' => 'Número Serial inválido.',
            'interface.required' => 'Você deve definir uma Interface.',
            'interface.size' => 'Interface inválida.',
            'location.max' => 'Insira uma localização menor.', 
        ];
    }
}
