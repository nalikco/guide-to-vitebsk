import {defineConfig} from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    server: {
        host: 'localhost',
        hmr: {host: 'localhost'},
    },
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/ts/app.ts"],
            refresh: true,
        }),
    ],
});
