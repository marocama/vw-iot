<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReadoutValidationFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'token_access' => 'required|string|size:12',
            'number_serial' => 'required|string|size:10',
            'protocol' => 'required|string',
        ];
    }
}
