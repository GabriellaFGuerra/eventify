@extends('index')
@section('title')
    Buy Tickets
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="#">Eventify</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href={{ route('homepage') }}>Events</a>
                </li>
            </ul>
            @auth
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            @endauth
        </div>
    </nav>

    <div class="container">
        

        <h1 class="mt-5">My Tickets</h1>
        <table class="table table-striped table-hover mt-4">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Date/Time</th>
                    <th>Location</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->event->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($ticket->event->date_time)->toDayDateTimeString() }}</td>
                        <td>{{ $ticket->event->location }}</td>
                        <td>{{ $ticket->quantity }}</td>
                        <td>${{ $ticket->price }}</td>
                        @if ($ticket->event->date_time < \Carbon\Carbon::now() )
                            <td><a class="btn btn-link" href={{ route('feedback', $ticket->event->id) }}
                                    role="button">Rate event</a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
