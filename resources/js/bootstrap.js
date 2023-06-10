/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";

window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

// // USING PUSHER
// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true,
// });

// USING SOKETI
window.Echo = new Echo({
    broadcaster: "pusher",
    key: "app-key",
    id: "app-id",
    secret: "app-secret",
    wsHost: "127.0.0.1",
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    encrypted: true,
    disableStats: true,
    enabledTransports: ["ws", "wss"],
    cluster: "mt1",
});

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: "591c80b38033e4ea65a3",
//     //wsHost: "soketi",
//     //wsPort: 6001,
//     //wssPort: 6001,
//     forceTLS: false,
//     encrypted: true,
//     disabledStats: true,
//     enabledTransports: ["ws", "wss"],
//     cluster: "soketi",
// });
