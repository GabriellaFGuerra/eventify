<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index($eventId)
    {
        $event = Event::find($eventId);
        return view('eventify.feedback')->with('event', $event);
    }

    public function store(Request $request, $eventId)
    {
        $request->validate(
            [
                'rating' => 'required|integer:1,5',
                'comment' => 'required'
            ],
            [
                'rating' => 'Rating is required',
                'comment' => 'Comment is required'
            ]
        );

        $feedback = new Feedback();
        $feedback->rating = $request->input('rating');
        $feedback->comment = $request->input('comment');
        $feedback->event_id = $eventId;
        $feedback->user_id = Auth::user()->id;

        if ($feedback->save()) {
            return redirect('/mytickets')->with('success', 'Feedback submitted successfully!');
        } else {
            return view('eventify.feedback')->with('event', $eventId)->with('errors', $request->errors);
        }
    }
}
