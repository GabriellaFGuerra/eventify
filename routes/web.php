<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('dashboard');

    Route::get('/events', [EventController::class, 'create'])->name('events');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::post('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::get('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/attendees', [AttendeeController::class, 'index'])->name('attendees');
})->middleware([\App\Http\Middleware\AdminUser::class], 'auth');

Route::get('/', [TicketController::class, 'index'])->name('homepage');
Route::prefix('/')->group(function () {
    Route::get('/tickets', [TicketController::class, 'create'])->name('tickets');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
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
