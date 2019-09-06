<?php

namespace App\Models;
use App\User;
use App\Models\Interaction;
use App\Models\Readout;
use App\Models\Mark;

use Illuminate\Database\Eloquent\Model;

class Transmitter extends Model
{
    protected $fillable = [
        'name', 'number_serial', 'location', 'user_id', 'interface_id', 'mark_id'
    ];

    /*******************************************/
    /** Associação de transmissor a uma conta **/
    /*******************************************/

    public function register($name, $number_serial, $interface, $location) : Array
    {
        $valid = Interaction::find($interface);

        if ($valid == NULL) 
            return [
                'success' => false,
                'message' => 'Código de Interface inválido.'
            ]; 

        $verify = Transmitter::where('number_serial', $number_serial)->first();

        if ($verify != NULL) 
        {
            if ($verify->user_id == NULL) 
            {
                $verify->name           = $name;
                $verify->location       = $location;
                $verify->user_id        = auth()->user()->id;
                $verify->interaction_id = $interface; 
                
                $verify->save();

                if ($verify)
                    return [
                        'success' => true,
                        'message' => 'Transmissor registrado com sucesso!'
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

    /**********************************/
    /** Registro de novo transmissor **/
    /**********************************/

    public function new($number_serial, $status) : Array
    {
        $transmitter = new Transmitter();

        $transmitter->number_serial = strtoupper($number_serial);
        $transmitter->status        = $status;

        $transmitter->save();
        
        if ($transmitter)
            return [
                'success' => true,
                'message' => 'Transmissor registrado com sucesso!'
            ];

        return [
            'success' => false,
            'message' => 'Falha no registro, tente novamente.'
        ];
    }

    /******************/
    /** Seta máscara **/
    /******************/

    public function set($number_serial, $mark) : Array
    {
        $transmitter = Transmitter::where('number_serial', $number_serial)->first();
        
        $valid = Mark::find($mark);
        if ($valid == NULL)
            return [
                'success' => false,
                'message' => 'Ocorreu um erro, tente novamente.'
            ];

        if ($transmitter != NULL && ($transmitter->user_id == auth()->user()->id || $transmitter->user_id == auth()->user()->user_id)) 
        {
            $transmitter->mark_id = $mark;

            $transmitter->save();
            
            if ($transmitter)
                return [
                    'success' => true,
                    'message' => 'Máscara alterada com sucesso.'
                ];
        }
        return [
            'success' => false,
            'message' => 'Ocorreu um erro, tente novamente.'
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

    public function mark() 
    {
        return $this->belongsTo(Mark::class);
    }

    public function readout() 
    {
        return $this->hasMany(Readout::class);
    }
}