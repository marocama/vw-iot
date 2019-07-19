<?php

namespace App\Models;

use App\Models\Transmitter;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = [
        'name', 'description', 'path'
    ];

    public function transmitter() 
    {
        return $this->hasMany(Transmitter::class);
    }

}