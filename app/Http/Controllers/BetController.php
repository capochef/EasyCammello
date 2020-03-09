<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Competitor;
use App\Http\Requests\Bet as BetRequest;
use Illuminate\Http\Request;

class BetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bets = Bet::with('user', 'competitor.client')->get();
        return view('bets.index', compact('bets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $competitors = Competitor::get();
        return view('bets.create', compact('competitors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BetRequest $request)
    {
        $validated = $request->validated();

        try {
            $bet = new Bet();
            $bet->user_id = auth()->id();
            $bet->competitor_id = $validated->competitor;
            $bet->value = $validated->value;
            $bet->save();
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('status', $e->getMessage());
        }

        return redirect()->route('bets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function show(Bet $bet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function edit(Bet $bet)
    {
        $competitors = Competitor::get();
        return view('bets.edit', compact('bet', 'competitors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function update(BetRequest $request, Bet $bet)
    {
        $validated = $request->validated();

        try {
            $bet->competitor_id = $validated->competitor;
            $bet->value = $validated->value;
            $bet->update();
        } catch (\Exception $e) {
            session()->flash('type', 'warning');
            session()->flash('status', $e->getMessage());
        }

        return redirect()->route('bets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bet $bet)
    {
        $bet->delete();
    }
}
