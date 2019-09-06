<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordValidationFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'passNew' => 'required|string|min:8|max:30',
            'passNewConf' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'passNew.required' => 'Você deve preencher este campo.',
            'passNewConf.required' => 'Você deve preencher este campo.',
            'passNew.min' => 'Sua senha deve ter pelo menos 8 caracteres.',
            'passNew.max' => 'Sua senha não deve ultrapassar 30 caracteres.',
        ];
    }
}
