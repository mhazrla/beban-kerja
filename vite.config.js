import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",

                // Template
                "resources/assets/vendor/fontawesome-free/css/all.min.css",
                "resources/assets/css/sb-admin-2.min.css",
                // JS
                "resources/assets/vendor/jquery/jquery.min.js",
                "resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js",
                "resources/assets/js/sb-admin-2.min.js",
                "resources/assets/vendor/datatables/dataTables.bootstrap4.min.css",
                "resources/assets/vendor/datatables/jquery.dataTables.min.js",
                "resources/assets/vendor/datatables/dataTables.bootstrap4.min.js",
                "resources/assets/js/demo/datatables-demo.js",
            ],
            refresh: true,
        }),
    ],
});
