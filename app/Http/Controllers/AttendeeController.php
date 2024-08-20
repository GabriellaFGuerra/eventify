<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    public function index() {
        $attendees = Ticket::where('event_id', Event::where('user_id', Auth::id())->get('id'))->get();
        return view('dashboard.attendees', $attendees);
    }
}
