<?php

namespace App\Http\Controllers;

use App\Models\Transmitter;
use App\Models\Alert;
use App\Http\Requests\TransmitterValidationFormRequest;

class TransmitterController extends Controller
{
    // *******************************************
    // ** Exibe todos os transmissores cadastrados
    public function show() 
    {
        if (auth()->user()->user_type == "Master")
        {
            $boards = auth()->user()->transmitters()->get();
            return view('transmitters.showTransmitters', compact('boards'));
        } 
        else 
        {
            $boards = Transmitter::where('user_id', auth()->user()->user_id)->get();
            return view('transmitters.showTransmitters', compact('boards'));
        }
            
    }

    // ***************************************************
    // ** Exibe formulário para registrar novo transmissor
    public function form()
    {
        if (auth()->user()->user_type == "Master") 
        {
            return view('transmitters.addTransmitter');
        }

        return redirect()
                    ->route('home')
                    ->with('error', 'Você não possui autorização para acessar essa página.');
    }

    // *************************************************
    // ** Recebe um POST para registrar novo transmissor
    public function add(TransmitterValidationFormRequest $request, Transmitter $transmitter, Alert $alert)
    {
        $response = $transmitter->register($request->name, $request->number_serial, $request->interface, $request->location);

        if ($response['success'])
        {
            $notify = $alert->register('Novo Transmissor cadastrado.', 'microchip', 'success', auth()->user()->id);

            if($notify['success']) 
                return redirect()
                            ->route('transmitters')
                            ->with('success', $response['message']);

            if(!$notify['success']) 
                return redirect()
                            ->route('transmitters.form')
                            ->with('error', $notify['message']);
        }

        if(!$response['success']) 
                return redirect()
                            ->route('transmitters.form')
                            ->with('error', $response['message']);
    }
}
