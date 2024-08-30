import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server:{
      port: 5173,
      proxy: {
          '/api': 'http://localhost:8000',
      }
    },
    build:{
        manifest: true,
        outDir: "public/build",
        rollupOptions: {
            input: {
              main: 'resources/js/app.js',
              style: 'resources/css/app.css',
            },
          }
    },
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
});
