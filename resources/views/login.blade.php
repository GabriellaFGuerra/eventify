@extends('index')
@section('title')
    Login
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Eventify</h1>
                <div class="card border-dark">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form action="/login" method="POST">
                            @csrf
                            <div class="mb-3 form-floating">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        @foreach ($errors->get('email') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="email"
                                    class="form-control @if ($errors->has('email')) is-invalid @endif" name="email"
                                    id="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                                <label for="email" class="form-label">Email address</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="password"
                                class="form-control @if ($errors->has('password')) is-invalid @endif" name="password"
                                id="password" placeholder="Enter your password" required>
                                <label for="password" class="form-label">Password</label>
                            </div>
                            <div class="d-grid mb-3 gap-2">
                                <a href="/signup" class="btn btn-link btn-link-custom">Don't have an account? Sign up</a>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
