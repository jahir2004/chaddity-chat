<div>
    {{-- Header --}}
    <div class="mb-4">
        <h3 class="text-lg font-semibold">💬 Live Chat (Real-time with WebSockets)</h3>
        <p class="text-sm text-gray-500">Messages update instantly across all browser tabs</p>
    </div>

    {{-- Messages Container --}}
    <div style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; height: 400px; overflow-y: auto; margin-bottom: 1rem; background-color: #f9fafb;" wire:poll>
        {{-- Check if there are any messages --}}
        @if(count($messages) > 0)
            {{-- Loop through all messages and display them --}}
            @foreach ($messages as $message)
                <div style="margin-bottom: 1rem; padding: 0.75rem; background-color: white; border-radius: 0.375rem; border-left: 4px solid #3b82f6;">
                    {{-- Display username in bold --}}
                    <strong style="color: #1f2937;">{{ $message['user']['name'] ?? 'Unknown User' }}:</strong>
                    
                    {{-- Display message content --}}
                    <p style="margin-top: 0.25rem; color: #374151;">{{ $message['content'] }}</p>
                    
                    {{-- Display message timestamp --}}
                    <small style="color: #9ca3af;">
                        @php
                            // Parse the timestamp - handle both string and array formats
                            $timestamp = is_array($message['created_at']) 
                                ? \Carbon\Carbon::createFromArray($message['created_at'])
                                : \Carbon\Carbon::parse($message['created_at']);
                        @endphp
                        {{ $timestamp->format('H:i') }}
                    </small>
                </div>
            @endforeach
        @else
            {{-- Show empty state message --}}
            <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                <p>No messages yet. Start a conversation!</p>
            </div>
        @endif
    </div>

    {{-- Message Input Form --}}
    <form wire:submit="sendMessage" style="display: flex; gap: 0.5rem;">
        {{-- Text input field with real-time binding via wire:model --}}
        <input 
            type="text" 
            wire:model="content"
            placeholder="Type a message..." 
            style="flex: 1; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 1rem;"
        >
        
        {{-- Send button --}}
        <button 
            type="submit" 
            style="padding: 0.75rem 1.5rem; background-color: #3b82f6; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 500; transition: background-color 0.2s;"
            @mouseover="this.style.backgroundColor='#2563eb'" 
            @mouseout="this.style.backgroundColor='#3b82f6'"
        >
            Send
        </button>
    </form>

    {{-- Debug Info --}}
    <div style="margin-top: 1rem; padding: 0.75rem; background-color: #f3f4f6; border-radius: 0.375rem; font-size: 0.875rem;">
        <strong>Status:</strong> {{ count($messages) }} messages loaded | Last updated: <span wire:poll>{{ now()->format('H:i:s') }}</span>
    </div>

    {{-- JavaScript for real-time WebSocket integration --}}
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Initialize Echo for WebSocket listening
            window.Echo.channel('messages')
                .listen('MessageCreated', (event) => {
                    console.log('📨 New message via WebSocket:', event);
                    
                    // Dispatch Livewire event to update component
                    Livewire.dispatch('message.created', {
                        id: event.id,
                        user_id: event.user_id,
                        content: event.content,
                        created_at: event.created_at,
                    });
                })
                .error((error) => {
                    console.error('❌ WebSocket error:', error);
                });
            
            console.log('✅ WebSocket listener initialized');
        });
    </script>
</div>
