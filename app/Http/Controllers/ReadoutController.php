<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Interaction;
use Illuminate\Http\Request;
use App\Models\Transmitter;

class ReadoutController extends Controller
{
    public function monitoring(Request $request) 
    {   
        if (auth()->user()->user_type == 'Master')
        {
            $transmitter = auth()->user()->transmitters()->where('number_serial', '=', $request->number_serial)->get();
        }
        else
        {
            $transmitter = Transmitter::where('number_serial', '=', $request->number_serial)->get();
            
            if ($transmitter[0]->user_id != auth()->user()->user_id)
                return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui autorização para acessar essa página.');
        }
        $interaction = Interaction::where('id', '=', $request->interaction)->get();

        if ($transmitter[0]->interaction_id == $interaction[0]->id)
            return view('monitoring.view', compact('transmitter', 'interaction'));

        return redirect()
                ->route('home')
                ->with('error', 'Ocorreu um erro, tente novamente.');
    }
}
