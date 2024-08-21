@extends('index')
@section('title')
    Login
@endsection

@section('content')
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center login-form">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Eventify</h1>
                <div class="card border-dark">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form action="/login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" id="email"
                                placeholder="Enter your email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password" id="password"
                                placeholder="Enter your password" required>
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
