<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class OperatorController extends Controller
{
    public function show() 
    {
        if (auth()->user()->user_type == "Master") 
        {
            $operators = auth()->user()->operators()->get();
            return view('operators.showOperators', compact('operators'));
        }

        return redirect()
                    ->route('home')
                    ->with('error', 'Você não possui autorização para acessar essa página.');
        
    }
    
    public function del(Request $request)
    {
        $operator = User::findOrFail($request->identify);

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
