import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/custom.js',
                'resources/js/patient/modal.js',
                'resources/js/country/modal.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
