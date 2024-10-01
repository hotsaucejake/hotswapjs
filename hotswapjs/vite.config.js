import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import prism from 'vite-plugin-prismjs';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        prism({
            languages: 'all',
            plugins: ['line-numbers'],
            theme: 'tomorrow',
            css: true,
        }),
    ],
});
