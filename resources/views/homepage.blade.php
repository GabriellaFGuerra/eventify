@extends('index')

@section('title')
    Eventify
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
                    <a class="nav-link" href="#events">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mytickets') }}">Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
            @auth
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            @endauth

            @if (Auth::guest())
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/signup">Signup</a>
                    </li>
                </ul>
            @endif
        </div>
    </nav>

    <style>
        .hero-section {
            background: url('https://via.placeholder.com/1600x600') no-repeat center center;
            background-size: cover;
            color: #fff;
            padding: 100px 0;
        }

        .ticket-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section text-center text-light">
        <div class="container">
            <h1 class="display-4">Welcome to Eventify</h1>
            <p class="lead">Discover and buy tickets for the hottest events in town.</p>
            <a href="#events" class="btn btn-primary btn-lg">Explore Events</a>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Upcoming Events</h2>
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Organizerd by: {{ $event->user->name }}</h6>
                                <p class="card-text">{{ $event->description }}</p>
                                <p class="card-text">When: {{ \Carbon\Carbon::parse($event->date_time)->toDayDateTimeString() }}</p>
                                <p class="card-text">Location: {{ $event->location }}</p>
                                <p class="card-text">Price: ${{ $event->price }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('tickets', $event->id) }}" class="btn btn-primary">Buy Tickets</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Contact Us</h2>
            <p>If you have any questions, feel free to reach out to us.</p>
            <a href="/" class="btn btn-secondary">Email Us</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 text-center">
        <p>&copy; 2024 Eventify. All rights reserved.</p>
    </footer>
@endsection
