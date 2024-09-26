import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css', // Vérifie ce chemin
                'resources/js/app.js'         // Le fichier JS principal

            ],
            refresh: true,
        }),
    ],
});
