<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Client::where('name', $request->name)->get()->all() || !$request->name){
            session([
                'status' => 'Cliente già esistente'
            ]);
            return view('clients.create');
        }

        try {
            $client = new Client();
            $client->name = $request->name;
            $client->save();
        } catch (\Exception $e) {
            dd($e);
        }

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        if(Client::where('name', $request->name)->where('id', '<>', $client->id)->get()->all() || !$request->name){
            session([
                'status' => 'Nome cliente già esistente'
            ]);
            return view('clients.edit', [$client->id]);
        }

        try {
            $client->name = $request->name;
            $client->update();
        } catch (\Exception $e) {
            dd($e);
        }

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        foreach ($client->competitors as $key => $competitor) {
            foreach ($competitor->events as $event)
                $event->delete();
            $competitor->delete();
        }
        $client->delete();
    }
}
