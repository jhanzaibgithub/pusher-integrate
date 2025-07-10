<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Receiver Chat</title>
</head>
<body>
    <h2>Receiver</h2>

    <input type="text" id="messageInput" placeholder="Type your reply...">
    <button id="sendBtn">Send</button>

    <ul id="messages"></ul>

    <!-- Axios & Pusher -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script type="module">
        import Echo from 'https://cdn.skypack.dev/laravel-echo';

        // Setup CSRF for Laravel
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
        window.Pusher = Pusher;
        const echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env("PUSHER_APP_KEY") }}',
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            forceTLS: true
        });

        // Listen for incoming messages on 'chat' channel
        echo.channel('chat')
            .listen('.message.sent', ({ message, from }) => {
                if (from !== 'receiver') {
                    document.getElementById('messages').innerHTML += `<li>${from}: ${message}</li>`;
                }
            });

        // Send reply from receiver
        document.getElementById('sendBtn').addEventListener('click', () => {
            const input = document.getElementById('messageInput');
            const msg = input.value.trim();
            if (!msg) return;

            axios.post('/send-message', { message: msg, from: 'receiver' })
                .then(() => {
                    document.getElementById('messages').innerHTML += `<li>You: ${msg}</li>`;
                    input.value = '';
                })
                .catch(err => console.error('Send Error:', err));
        });
    </script>
</body>
</html>
