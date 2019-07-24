<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Interaction;
use Illuminate\Http\Request;
use App\Models\Transmitter;
use App\Models\Readout;

class ReadoutController extends Controller
{
    public function write(Request $request)
    {
        if ($request->token_access == "9g8peWj36O9O")
        {
            $board = Transmitter::where('number_serial', '=', $request->number_serial)->first();
        
            if ($board)
            {
                $user = User::where('id', '=', $board->user_id)->first();
                
                if ($user)
                {

                    if (strtotime($user->expiration) > strtotime('now'))
                    {
                        
                        if ($board->status)
                        {
                            $register = Readout::create([
                                'protocol' => $request->protocol,
                                'transmitter_id' => $board->id,
                            ]);
                            
                            if ($register)  
                                return response('', 201);
                        }
                        return response('', 423);
                    }
                    return response('', 402);
                }
                return response('', 404);   
            }
            return response('', 404);
        }
        return response('', 401);
    }

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
        {
            $readouts = Readout::where('transmitter_id', '=', $transmitter[0]->id)->latest()->limit(5)->get();

            return view('monitoring.view', compact('transmitter', 'interaction', 'readouts'));
        }

        return redirect()
                ->route('home')
                ->with('error', 'Ocorreu um erro, tente novamente.');
    }
}
