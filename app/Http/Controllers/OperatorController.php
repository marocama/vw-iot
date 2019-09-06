<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class OperatorController extends Controller
{
    // *********************************
    // ***** Etapa de verificação ******
    // *****       Master         ******
    // *********************************

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            if ($this->user->user_type != "Master")
                return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui autorização para acessar essa página.');

            return $next($request);
        });
    }

    // ****************************************
    // ** Exibe lista de operadores cadastrados
    public function show() 
    {
        $operators = auth()->user()->operators()->get();
        return view('operators.showOperators', compact('operators'));
    }
    
    // ******************************************
    // ** Recebe um POST para deletar um operador
    public function del(Request $request)
    {
        $operator = User::find($request->identify);

        if(!$operator)
            return redirect()
                    ->route('operators')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
                    
        if ($operator->user_id == auth()->user()->id)
        {
            $operator->delete();
            return redirect()
                    ->route('operators')
                    ->with('success', 'Operador deletado com sucesso.');
        }
        
        return redirect()
                    ->route('operators')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }
}
