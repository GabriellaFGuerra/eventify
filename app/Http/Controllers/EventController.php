<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::id());
        $tickets = Ticket::all();

        return view('dashboard.dashboard', ['events' => $events, 'tickets' => $tickets]);
    }

    public function create()
    {
        $events = Event::where('user_id', Auth::id());
        return view('dashboard.events', ['events' => $events]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_datetime' => 'required',
            'event_location' => 'required',
            'event_price' => 'required|numeric'
        ]);

        $event = new Event();

        $event->name = $request->input('event_name');
        $event->description = $request->input('event_description');
        $event->date_time = $request->input('event_datetime');
        $event->location = $request->input('event_location');
        $event->price = $request->input('event_price');
        $event->user_id = Auth::id();

        if ($event->save()) {
            return redirect()->route('events')->with('success', 'Event created successfully.');
        } else {
            return Redirect::back()->withErrors($request->errors())->withInput($request->all());
        }
    }

    public function update(Request $request, $event)
    {
        $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_datetime' => 'required',
            'event_location' => 'required'
        ]);

        $save_event = Event::where('id', $event)->first();
        $save_event->name = $request->input('event_name');
        $save_event->description = $request->input('event_description');
        $save_event->date_time = $request->input('event_datetime');
        $save_event->location = $request->input('event_location');

        if ($save_event->save()) {
            return redirect()->route('events')->with('success', 'Event updated successfully.');
        } else {
            return Redirect::back()->withErrors($request->errors())->withInput($request->all());
        }
    }

    public function destroy($event)
    {
        if (Event::find($event)) {
            Event::where('id', $event)->delete();
            return redirect()->route('events')->with('success', 'Event deleted successfully.');
        } else {
            return redirect()->route('events')->with('error', 'Event not found.');
        }
    }
}
