<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\Client as ClientRequest;
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
    public function store(ClientRequest $request)
    {
        $validated = $request->validated();

        try {
            $client = new Client();
            $client->name = $validated['name'];
            $client->save();
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('status', $e->getMessage());
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
    public function update(ClientRequest $request, Client $client)
    {
        $validated = $request->validated();

        try {
            $client->name = $validated['name'];
            $client->update();
        } catch (\Exception $e) {
            session()->flash('type', 'warning');
            session()->flash('status', $e->getMessage());
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
