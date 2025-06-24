import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/base.css',
                'resources/css/comments.css',
                'resources/css/footer.css',
                'resources/css/header.css',
                'resources/css/menu.css',
                'resources/css/popup.css',
                'resources/css/profile.css',
                'resources/js/authentication.js',
                'resources/js/base.js',
                'resources/js/comments.js'
                    ],
            refresh: true,
        }),
    ],
});
