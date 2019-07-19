<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'name', 'period', 'symbol', 'color', 'view', 'user_id'
    ];

    public function register($name, $period, $symbol, $color, $user) : Array
    {
        $alert = Alert::create([
            'name' => $name,
            'period'=> $period,
            'symbol' => $symbol,
            'color' => $color,
            'view' => false,
            'user_id' => $user,
        ]);

        if ($alert)
            return [
                'success' => true,
            ];
        
        return [
            'success' => false,
            'message' => 'Erro Interno, código: A5.'
        ];
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
