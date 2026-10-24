import Echo from 'laravel-echo';

export function initMessaging() {
    // Listen to the messages channel
    window.Echo.channel('messages')
        .listen('MessageCreated', (event) => {
            console.log('New message received:', event);
            
            // Dispatch custom event so your app can handle it
            window.dispatchEvent(new CustomEvent('message.created', {
                detail: event
            }));
        });
}

export function sendMessage(userId, content) {
    return fetch('/api/messages', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        },
        body: JSON.stringify({
            user_id: userId,
            content: content,
        }),
    })
    .then(response => response.json());
}

export function getMessages() {
    return fetch('/api/messages')
        .then(response => response.json());
}

export function deleteMessage(messageId) {
    return fetch(`/api/messages/${messageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        },
    })
    .then(response => response.json());
}

export function subscribeToMessages(callback) {
    window.addEventListener('message.created', (event) => {
        callback(event.detail);
    });
}
