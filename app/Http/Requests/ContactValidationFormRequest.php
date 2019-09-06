<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactValidationFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'message' => 'required|string|min:10',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'Escreva no campo de mensagem para enviar.',
            'message.min' => 'Texto muito curto, descreva melhor sua mensagem.'
        ];
    }
}
