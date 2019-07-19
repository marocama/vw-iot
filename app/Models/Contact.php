<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'message', 'user_id'
    ];

    public function register($message) : Array
    {
        $contact = Contact::create([
            'message' => $message,
            'user_id' => auth()->user()->id,
        ]);

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
