<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use Illuminate\Http\Request;
use App\Models\Transmitter;
use App\Models\Readout;
use App\Models\Mark;
use App\Http\Requests\ReadoutValidationFormRequest;

class ReadoutController extends Controller
{
    // *****************************************************************
    // ** Recebe um POST para registro de nova leitura de um transmissor
    public function write(ReadoutValidationFormRequest $request, Readout $readout)
    {
        $register = $readout->register($request->token_access, $request->number_serial, $request->protocol);

        return response('', $register['code']);
    }

    // *********************************************************************************
    // ** Exibe a interface correspondente para visualização dos dados de um transmissor
    public function monitoring(Request $request) 
    {   
        if (strlen($request->transmitter) != 10) return redirect()->route('home')->with('error', 'Ocorreu um erro, tente novamente.');

        if (auth()->user()->user_type == 'Master')
        {
            $transmitter = auth()->user()->transmitters()->where('number_serial', $request->transmitter)->first();
            if (!$transmitter) return redirect()->route('home')->with('error', 'Ocorreu um erro, tente novamente.');

            $marks = auth()->user()->marks()->where('interaction_id', $transmitter->interaction->id)->get();
        }
        else
        {
            $transmitter = Transmitter::where('number_serial', $request->transmitter)->first();
            if (!$transmitter) return redirect()->route('home')->with('error', 'Ocorreu um erro, tente novamente.');

            if ($transmitter->user_id != auth()->user()->user_id)
                return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui autorização para acessar essa página.');

            $marks = Mark::where('interaction_id', $transmitter->interaction->id)->get();
        }
        
        $readouts = Readout::where('transmitter_id', $transmitter->id)->orderBy('created_at', 'desc')->limit(30)->get();

        if ($request->filled('selection'))
        {
            $selection = Readout::where([['transmitter_id', $transmitter->id],['created_at', $request->selection]])->first();
        }
        else
        {
            $selection = Readout::where('transmitter_id', $transmitter->id)->orderBy('created_at', 'desc')->first();
        }
            
        if (!$readouts) return redirect()->route('home')->with('error', 'Ainda não há registros deste transmissor.');
        if (!$selection) return redirect()->route('home')->with('error', 'Ocorreu um erro, tente novamente.');

        return view('monitoring.view', compact('transmitter', 'readouts', 'marks', 'selection'));

        return redirect()
                ->route('home')
                ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // *******************************************************
    // ** Recebe um POST para registro de nova máscara de TAGs
    public function newMark(Request $request, Mark $mark)
    {   
        $interface = Interaction::where('id', $request->interface)->first();
        if (!$interface) return redirect()->route('home')->with('error', 'Ocorreu um erro, tente novamente.');

        $mark->register($request->identify, json_encode($request->except(['_token', 'identify'])), $interface->id);

        if ($mark) 
            return redirect()
                    ->route('transmitters')
                    ->with('success', 'Máscara definida com sucesso.');

        return redirect()
                ->route('transmitters')
                ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // ********************************************
    // ** Recebe um POST para alterar máscara atual
    public function setMask(Request $request, Transmitter $transmitter)
    {   
        $set = $transmitter->set($request->transmitter, $request->identify);

        if ($set['success']) 
            return redirect()
                    ->route('transmitters')
                    ->with('success', $set['message']);

        return redirect()
                ->route('transmitters')
                ->with('error', $set['message']);
    }
}
