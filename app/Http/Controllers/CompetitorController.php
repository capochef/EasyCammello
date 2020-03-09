<?php

namespace App\Http\Controllers;

use App\Client;
use App\Competitor;
use App\Http\Requests\Competitor as CompetitorRequest;
use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitors = Competitor::with('client')->get();
        return view('competitors.index', compact('competitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::orderBy('name')->get()->pluck('name', 'id');
        return view('competitors.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetitorRequest $request)
    {
        $validated = $request->validated();

        try {
            $competitor = new Competitor();
            $competitor->name = $validated->name;
            $competitor->client_id = $validated->client;
            $competitor->category = $validated->category;
            $competitor->save();
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('status', $e->getMessage());
        }

        return redirect()->route('competitors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function show(Competitor $competitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Competitor $competitor)
    {
        $clients = Client::orderBy('name')->get()->pluck('name', 'id');
        return view('competitors.edit', compact('competitor', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function update(CompetitorRequest $request, Competitor $competitor)
    {
        $validated = $request->validated();

        try {
            $competitor->name = $validated->name;
            $competitor->client_id = $validated->client;
            $competitor->category = $validated->category;
            $competitor->update();
        } catch (\Exception $e) {
            session()->flash('type', 'warning');
            session()->flash('status', $e->getMessage());
        }

        return redirect()->route('competitors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competitor $competitor)
    {
        foreach ($competitor->events as $event)
            $event->delete();
        $competitor->delete();
    }
}
