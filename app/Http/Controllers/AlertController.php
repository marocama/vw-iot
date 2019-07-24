<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function clear()
    {
        auth()->user()->alerts()->update(['view' => true]);

        return redirect()->route('home');
    }
}
