<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('dashboard')->middleware([\App\Http\Middleware\AdminUser::class], 'auth');

    Route::get('/events', [EventController::class, 'create'])->name('events')->middleware([\App\Http\Middleware\AdminUser::class], 'auth');
    Route::post('/events', [EventController::class, 'store'])->name('events.store')->middleware([\App\Http\Middleware\AdminUser::class], 'auth');
    Route::post('/events/{id}', [EventController::class, 'update'])->name('events.update')->middleware([\App\Http\Middleware\AdminUser::class], 'auth');
    Route::get('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy')->middleware([\App\Http\Middleware\AdminUser::class], 'auth');

    Route::get('/attendees', [AttendeeController::class, 'index'])->name('attendees')->middleware([\App\Http\Middleware\AdminUser::class], 'auth');
});

Route::get('/', [TicketController::class, 'index'])->name('homepage');

Route::prefix('/')->group(function () {
    Route::get('/tickets/{id}', [TicketController::class, 'create'])->name('tickets')->middleware('auth');
    Route::post('/tickets/{id}', [TicketController::class, 'store'])->name('tickets.store')->middleware('auth');
    Route::get('/mytickets', [TicketController::class, 'show'])->name('mytickets')->middleware('auth');

    Route::get('/feedback/{eventId}', [FeedbackController::class, 'index'])->name('feedback')->middleware('auth');
    Route::post('/feedback/{eventId}', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('auth');
});




Route::get('/signup', function () {
    return view('signup');
})->name('signup')->middleware('guest');
Route::post('/signup', [UserController::class, 'store']);

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout']);
