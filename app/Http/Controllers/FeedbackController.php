<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($eventId)
    {
        $event = Event::find($eventId);
        return view('eventify.feedback')->with('event', $event);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
