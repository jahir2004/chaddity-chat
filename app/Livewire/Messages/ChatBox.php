<?php

namespace App\Livewire\Messages;

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatBox extends Component
{
    // Opgeslagen berichten in het component
    public $messages = [];

    // Inhoud van het input veld
    public $content = '';

    // Livewire hook - wordt aangeroepen wanneer component wordt gemount
    public function mount()
    {
        // Laad alle berichten uit database
        $this->loadMessages();
    }

    // Laad alle berichten uit de database
    public function loadMessages()
    {
        // Haal alle berichten op met hun geassocieerde user info
        $this->messages = Message::with('user')
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
    }

    // Verstuur een nieuw bericht
    public function sendMessage()
    {
        // Valideer dat het bericht niet leeg is
        $this->validate([
            'content' => 'required|string|max:500',
        ]);

        // Maak nieuw bericht aan in database
        Message::create([
            'user_id' => auth()->id() ?? 1, // Gebruik ingelogde user, fallback op user 1
            'content' => $this->content,
        ]);

        // Wis het input veld
        $this->content = '';

        // Herlaad berichten
        $this->loadMessages();
    }

    // Listener voor real-time updates via Laravel Echo/WebSockets
    // Dit wordt aangeroepen wanneer het MessageCreated event wordt gebroadcast
    #[On('message.created')]
    public function onMessageCreated($data)
    {
        // Voeg het nieuwe bericht toe aan de lijst
        $this->messages[] = [
            'id' => $data['id'],
            'user_id' => $data['user_id'],
            'content' => $data['content'],
            'created_at' => $data['created_at'],
            'user' => [
                'name' => 'User ' . $data['user_id'],
            ]
        ];

        // Herlaad echte berichten om user info te krijgen
        $this->loadMessages();
    }

    // Render de Blade view voor dit component
    public function render()
    {
        return view('livewire.messages.chat-box');
    }
}
