<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function upTell(Request $request)
    {
        if (strlen($request->phone) >= 14 && strlen($request->phone <= 15))
        {
            auth()->user()->phone = str_replace(['(', ')', '-', ' '], '', $request->phone);
            auth()->user()->save();

            return redirect()
                        ->route('profile')
                        ->with('success', 'Telefone atualizado com sucesso.');
        }

        return redirect()
                        ->route('profile')
                        ->with('error', 'Telefone inválido, tente novamente.');
    }

    public function upPass(Request $request)
    {
        if ($request->passNew == null || $request->passNewConf == null) 
            return redirect()
                        ->route('profile')
                        ->with('error', 'Preencha os dois campos para alterar a senha.');
        if ($request->passNew != $request->passNewConf)
            return redirect()
                        ->route('profile')
                        ->with('error', 'Sua confirmação de senha não confere.');
        if (strlen($request->passNew) < 8 )
            return redirect()
                        ->route('profile')
                        ->with('error', 'Sua senha deve ter pelo menos 8 caracteres.');
        
        $update = auth()->user()->update(
            array(
                'password' => bcrypt($request->passNew),
            )
        );

        if ($update)
            return redirect()
                        ->route('profile')
                        ->with('success', 'Senha alterada com sucesso.');
        return redirect()
                    ->route('profile')
                    ->with('error', 'Erro ao atualizar, tente novamente.');
    }
}
