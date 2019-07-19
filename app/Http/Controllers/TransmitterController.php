<?php

namespace App\Http\Controllers;

use App\Models\Transmitter;
use App\User;
use App\Models\Alert;
use App\Http\Requests\TransmitterValidationFormRequest;

class TransmitterController extends Controller
{
    public function show() 
    {
        if (auth()->user()->user_type == "Master")
        {
            $boards = auth()->user()->transmitters()->get();
            return view('transmitters.showTransmitters', compact('boards'));
        } 
        else 
        {
            $boards = Transmitter::where('user_id', '=', auth()->user()->user_id)->get();
            return view('transmitters.showTransmitters', compact('boards'));
        }
            
    }

    public function edit() 
    {
        $boards = auth()->user()->transmitters()->get();
        return view('transmitters.showTransmitters', compact('boards'));
    }

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

    public function add(TransmitterValidationFormRequest $request, Transmitter $transmitter)
    {
        $response = $transmitter->register($request->name, $request->number_serial, $request->interface, $request->location);

        if ($response['success'])
        {
            Alert::create([
                'name' => 'Novo Transmissor cadastrado.',
                'period' => date('Y-m-d H:i:s', strtotime('now')),
                'symbol' => 'microchip',
                'color' => 'success',
                'view' => false,
                'user_id' => auth()->user()->id,
            ]);

            return redirect()
                        ->route('transmitters')
                        ->with('success', $response['message']);
        }
        return redirect()
                    ->route('transmitters.form')
                    ->with('error', $response['message']);
    }
}
