<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Test - Websockets</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 800px;
            height: 600px;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status.connected {
            background: #4caf50;
        }
        
        .status.disconnected {
            background: #f44336;
        }
        
        .messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background: #f5f5f5;
        }
        
        .message {
            margin-bottom: 15px;
            padding: 12px 16px;
            border-radius: 8px;
            max-width: 70%;
            word-wrap: break-word;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .message.own {
            background: #667eea;
            color: white;
            margin-left: auto;
        }
        
        .message.other {
            background: white;
            border: 1px solid #ddd;
        }
        
        .message-time {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 4px;
        }
        
        .input-area {
            padding: 20px;
            border-top: 1px solid #ddd;
            display: flex;
            gap: 10px;
        }
        
        .input-group {
            flex: 1;
        }
        
        label {
            display: block;
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
            font-weight: 600;
        }
        
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus, input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .button-group {
            display: flex;
            gap: 8px;
            align-items: flex-end;
        }
        
        button {
            padding: 10px 16px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
            height: 40px;
        }
        
        button:hover {
            background: #5568d3;
        }
        
        button:active {
            transform: scale(0.98);
        }
        
        .debug {
            background: #f9f9f9;
            border-top: 1px solid #ddd;
            padding: 10px;
            font-size: 11px;
            color: #666;
            max-height: 100px;
            overflow-y: auto;
            font-family: monospace;
        }
        
        .debug-line {
            padding: 2px;
            margin: 2px 0;
        }
        
        .error {
            color: #f44336;
        }
        
        .success {
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💬 Chat Websocket Test</h1>
            <div class="status disconnected" id="status">Connecting...</div>
        </div>
        
        <div class="messages" id="messages"></div>
        
        <div class="input-area">
            <div class="input-group">
                <label for="userId">User ID</label>
                <input type="number" id="userId" placeholder="Enter user ID" value="1" min="1">
            </div>
            <div class="input-group" style="flex: 2;">
                <label for="messageInput">Message</label>
                <input type="text" id="messageInput" placeholder="Type a message..." autocomplete="off">
            </div>
            <div class="button-group">
                <button id="sendBtn">Send</button>
                <button id="loadBtn" style="background: #4caf50;">Load</button>
                <button id="clearBtn" style="background: #ff9800;">Clear</button>
            </div>
        </div>
        
        <div class="debug" id="debug"></div>
    </div>

    <script type="module">
        import Echo from 'https://cdn.jsdelivr.net/npm/laravel-echo@^2.6.1/+esm';
        import Pusher from 'https://cdn.jsdelivr.net/npm/pusher-js@^8.6.0/+esm';
        
        window.Pusher = Pusher;
        
        const statusEl = document.getElementById('status');
        const messagesEl = document.getElementById('messages');
        const debugEl = document.getElementById('debug');
        const userIdInput = document.getElementById('userId');
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const loadBtn = document.getElementById('loadBtn');
        const clearBtn = document.getElementById('clearBtn');
        
        let currentUserId = 1;
        let echo = null;
        
        function log(message, type = 'info') {
            const line = document.createElement('div');
            line.className = `debug-line ${type}`;
            line.textContent = `[${new Date().toLocaleTimeString()}] ${message}`;
            debugEl.appendChild(line);
            debugEl.scrollTop = debugEl.scrollHeight;
            console.log(`[${type.toUpperCase()}]`, message);
        }
        
        function setStatus(connected) {
            statusEl.textContent = connected ? 'Connected' : 'Disconnected';
            statusEl.className = `status ${connected ? 'connected' : 'disconnected'}`;
        }
        
        function addMessage(content, userId, isOwn = false) {
            const div = document.createElement('div');
            div.className = `message ${isOwn ? 'own' : 'other'}`;
            
            const time = new Date().toLocaleTimeString();
            div.innerHTML = `
                <div>${content}</div>
                <div class="message-time">User ${userId} • ${time}</div>
            `;
            
            messagesEl.appendChild(div);
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }
        
        async function initEcho() {
            try {
                log('Initializing Echo...', 'info');
                
                echo = new Echo({
                    broadcaster: 'reverb',
                    key: 'cax6riu7saijk6zzh1nf', // From your .env
                    wsHost: 'localhost',
                    wsPort: 8080,
                    wssPort: 8080,
                    forceTLS: false,
                    enabledTransports: ['ws', 'wss'],
                });
                
                echo.channel('messages')
                    .listen('MessageCreated', (event) => {
                        log(`Message received from user ${event.user_id}: ${event.content}`, 'success');
                        addMessage(event.content, event.user_id, event.user_id === currentUserId);
                    })
                    .error((error) => {
                        log(`Error listening to channel: ${error.message}`, 'error');
                        setStatus(false);
                    });
                
                log('Echo initialized successfully!', 'success');
                setStatus(true);
                
            } catch (error) {
                log(`Failed to initialize Echo: ${error.message}`, 'error');
                setStatus(false);
            }
        }
        
        async function sendMessage() {
            const userId = parseInt(userIdInput.value);
            const content = messageInput.value.trim();
            
            if (!content) {
                log('Message is empty!', 'error');
                return;
            }
            
            if (!userId || userId < 1) {
                log('Invalid user ID!', 'error');
                return;
            }
            
            try {
                log(`Sending message from user ${userId}...`, 'info');
                
                const response = await fetch('http://localhost:8000/api/messages', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        content: content,
                    }),
                });
                
                if (!response.ok) {
                    const error = await response.text();
                    log(`Error sending message (${response.status}): ${error}`, 'error');
                    return;
                }
                
                const data = await response.json();
                log(`Message sent successfully! ID: ${data.id}`, 'success');
                
                addMessage(content, userId, true);
                messageInput.value = '';
                messageInput.focus();
                
            } catch (error) {
                log(`Network error: ${error.message}`, 'error');
            }
        }
        
        async function loadMessages() {
            try {
                log('Loading messages...', 'info');
                
                const response = await fetch('http://localhost:8000/api/messages');
                
                if (!response.ok) {
                    log(`Error loading messages (${response.status})`, 'error');
                    return;
                }
                
                const messages = await response.json();
                log(`Loaded ${messages.length} messages`, 'success');
                
                messages.forEach(msg => {
                    addMessage(msg.content, msg.user_id);
                });
                
            } catch (error) {
                log(`Network error: ${error.message}`, 'error');
            }
        }
        
        function clearMessages() {
            messagesEl.innerHTML = '';
            debugEl.innerHTML = '';
            log('Chat cleared', 'info');
        }
        
        // Event listeners
        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
        loadBtn.addEventListener('click', loadMessages);
        clearBtn.addEventListener('click', clearMessages);
        userIdInput.addEventListener('change', () => {
            currentUserId = parseInt(userIdInput.value);
            log(`Switched to user ${currentUserId}`, 'info');
        });
        
        // Initialize
        log('Page loaded. Starting Echo initialization...', 'info');
        initEcho();
    </script>
</body>
</html>
