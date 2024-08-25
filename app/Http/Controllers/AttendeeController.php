<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['event', 'user'])->get();
        $feedback = Feedback::with(['event', 'user'])->get();

        return view('dashboard.attendees', ['tickets' => $tickets]);
    }
}
