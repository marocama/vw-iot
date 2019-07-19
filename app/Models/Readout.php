<?php

namespace App\Models;

use App\Models\Transmitter;

use Illuminate\Database\Eloquent\Model;

class Readout extends Model
{
    protected $fillable = [
        'protocol', 'transmitter_id'
    ];

    protected $casts = [
        'protocol' => 'array'
    ];

    public function transmitter() 
    {
        return $this->belongsTo(Transmitter::class);
    }
}
