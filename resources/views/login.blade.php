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
        }
    </style>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                @if ($errors->has('email'))
                    <ul>
                        @foreach ($errors->get('email') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if ($errors->has('password'))
                    <ul>
                        @foreach ($errors->get('password') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif
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
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter your email" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Enter your password">
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
