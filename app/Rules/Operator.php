<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class Operator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(strlen($value) == 8)
        {
            $master = User::where('user_token', '=', $value)->get();
            
            if(!$master->isEmpty() && User::where('user_id', '=', $master[0]->id)->count() < 3)
                return true;

        } else if (strlen($value) == 0)
            return true;

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Código de Acesso inválido ou limite de operadores atingido.';
    }
}
