<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'name', 'public', 'period', 'symbol', 'color', 'view', 'user_id'
    ];

    /**********************************/
    /** Registro de nova notificação **/
    /**********************************/

    public function register($name, $symbol, $color, $user) : Array
    {
        $alert = new Alert;

        $alert->name = $name;
        $alert->public = false;
        $alert->period = date('Y-m-d H:i:s', strtotime('now'));
        $alert->symbol = $symbol;
        $alert->color = $color;
        $alert->view = false;
        $alert->user_id = $user;

        $alert->save();

        if ($alert)
            return [
                'success' => true,
            ];
        
        return [
            'success' => false,
            'message' => 'Erro Interno, código: A5.'
        ];
    }

    /******************************************/
    /** Registro de nova notificação pública **/
    /******************************************/

    public function registerAdmin($name, $symbol, $color, $period) : Array
    {
        $alert = new Alert;

        $alert->name = $name;
        $alert->public = true;
        $alert->period = date('Y-m-d H:i:s', strtotime($period));
        $alert->symbol = $symbol;
        $alert->color = $color;
        $alert->view = false;
        $alert->user_id = null;

        $alert->save();
        
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
