<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 👇 New route for Chat page
Route::get('/chat', function () {
    return Inertia::render('Chat', [
        'messages' => \App\Models\Message::with('user')->get(),
        'currentUserId' => Auth::id(),
    ]);
})->middleware(['auth']);


Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [ChatController::class, 'fetchMessages']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

