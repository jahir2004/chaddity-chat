<?php

use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;

Route::view('/', 'chatapp')->name('home');

Route::middleware('web')->group(function () {
    Route::view('/chatapp', 'chatapp')->name('chatapp');
    Route::view('/chat-test', 'chat-test')->name('chat-test');
    // Livewire component laadt nu automatisch in de view
    Route::view('messages', 'pages.messages.index')->name('messages');
});

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

require __DIR__.'/settings.php';
