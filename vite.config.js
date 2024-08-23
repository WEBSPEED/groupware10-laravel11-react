import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: true,
            buildDirectory: 'assets',
        }),
        react(),
    ],    
    
    //build 시에 모든 console.log를 제거
    build: {
        // minify: 'terser',   // esbuild
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true
            }
        },
        assetsDir: '.'
    },

});
