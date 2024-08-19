<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
    Route::get('/events', function () {
        return view('dashboard.events');
    })->name('events');
    Route::get('/attendees', function () {
        return view('dashboard.attendees');
    })->name('attendees');
    Route::get('/settings', function () {
        return view('dashboard.settings');
    })->name('settings');
})->middleware('auth');


Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('/signup', [UserController::class, 'store']);

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout']);
