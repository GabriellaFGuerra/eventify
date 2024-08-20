@extends('index')
@section('title')
    Events - Eventify
@endsection
@section('content')
    <div class="sidebar">
        <h4 class="mb-4">Admin Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item p-3">
                <a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item p-3">
                <a class="nav-link active" href="/dashboard/events"><i class="fas fa-calendar-alt"></i> Events</a>
            </li>
            <li class="nav-item p-3">
                <a class="nav-link" href="/dashboard/attendees"><i class="fas fa-users"></i> Attendees</a>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->get('event_name') as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                    @foreach ($errors->get('event_description') as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                    @foreach ($errors->get('event_datetime') as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                    @foreach ($errors->get('event_location') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session()->get('success') }}</li>
                </ul>
            </div>
        @endif
        
        <div class="container-fluid mt-5">
            <h1 class="text-center mb-4">Event Management</h1>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEventModal">Add
                New
                Event</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Date/Time</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events->get() as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->date_time)->toDayDateTimeString() }}</td>
                            <td>{{ $event->location }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editEventModal{{ $event->id }}">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#cancelEventModal{{ $event->id }}">Cancel event</button>
                            </td>
                        </tr><!-- Cancel Event Modal -->
                        <div class="modal fade" id="cancelEventModal{{ $event->id }}" tabindex="-1"
                            aria-labelledby="cancelEventModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="cancelEventModalLabel">Cancel
                                            {{ $event->name }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to cancel this event?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-danger"
                                            href="{{ route('events.destroy', $event->id) }}">Cancel
                                            {{ $event->name }}</a>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Event Modal -->
                        <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1"
                            aria-labelledby="editEventModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editEventModalLabel">Edit {{ $event->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('events.update', $event->id) }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="eventName" class="form-label">Event Name</label>
                                                    <input type="text" class="form-control" id="eventName"
                                                        name="event_name" value="{{ $event->name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="eventDescription" class="form-label">Event
                                                        Description</label>
                                                    <input type="text" class="form-control" id="eventDescription"
                                                        name="event_description" value="{{ $event->description }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="eventDate" class="form-label">Date</label>
                                                    <input type="datetime-local" class="form-control" id="eventDate"
                                                        name="event_datetime" value="{{ $event->date_time }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="eventLocation" class="form-label">Location</label>
                                                    <input type="text" class="form-control" id="eventLocation"
                                                        name="event_location" value="{{ $event->location }}">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Event</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addEventModalLabel">Add New Event</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('events.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="eventName" name="event_name"
                                value="{{ old('event_name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label">Event Description</label>
                            <input type="text" class="form-control" id="eventDescription" name="event_description"
                                value="{{ old('event_description') }}">
                        </div>
                        <div class="mb-3">
                            <label for="eventDate" class="form-label">Date</label>
                            <input type="datetime-local" class="form-control" id="eventDate" name="event_datetime"
                                value="{{ old('event_datetime') }}">
                        </div>
                        <div class="mb-3">
                            <label for="eventLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="eventLocation" name="event_location"
                                value="{{ old('event_location') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
