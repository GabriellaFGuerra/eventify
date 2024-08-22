<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('homepage')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $event = Event::find($id);
        return view('eventify.tickets')->with('event', $event);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validate = $request->validate([
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $ticket = new Ticket();
        $ticket->quantity = $request->input('quantity');
        $ticket->user_id  = Auth::user()->id;
        $ticket->event_id = $id;
        $ticket->price = $request->input('price');

        if ($ticket->save()) {
            return redirect()->to('/mytickets')->with('success', 'Ticket purchased successfully');
        } else {
            return redirect()->back()->with('errors', $request->errors());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->with('event')->get();
        return view('eventify.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
