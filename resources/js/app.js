import './htmx';
import './modal';
import './calendar';
import './gallery';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

if (window.userId) {
    window.Echo.private(`notifications.${window.userId}`)
        .listen('.new-notification', (e) => {
            window.htmx.trigger('#notifications', 'reloadNotifications');
        });
}

// user menu
document.addEventListener('DOMContentLoaded', () => {
    const userMenuButton = document.getElementById('userMenuButton');
    if (userMenuButton) {
        const dropdown = document.getElementById('userDropdown');
        userMenuButton.addEventListener('click', () => dropdown.classList.toggle('hidden'));
    }
});

// TODO: Find better way to pass route url
function handleKeydown(event) {
    if (event.shiftKey && event.key === 'P') {
        event.preventDefault();

        htmx.ajax('GET', '/patient/create', { target:'#dialog' })
    }
}

document.addEventListener('keydown', handleKeydown);
