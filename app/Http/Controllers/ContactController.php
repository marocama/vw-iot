<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Alert;
use App\Http\Requests\ContactValidationFormRequest;

class ContactController extends Controller
{
    // ********************************************
    // ** Exibe formulário para contato com suporte
    public function index()
    {
        return view('contact');
    }

    // *********************************************************
    // ** Recebe um POST para registrar nova mensagem no suporte
    public function form(ContactValidationFormRequest $request, Contact $contact, Alert $alert)
    {
        $response = $contact->register($request->message);

        if($response['success'])
        {
            $notify = $alert->register('Mensagem enviada ao suporte.', 'comment', 'primary', auth()->user()->id);

            if($notify['success']) 
                return redirect()
                            ->route('contact')
                            ->with('success', $response['message']);

            if(!$notify['success']) 
                return redirect()
                            ->route('contact')
                            ->with('error', $notify['message']);
        }

        return redirect()
                    ->route('contact')
                    ->with('error', $response['message']);
    }
}
