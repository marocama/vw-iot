<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Rules\Document;
use App\Rules\Operator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:14' , 'max:15'],
            'document' => ['required', 'string', 'min:14', 'max:18', new Document],
            'cep' => ['required', 'string', 'size:9'],
            'birth' => ['required', 'string', 'size:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted'],
            'operator_token' => new Operator,
        ], [
            'name.min' => 'Seu nome deve ter pelo menos 4 caracteres.',
            'email.unique' => 'Este email já está vinculado a uma conta.',
            'phone.min' => 'Insira um número válido.',
            'phone.max' => 'Insira um número válido.',
            'document.min' => 'Insira um documento válido.',
            'document.max' => 'Insira um documento válido.',
            'cep.size' => 'Digite um CEP válido.',
            'birth.size' => 'Digite uma data válida.',
            'password.min' => 'Sua senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'Sua confirmação de senha não confere.',
            'terms.required' => 'Você deve aceitar para prosseguir.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (isset($data['operator']) && $data['operator'] == 'on')
        {
            $master = User::where('user_token', $data['operator_token'])->first();
            $alert = new Alert;

            $alert->name    = 'Novo Operador cadastrado.';
            $alert->public  = false;
            $alert->period  = date('Y-m-d H:i:s', strtotime('now'));
            $alert->symbol  = 'user-plus';
            $alert->color   = 'success';
            $alert->view    = false;
            $alert->user_id = $master->id;

            $alert->save();
        }

        $user = new User;

        $user->name         = $data['name'];
        $user->email        = $data['email'];
        $user->phone        = str_replace(['(', ')', '-', ' '], '', $data['phone']);
        $user->document     = str_replace(['/', '-', '.'], '', $data['document']);
        $user->cep          = str_replace('-', '', $data['cep']);    
        $user->birth        = date('Y-m-d', strtotime(str_replace('/', '-', $data['birth'])));
        $user->expiration   = isset($data['operator']) && $data['operator'] == 'on' ? $master->expiration : date('Y-m-d H:i:s', strtotime('+1 day'));
        $user->password     = Hash::make($data['password']);
        $user->user_type    = isset($data['operator']) && $data['operator'] == 'on' ? 'Operador' : 'Master';
        $user->user_token   = Str::random(8);
        $user->fileName     = isset($data['operator']) && $data['operator'] == 'on' ? $master->fileName : null;
        $user->user_id      = isset($data['operator']) && $data['operator'] == 'on' ? $master->id : null;
        
        $user->save();

        return $user;
    }
}