<?php

namespace App\Models;

use App\Models\Transmitter;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = [
        'name', 'description', 'path'
    ];

    /********************************/
    /** Registro de nova interface **/
    /********************************/

    public function registerInterface($code, $name, $description) : Array
    {
        $interaction = new Interaction();

        $interaction->id = $code;
        $interaction->name = $name;
        $interaction->description = $description;
        $interaction->path = 'monitoring.interactions.'.$code;

        $interaction->save();
        
        if ($interaction)
            return [
                'success' => true,
            ];
        
        return [
            'success' => false,
            'message' => 'Erro Interno, código: I5.'
        ];
    }

    public function transmitter() 
    {
        return $this->hasMany(Transmitter::class);
    }

    public function mark() 
    {
        return $this->hasMany(Mark::class);
    }
}