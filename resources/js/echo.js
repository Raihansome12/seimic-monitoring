import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('gps-channel')
    .listen('.NewGpsDataReceived', (e) => {
        console.log("Received GPS event: ", e);

        if (window.Livewire && typeof window.Livewire.emit === 'function') {
            window.Livewire.emit('handleNewLocation', e);
        } else {
            console.warn('Livewire belum tersedia');
        }
    });


// function waitForLivewireAndEmit(data, retries = 10) {
//     if (window.Livewire && typeof window.Livewire.emit === 'function') {
//         console.log("Livewire siap, emit data GPS...");
//         window.Livewire.emit('handleNewLocation', data);
//     } else if (retries > 0) {
//         console.warn("Livewire belum siap, retry dalam 500ms...");
//         setTimeout(() => waitForLivewireAndEmit(data, retries - 1), 500);
//     } else {
//         console.error("Gagal emit karena Livewire tidak pernah siap.");
//     }
// }

// window.Echo.channel('gps-channel')
//     .listen('.NewGpsDataReceived', (e) => {
//         console.log("Received GPS event: ", e);
//         waitForLivewireAndEmit(e);
//     });



