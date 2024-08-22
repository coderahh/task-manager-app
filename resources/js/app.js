import './bootstrap';

// Import Laravel Echo and Socket.io
import Echo from 'laravel-echo';
import io from 'socket.io-client';

window.io = io;

// Setup Echo with Socket.io
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001', // Adjust the port if necessary
    client: io
});

console.log("Echo and io:", window.Echo, window.io);
