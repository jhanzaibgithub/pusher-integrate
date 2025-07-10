import './bootstrap';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
    const messagesEl = document.getElementById('messages');
    const inputEl = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');

    const from = document.title.toLowerCase().includes('sender') ? 'user-1' : 'user-2';

    window.Echo.channel('chat')
        .listen('.message.sent', ({ message, from: sender }) => {
            if (sender !== from) {
                messagesEl.innerHTML += `<li>${sender}: ${message}</li>`;
            }
        });

    sendBtn?.addEventListener('click', () => {
        const msg = inputEl.value.trim();
        if (!msg) return;

        axios.post('/send-message', { message: msg, from: from })
            .then(() => {
                messagesEl.innerHTML += `<li>You: ${msg}</li>`;
                inputEl.value = '';
            })
            .catch(err => console.error('Send Error:', err));
    });
});
