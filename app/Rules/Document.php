<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Document implements Rule
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
        $value = str_replace(['/', '-', '.'], '', $value);
        
        // Validação de CPF
        if (strlen($value) == 11)
        {
            if (preg_match('/(\d)\1{10}/', $value))
            {
                return false;
            }

            for ($t = 9; $t < 11; $t++)
            {
                for ($d = 0, $c = 0; $c < $t; $c++)
                {
                    $d += $value{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($value{$c} != $d)
                {
                    return false;
                }
            }
            return true;
        }

        // Validação de CNPJ
        if (strlen($value) == 14)
        {
            if (preg_match('/(\d)\1{13}/', $value))
            {
                return false;
            }

	        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	        {
		        $soma += $value{$i} * $j;
		        $j = ($j == 2) ? 9 : $j - 1;
	        }
	        $resto = $soma % 11;
            if ($value{12} != ($resto < 2 ? 0 : 11 - $resto))
            {
                return false;
            }

	        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	        {
		        $soma += $value{$i} * $j;
		        $j = ($j == 2) ? 9 : $j - 1;
	        }
	        $resto = $soma % 11;
	        return $value{13} == ($resto < 2 ? 0 : 11 - $resto);
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Insira um documento válido.';
    }
}
