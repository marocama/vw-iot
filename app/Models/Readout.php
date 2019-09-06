<?php

namespace App\Models;

use App\Models\Transmitter;
use App\User;

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

    /***********************************************/
    /** Novo registro de protocolo do transmissor **/
    /***********************************************/

    public function register($token, $number_serial, $protocol) : Array
    {
        if($token == "9g8peWj36O9O")
        {
            $board = Transmitter::where('number_serial', $number_serial)->first();
        
            if ($board)
            {
                $user = User::where('id', $board->user_id)->first();
                
                if ($user)
                {
                    if (strtotime($user->expiration) > strtotime('now'))
                    {
                        if ($board->status)
                        {
                            $register = new Readout();

                            $register->protocol         = json_decode($protocol);
                            $register->transmitter_id   = $board->id;
                            
                            $register->save();

                            if ($register)  
                                return [
                                    'success' => true,
                                    'code' => 201
                                ]; 
                        }
                        return [
                            'success' => false,
                            'code' => 423
                        ]; 
                    }
                    return [
                        'success' => false,
                        'code' => 402
                    ]; 
                }
                return [
                    'success' => false,
                    'code' => 409
                ]; 
            }
            return [
                'success' => false,
                'code' => 404
            ]; 
        }
        return [
            'success' => false,
            'code' => 401
        ]; 
    }
}
