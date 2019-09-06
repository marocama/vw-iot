<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class Operator implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        if(strlen($value) == 8)
        {
            $master = User::where('user_token', $value)->first();
            
            if($master != NULL && $master->user_type == "Master" && User::where('user_id', $master->id)->count() < 3)
                return true;

        } else if (strlen($value) == 0)
            return true;

        return false;
    }

    public function message()
    {
        return 'Código de Acesso inválido ou limite de operadores atingido.';
    }
}
