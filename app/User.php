<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Transmitter;
use App\Models\Contact;
use App\Models\Alert;
use App\Models\Mark;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'document', 'cep', 'birth', 'expiration', 'password', 'user_type', 'user_token', 'user_id', 'permit_customize', 'fileName', 'linkName'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transmitters()
    {
        return $this->hasMany(Transmitter::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function operators()
    {
        return $this->hasMany(User::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    /**************************/
    /** Atualização de Senha **/
    /**************************/

    public function newPass($newPass, $confPass) : Array
    {
        if($newPass != $confPass)
            return [
                'success' => false,
                'message' => 'Sua confirmação de senha não confere.'
            ]; 
        
        $update = auth()->user()->update(
            array(
                'password' => bcrypt($newPass),
            )
        );

        if ($update)
            return [
                'success' => true,
                'message' => 'Senha alterada com sucesso.'
            ];
        
        return [
            'success' => false,
            'message' => 'Erro ao atualizar, tente novamente.'
        ];
    }
}
