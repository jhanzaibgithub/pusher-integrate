import './bootstrap';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
    const messagesEl = document.getElementById('messages');
    const inputEl = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');

    const currentUser = window.authUser?.name ?? 'Unknown';

    // Listen to broadcast messages
    window.Echo.channel('chat')
        .listen('.message.sent', ({ message, from }) => {
        
            messagesEl.innerHTML += `<li><strong>${message}</strong>: ${from}</li>`;
        });

    sendBtn?.addEventListener('click', () => {
        const msg = inputEl.value.trim();
        if (!msg) return;

        axios.post('/send-message', {
            message: msg,
            from: currentUser
        }).then(() => {
            inputEl.value = '';
        }).catch(err => console.error('Send Error:', err));
    });
});
