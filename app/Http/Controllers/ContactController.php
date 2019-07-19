<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Alert;
use App\Http\Requests\ContactValidationFormRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function form(ContactValidationFormRequest $request, Contact $contact)
    {
        $response = $contact->register($request->message);

        if ($response['success'])
        {
            Alert::create([
                'name' => 'Mensagem enviada ao suporte.',
                'period' => date('Y-m-d H:i:s', strtotime('now')),
                'symbol' => 'comment',
                'color' => 'primary',
                'view' => false,
                'user_id' => auth()->user()->id,
            ]);
            return redirect()
                        ->route('contact')
                        ->with('success', $response['message']);
        }
            return redirect()
                        ->route('contact')
                        ->with('success', $response['message']);
        return redirect()
                    ->route('contact')
                    ->with('error', $response['message']);
    }
}
