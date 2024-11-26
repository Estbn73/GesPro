import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/fullcalendar.css', // CSS de FullCalendar
                'resources/js/fullcalendar.js',   // JS de FullCalendar
            ],
            refresh: true,
        }),
    ],
});
