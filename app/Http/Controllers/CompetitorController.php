<?php

namespace App\Http\Controllers;

use App\Client;
use App\Competitor;
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
    public function store(Request $request)
    {
        if(Competitor::where('name', $request->name)->where('category', $request->category)->where('client_id', $request->client)->get()->all() || !$request->name){
            session([
                'status' => 'Concorrente già esistente'
            ]);
            return view('competitors.create');
        }

        try {
            $competitor = new Competitor();
            $competitor->name = $request->name;
            $competitor->client_id = $request->client;
            $competitor->category = $request->category;
            $competitor->save();
        } catch (\Exception $e) {
            dd($e);
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
    public function update(Request $request, Competitor $competitor)
    {
        if(Competitor::where('name', $request->name)->where('category', $request->category)->where('client_id', $request->client)->where('id', '<>', $competitor->id)->get()->all() || !$request->name){
            session([
                'status' => 'Nome concorrente già esistente'
            ]);
            return view('competitors.edit', [$competitor->id]);
        }

        try {
            $competitor->name = $request->name;
            $competitor->client_id = $request->client;
            $competitor->category = $request->category;
            $competitor->update();
        } catch (\Exception $e) {
            dd($e);
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
