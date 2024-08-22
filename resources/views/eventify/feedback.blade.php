@extends('index')
@section('title')
    Feedback - {{ $event->name }}
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

        <div class="container mt-5">
        <h1 class="text-center mb-4">Feedback for {{ $event->name }}</h1>
        <form action="{{ route('feedback.store', $event->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1-5)</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="">Select Rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comments</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
    </div>

@endsection
