<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sender Chat</title>
</head>
<body>
    <h2>Sender</h2>

    <input type="text" id="messageInput" placeholder="Type your message">
    <button id="sendBtn">Send</button>

    <ul id="messages"></ul>

    <!-- Axios & Pusher -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    
    <script type="module">
        import Echo from 'https://cdn.skypack.dev/laravel-echo';

        // CSRF Setup for Laravel
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

        // Echo (Pusher Realtime)
        window.Pusher = Pusher;
        const echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env("PUSHER_APP_KEY") }}',
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            forceTLS: true
        });

        // Listen for incoming messages
        echo.channel('chat')
            .listen('.message.sent', ({ message, from }) => {
                if (from !== 'sender') {
                    document.getElementById('messages').innerHTML += `<li>${from}: ${message}</li>`;
                }
            });

        // Send message
        document.getElementById('sendBtn').addEventListener('click', () => {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            if (!message) return;

            axios.post('/send-message', { message, from: 'sender' })
                .then(() => {
                    document.getElementById('messages').innerHTML += `<li>You: ${message}</li>`;
                    input.value = '';
                })
                .catch(err => console.error("Send Error:", err));
        });
    </script>
</body>
</html>
