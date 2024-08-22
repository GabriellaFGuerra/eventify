@extends('index')
@section('title')
    Sign Up
@endsection

@section('content')
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

        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Eventify</h1>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Sign Up</h2>
                        <form action="/signup" method="POST">
                            @csrf
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter your name" value="{{ old('name') }}">
                                <label for="name" class="form-label">Name</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter your email" value="{{ old('email') }}">
                                <label for="email" class="form-label">Email address</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="phone" id="phone"
                                    placeholder="Enter your phone" value="{{ old('phone') }}">
                                <label for="phone" class="form-label">Phone</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="Enter your address" value="{{ old('address') }}">
                                <label for="address" class="form-label">Address</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="date" class="form-control" name="birthday" id="birthday"
                                    value="{{ old('birthday') }}">
                                <label for="birthday" class="form-label">Birthday</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <select name="type" class="form-select" id="type">
                                    <option value="admin">Organizer</option>
                                    <option value="user">User</option>
                                </select>
                                <label for="type" class="form-label">Are you an Event Organizer or a User?</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Enter your password">
                                <label for="password" class="form-label">Password</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"
                                    placeholder="Confirm your password">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                            </div>

                            <div class="d-grid mb-3 gap-2">
                                <a href="/login" class="btn btn-link btn-link-custom">Already have an account? Login here</a>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
