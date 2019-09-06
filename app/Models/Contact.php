<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Contact extends Model
{
    protected $fillable = [
        'message', 'answered', 'user_id'
    ];

    /*******************************/
    /** Registro de nova mensagem **/
    /*******************************/

    public function register($message) : Array
    {
        $contact = new Contact();

        $contact->message   = $message;
        $contact->user_id   = auth()->user()->id;

        $contact->save();

        if ($contact)
            return [
                'success' => true,
                'message' => 'Mensagem enviada. Você receberá uma resposta em breve por email.',
            ];

        return [
            'success' => false,
            'message' => 'Ocorreu um erro, tente novamente.'
        ];
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
