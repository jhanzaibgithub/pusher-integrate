<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat</title>
    @vite(['resources/js/app.js'])

    <script>
        window.authUser = @json(Auth::user());
    </script>
</head>
<body>
    <h2>{{ Auth::user()->name }}</h2>

    <input type="text" id="messageInput" placeholder="Type your message...">
    <button id="sendBtn">Send</button>
    <ul id="messages"></ul>
</body>
</html>
