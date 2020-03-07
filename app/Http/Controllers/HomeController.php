<?php

namespace App\Http\Controllers;

use App\Competitor;
use Illuminate\Http\Request;

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
        $competitors = Competitor::with('events', 'client')->get();
        $lbl = array();
        $max = 0;
        foreach ($competitors as $key => $value) {
            $lbl[$key] = $value->name;
            if(!isset($competitors[$key]['points']))
                $competitors[$key]['points'] = 0;

            $competitors[$key]['points'] += $value->events->sum('points');

            if($competitors[$key]['points'] > $max)
                $max = $competitors[$key]['points'];
        }

        foreach ($competitors as $key => $value) {
            $competitors[$key]['points'] /= $max;
        }
        
        return view('home', compact('competitors'));
    }
}
