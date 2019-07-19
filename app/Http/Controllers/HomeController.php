<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transmitter;
use App\Models\Readout;
use App\Models\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $operators = auth()->user()->operators()->count();

        if (auth()->user()->user_type == "Master")
        {
            $transmitters = auth()->user()->transmitters()->count();
            $list = auth()->user()->transmitters()->pluck('id')->all();
            $lastPack = Readout::whereIn('transmitter_id', $list)->pluck('created_at')->last();

            return view('home', compact('operators', 'transmitters', 'lastPack'));
        }
        else 
        {
            $transmitters = Transmitter::where('user_id', '=', auth()->user()->user_id)->count(); 
            $list = Transmitter::where('user_id', '=', auth()->user()->user_id)->pluck('id')->all();
            $lastPack = Readout::whereIn('transmitter_id', $list)->pluck('created_at')->last();

            return view('home', compact('operators', 'transmitters', 'lastPack'));
        }
    }

    public function statistics()
    {
        return view('statistics.unavailable');
    }
}
