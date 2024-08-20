@extends('index')
@section('title')
    Attendees - Eventify
@endsection

@section('content')
    <div class="sidebar">
        <h4 class="mb-4">Admin Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item p-3">
                <a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item p-3">
                <a class="nav-link" href="/dashboard/events"><i class="fas fa-calendar-alt"></i> Events</a>
            </li>
            <li class="nav-item p-3">
                <a class="nav-link active" href="/dashboard/attendees"><i class="fas fa-users"></i> Attendees</a>
            </li>
            <li class="nav-item p-3">
                <a class="nav-link" href="/dashboard/settings"><i class="fas fa-cogs"></i> Settings</a>
            </li>
            <li class="nav-item p-3">
                <a href="/logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid mt-5">
            <h1 class="text-center mb-4">Attendees</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Event</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($attendees)
                        @foreach ($attendees as $attendee)
                            <tr>
                                <td>{{ $attendee->user()->name }}</td>
                                <td>{{ $attendee->user()->email }}</td>
                                <td>{{ $attendee->user()->phone }}</td>
                                <td>{{ $attendee->event()->name }}</td>
                                <td>{{ $attendee->feedback }}</td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
@endsection
