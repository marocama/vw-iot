<?php

namespace App\Http\Controllers;

use App\Models\Transmitter;
use App\Models\Readout;
use App\Models\Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    // ***********************
    // ** Exibe página inicial
    public function index()
    {
        if (auth()->user()->user_type == "Admin")
        {
            $users = collect();
            $transmitters = collect();
            return view('admin.index', compact('users', 'transmitters'));
        }

        $operators = auth()->user()->operators()->count();
        $alerts = Alert::where([['public', true], ['period', '>', date('Y-m-d H:i:s', strtotime('now'))]])->orderBy('updated_at', 'desc')->get();

        if (auth()->user()->user_type == "Master")
        {
            $transmitters = auth()->user()->transmitters()->count();
            $list = auth()->user()->transmitters()->pluck('id')->all();
            $lastPack = Readout::whereIn('transmitter_id', $list)->pluck('created_at')->last();

            return view('home', compact('operators', 'transmitters', 'lastPack', 'alerts'));
        }
        else 
        {
            $transmitters = Transmitter::where('user_id', auth()->user()->user_id)->count(); 
            $list = Transmitter::where('user_id', auth()->user()->user_id)->pluck('id')->all();
            $lastPack = Readout::whereIn('transmitter_id', $list)->pluck('created_at')->last();

            return view('home', compact('operators', 'transmitters', 'lastPack', 'alerts'));
        }
    }

    // *****************************************
    // ** Exibe página temporária dos relatórios
    public function statistics()
    {
        return view('statistics.unavailable');
    }
}
