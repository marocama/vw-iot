<?php

namespace App\Models;
use App\User;
use App\Models\Interaction;
use App\Models\Readout;

use Illuminate\Database\Eloquent\Model;

class Transmitter extends Model
{
    protected $fillable = [
        'name', 'number_serial', 'location', 'user_id', 'interface_id'
    ];

    /**
     * Função de associação de transmissor a uma conta
     *
     * @return Array
     */
    public function register($name, $number_serial, $interface, $location) : Array
    {
        $valid = Interaction::find($interface);

        if ($valid == NULL) 
            return [
                'success' => false,
                'message' => 'Código de Interface inválido.'
            ]; 

        $verify = Transmitter::where('number_serial', '=', $number_serial)->get();

        if (!$verify->isEmpty()) 
        {
            if ($verify[0]->user_id == NULL) 
            {
                $verify[0]->name           = $name;
                $verify[0]->location       = $location;
                $verify[0]->user_id        = auth()->user()->id;
                $verify[0]->interaction_id = $interface; 
                
                $verify[0]->save();

                if ($verify[0])
                    return [
                        'success' => true,
                        'message' => 'Transmissor registrado com sucesso!',
                    ];
                return [
                    'success' => false,
                    'message' => 'Falha no registro, tente novamente.'
                ];
            }
            return [
                'success' => false,
                'message' => 'Transmissor já registrado.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Transmissor não encontrado, tente novamente.'
        ];
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function interaction() 
    {
        return $this->belongsTo(Interaction::class);
    }

    public function readout() 
    {
        return $this->hasMany(Readout::class);
    }
}