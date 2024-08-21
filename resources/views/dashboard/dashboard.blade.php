@extends('index')
@section('title')
    Dashboard - Eventify
@endsection

@section('content')
    <div class="sidebar">
        <h4 class="mb-4">Admin Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item p-3">
                <a class="nav-link active" href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item p-3">
                <a class="nav-link" href="/dashboard/events"><i class="fas fa-calendar-alt"></i> Events</a>
            </li>
            <li class="nav-item p-3">
                <a class="nav-link" href="/dashboard/attendees"><i class="fas fa-users"></i> Attendees</a>
            </li>
            <li class="nav-item p-3">
                <a href="/logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Upcoming Events</h5>
                            <p class="card-text">{{ $events->count() }} events scheduled this month.</p>
                            <a href="{{ route('events') }}" class="btn btn-primary">View Events</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Attendees</h5>
                            <p class="card-text">
                                @isset($tickets)
                                    {{ $tickets->count() }}
                                @endisset attendees registered.
                            </p>
                            <a href="{{ route('attendees') }}" class="btn btn-primary">View Attendees</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Event List</h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Event Name</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($events->count() > 0)
                                            @foreach ($events->get() as $event)
                                                <tr>
                                                    <td>{{ $event->id }}</td>
                                                    <td>{{ $event->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($event->date_time)->toDayDateTimeString() }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">No events found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
