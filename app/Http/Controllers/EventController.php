<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('user_id', Auth::id());
        $tickets = Ticket::find('event_id');

        return view('dashboard.dashboard', ['events' => $events, 'tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        return view('dashboard.events', ['events' => $events]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_datetime' => 'required',
            'event_location' => 'required'
        ]);

        $event = new Event();

        $event->name = $request->input('event_name');
        $event->description = $request->input('event_description');
        $event->date_time = $request->input('event_datetime');
        $event->location = $request->input('event_location');
        $event->user_id = 1;

        if ($event->save()) {
            return redirect()->route('events')->with('success', 'Event created successfully.');
        } else {
            return Redirect::back()->withErrors($request->errors())->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
