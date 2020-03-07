<?php

namespace App\Http\Controllers;

use App\Competitor;
use App\Charts\RankingChart;
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
        $chart = new RankingChart;

        $comp = Competitor::with('events', 'client')->get();
        $lbl = array();
        $points = array();
        foreach ($comp as $key => $value) {
            $lbl[$key] = $value->name;
            if(!isset($points[$value->id]))
                $points[$value->id] = 0;

            $points[$value->id] += $value->events->sum('points');
        }

        // $chart->minimalist(true);
        $chart->labels(array_values($lbl));
        $chart->dataset('Points', 'bar', array_values($points));

        return view('home', compact('chart'));
    }
}
