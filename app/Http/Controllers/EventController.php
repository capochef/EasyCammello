<?php

namespace App\Http\Controllers;

use App\Event;
use App\Competitor;
use App\Http\Requests\Event as EventRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('competitor.client', 'user')->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $competitors = Competitor::orderBy('name')->get()->pluck('name', 'id');
        return view('events.create', compact('competitors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $validated = $request->validated();

        try {
            $event = new Event();
            $event->description = $validated['description'];
            $event->competitor_id = $validated['competitor'];
            $event->points = $validated['points'];
            $event->software = $validated['software'];
            $event->modified_by = auth()->id();
            $event->save();
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('status', $e->getMessage());
        }

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $competitors = Competitor::orderBy('name')->get()->pluck('name', 'id');
        return view('events.edit', compact('competitors', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $validated = $request->validated();

        try {
            $event->description = $validated['description'];
            $event->competitor_id = $validated['competitor'];
            $event->points = $validated['points'];
            $event->software = $validated['software'];
            $event->modified_by = auth()->id();
            $event->update();
        } catch (\Exception $e) {
            session()->flash('type', 'warning');
            session()->flash('status', $e->getMessage());
        }

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
    }
}
