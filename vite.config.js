import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// konfigurasi Vite server watcher untuk docker
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // Tambahkan blok server di bawah ini untuk Docker & Sail
    server: {
        host: '0.0.0.0', // Membuka akses server Vite agar bisa dijangkau browser host
        hmr: {
            host: 'localhost', // Mengarahkan HMR browser ke localhost
        },
        watch: {
            usePolling: true, // Memaksa Vite mengecek perubahan file secara berkala di Docker/WSL
            interval: 100, // Cek perubahan file setiap 100ms
        },
    },
});