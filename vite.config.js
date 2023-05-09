import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});

/*
En el archivo vite.config.js, agregue la configuración de base para que la aplicación 
se ejecute en la carpeta /proyecto-final/ en lugar de la raíz del servidor web. 
El archivo vite.config.js se verá así:


import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    base: "/proyecto-final/",
});
*/
