<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Receiver Chat</title>
    @vite(['resources/js/app.js']) 
</head>
<body>
    <h2>Receiver</h2>

    <input type="text" id="messageInput" placeholder="Type your reply...">
    <button id="sendBtn">Send</button>

    <ul id="messages"></ul>
</body>
</html>
