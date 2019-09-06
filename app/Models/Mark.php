<?php

namespace App\Models;

use App\User;
use App\Models\Interaction;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        'name', 'mark', 'interaction_id', 'user_id'
    ];

    protected $casts = [
        'mark' => 'array'
    ];

    public function interaction() 
    {
        return $this->belongsTo(Interaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /******************************/
    /** Registro de nova máscara **/
    /******************************/

    public function register($name, $data, $interface)
    {
        $mark = new Mark();

        $mark->name             = $name;
        $mark->mark             = json_decode($data);
        $mark->interaction_id   = $interface;

        if (auth()->user()->user_type == "Operador")
            $mark->user_id = auth()->user()->user_id;

        if (auth()->user()->user_type == "Master")
            $mark->user_id = auth()->user()->id;

        $mark->save();
        
        if ($mark)
            return true;

        return false;
    }
}
