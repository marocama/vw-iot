<?php

namespace App\Http\Controllers;

class AlertController extends Controller
{
    // ***************************************
    // ** Limpa contador de alertas do usuário
    public function clear()
    {
        auth()->user()->alerts()->update(['view' => true]);

        return redirect()->route('home');
    }
}
