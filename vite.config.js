import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

/**
 * Konfigurasi Vite khusus Docker / Laravel Sail
 * Terminal Tujuan: Tidak ada (File vite.config.js)
 */
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0", // Supaya Vite menerima request dari luar container
        port: 5173,
        hmr: {
            host: "localhost", // Agar browser mengakses HMR via localhost
        },
        watch: {
            usePolling: true,
            interval: 100, // Cek perubahan tiap 100ms
            ignored: ["**/node_modules/**", "**/vendor/**"], // JANGAN scan folder berat ini!
        },
    },
});
