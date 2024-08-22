<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $events = $user->events;
        $tickets = Ticket::whereIn('event_id', $events->pluck('id'))->get();
        $attendees = $tickets->map(function ($ticket) {
            return $ticket->user;
        })->unique('id');
        return view('dashboard.attendees', ['attendees' => $attendees, 'tickets' => $tickets]);
    }
}
