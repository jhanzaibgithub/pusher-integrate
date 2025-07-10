<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sender Chat</title>
    @vite(['resources/js/app.js']) 
</head>
<body>
    <h2>User-1</h2>

    <input type="text" id="messageInput" placeholder="Type your message...">
    <button id="sendBtn">Send</button>
    <ul id="messages"></ul>
</body>
</html>
